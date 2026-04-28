/**
 * Fichier : parsers.js
 * Rôle : Analyse des fichiers PBN et LIN pour en extraire la donne, les enchères et le jeu de la carte.
 */

/**
 * Analyse le contenu d'un fichier PBN (Portable Bridge Notation).
 * @param {string} text - Le contenu brut du fichier
 * @returns {Object} Un objet contenant la configuration initiale et la liste des actions (tokens)
 */
function parsePBN(text) {
  let tokens = [];
  let lines = text.replaceAll('\r\n', '\n').split('\n');
  let initialHands = {};
  let dealer = 'N';
  let declarer = null;
  let contract = null;
  let vul = 'None';

  let inAuction = false;
  let inPlay = false;

  for (let line of lines) {
    line = line.trim();
    if (!line || line.startsWith('%')) continue; // Ignorer les lignes vides ou les commentaires %

    // Extraction des commentaires en ligne { ... }
    let startComment = line.indexOf('{');
    let endComment = line.indexOf('}');

    if (startComment !== -1 && endComment !== -1 && endComment > startComment) {
      // On récupère le texte situé entre { et }
      let commentText = line.substring(startComment + 1, endComment);
      tokens.push({ type: 'comment', value: commentText.trim() });

      // On retire complètement le {commentaire} de la ligne pour ne pas gêner la suite de la lecture
      let partBefore = line.substring(0, startComment);
      let partAfter = line.substring(endComment + 1);
      line = (partBefore + partAfter).trim();
    }

    // Extraction des balises [Nom "Valeur"]
    if (line.startsWith('[')) {
      let endBracket = line.indexOf(']');
      if (endBracket !== -1) {
        // On récupère ce qu'il y a entre les crochets (ex: 'Deal "N:SK75..."')
        let contentInside = line.substring(1, endBracket);

        // On cherche le premier espace pour séparer le nom de la balise et sa valeur
        let firstSpace = contentInside.indexOf(' ');

        if (firstSpace !== -1) {
          // Le tag est la partie avant l'espace (ex: 'Deal')
          let tag = contentInside.substring(0, firstSpace);

          // La valeur est la partie après l'espace (ex: '"N:SK75..."')
          let val = contentInside.substring(firstSpace + 1);

          // On retire les guillemets de la valeur s'il y en a
          val = val.replaceAll('"', '');

          if (tag === 'Deal') {
            // Exemple : N:SK75...
            let parts = val.split(':');
            let start = parts[0];
            let hands = parts[1].split(' ');
            let idx = PLAYERS.indexOf(start);
            for (let i = 0; i < 4; i++) {
              let p = PLAYERS[(idx + i) % 4];
              let handStr = hands[i] || '';
              if (handStr === '-') handStr = '...';
              let suits = handStr.split('.');
              let hand = [];
              let suitChars = ['S', 'H', 'D', 'C'];
              for (let s = 0; s < 4; s++) {
                let ranks = suits[s] || '';
                for (let r = 0; r < ranks.length; r++) {
                  let rank = ranks[r];
                  if (rank === 'T') rank = '10';
                  hand.push({ suit: suitChars[s], rank: rank });
                }
              }
              initialHands[p] = hand;
            }
          } else if (tag === 'Dealer') dealer = val;
          else if (tag === 'Vulnerable') vul = val;
          else if (tag === 'Declarer') declarer = val;
          else if (tag === 'Contract') contract = val;
          else if (tag === 'Auction') {
            inAuction = true;
            inPlay = false;
          } else if (tag === 'Play') {
            inPlay = true;
            inAuction = false;
          } else {
            inAuction = false;
            inPlay = false;
          }
        }
      }
    } else {
        // Données en tableau (enchères ou cartes jouées)
        if (inAuction) {
          // Découpe la ligne à chaque espace, puis ignore les morceaux vides (s'il y avait plusieurs espaces consécutifs)
          let bids = line.split(' ').filter((mot) => mot !== '');

          for (let b of bids) {
            if (['+', '*', '-'].includes(b)) continue;
            tokens.push({ type: 'bid', value: b });
          }
        } else if (inPlay) {
          // Idem, on découpe par espace et on ignore le vide
          let cards = line.split(' ').filter((mot) => mot !== '');

          for (let c of cards) {
            if (['+', '*', '-'].includes(c)) continue;
            if (c.length >= 2) {
              let suit = c.charAt(0).toUpperCase();
              let rank = c.substring(1).toUpperCase();
              if (rank === 'T') rank = '10';
              if (['S', 'H', 'D', 'C'].includes(suit)) {
                tokens.push({
                  type: 'play',
                  value: { suit: suit, rank: rank }
                });
              }
            }
          }
      }
    }
  }
  return { initialHands, dealer, declarer, contract, vul, tokens };
}

/**
 * Analyse le contenu d'un fichier LIN (BBO).
 * @param {string} text - Le contenu brut du fichier
 * @returns {Object} Un objet contenant la configuration initiale et la liste des actions (tokens)
 */
function parseLIN(text) {
  let tokens = [];
  let initialHands = {};
  let dealer = 'S';
  let declarer = null;
  let vul = 'None';

  let parts = text.split('|');
  for (let i = 0; i < parts.length; i += 2) {
    let tag = parts[i].trim();
    let val = parts[i + 1] ? parts[i + 1].trim() : '';
    if (!tag) continue;

    // Mains et Donneur
    if (tag === 'md') {
      let d = parseInt(val.charAt(0));
      let dMap = { 1: 'S', 2: 'W', 3: 'N', 4: 'E' };
      dealer = dMap[d] || 'S';
      let handsStr = val.substring(1).split(',');
      let pOrder = ['S', 'W', 'N', 'E'];
      for (let h = 0; h < handsStr.length; h++) {
        let hs = handsStr[h];
        let p = pOrder[h];
        let currentSuit = null;
        let hand = [];
        for (let c = 0; c < hs.length; c++) {
          let char = hs.charAt(c).toUpperCase();
          if (['S', 'H', 'D', 'C'].includes(char)) {
            currentSuit = char;
          } else if (currentSuit && char !== ' ') {
            let rank = char;
            if (rank === 'T') rank = '10';
            hand.push({ suit: currentSuit, rank: rank });
          }
        }
        initialHands[p] = hand;
      }
      // Si la main de l'Est est manquante (fréquent dans les fichiers LIN), on la déduit des autres
      if (handsStr.length === 3) {
        let allRanks = [
          'A',
          'K',
          'Q',
          'J',
          '10',
          '9',
          '8',
          '7',
          '6',
          '5',
          '4',
          '3',
          '2'
        ];
        let eHand = [];
        for (let s of ['S', 'H', 'D', 'C']) {
          for (let r of allRanks) {
            let isFound = false;
            for (let p of ['S', 'W', 'N']) {
              if (
                initialHands[p] &&
                initialHands[p].some((hc) => hc.suit === s && hc.rank === r)
              ) {
                isFound = true;
                break;
              }
            }
            if (!isFound) eHand.push({ suit: s, rank: r });
          }
        }
        initialHands['E'] = eHand;
      }
    }
    // Enchères (Make Bid)
    else if (tag === 'mb') {
      tokens.push({ type: 'bid', value: val });
    }
    // Jeu de la carte (Play Card)
    else if (tag === 'pc') {
      if (val.length >= 2) {
        let suit = val.charAt(0).toUpperCase();
        let rank = val.substring(1).toUpperCase();
        if (rank === 'T') rank = '10';
        tokens.push({ type: 'play', value: { suit: suit, rank: rank } });
      }
    }
    // Commentaires standards
    else if (tag === 'nt') {
      tokens.push({ type: 'comment', value: val });
    }
    // Annonce du nombre de levées (Claim)
    else if (tag === 'mc') {
      tokens.push({ type: 'comment', value: 'Claim : ' + val + ' levées' });
    }
    // Vulnérabilité
    else if (tag === 'sv') {
      let vMap = { o: 'None', n: 'NS', e: 'EW', b: 'All' };
      vul = vMap[val] || 'None';
    }
  }
  return { initialHands, dealer, declarer, contract: null, vul, tokens };
}
