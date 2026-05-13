/**
 * Analyseurs de fichiers Bridge (PBN et LIN).
 */

/* global PLAYERS */
/* exported parsePBN, parseLIN */

/**
 * Analyse un fichier PBN.
 */
function parsePBN(text) {
  const tokens = []
  const lines = text.replaceAll('\r\n', '\n').split('\n')
  const initialHands = {}
  let dealer = 'N',
    declarer = null,
    contract = null,
    vul = 'None'
  let inAuction = false,
    inPlay = false

  for (let line of lines) {
    line = line.trim()
    if (!line || line.startsWith('%')) {
      continue
    }

    // Extraction des commentaires { ... }
    const startComment = line.indexOf('{'),
      endComment = line.indexOf('}')
    if (startComment !== -1 && endComment !== -1) {
      tokens.push({
        type: 'comment',
        value: line.substring(startComment + 1, endComment).trim(),
      })
      line = (
        line.substring(0, startComment) + line.substring(endComment + 1)
      ).trim()
    }

    if (line.startsWith('[')) {
      const match = line.match(/\[(\w+)\s+"([^"]+)"\]/)
      if (match) {
        const [, tag, val] = match
        if (tag === 'Deal') {
          const [start, handsStr] = val.split(':')
          const hands = handsStr.split(' ')
          const idx = PLAYERS.indexOf(start)
          PLAYERS.forEach((_, i) => {
            const p = PLAYERS[(idx + i) % 4]
            const suits = (hands[i] === '-' ? '...' : hands[i]).split('.')
            const hand = []
            'SHDC'.split('').forEach((s, si) => {
              ;(suits[si] || '')
                .split('')
                .forEach((r) =>
                  hand.push({ suit: s, rank: r === 'T' ? '10' : r }),
                )
            })
            initialHands[p] = hand
          })
        } else if (tag === 'Dealer') {
          dealer = val
        } else if (tag === 'Vulnerable') {
          vul = val
        } else if (tag === 'Declarer') {
          declarer = val
        } else if (tag === 'Contract') {
          contract = val
        } else if (tag === 'Auction') {
          inAuction = true
          inPlay = false
        } else if (tag === 'Play') {
          inPlay = true
          inAuction = false
        } else {
          inAuction = inPlay = false
        }
      }
    } else {
      const items = line
        .split(/\s+/)
        .filter((i) => i && !['+', '*', '-'].includes(i))
      items.forEach((item) => {
        if (inAuction) {
          tokens.push({ type: 'bid', value: item })
        } else if (inPlay && item.length >= 2) {
          const suit = item[0].toUpperCase()
          const rank = item.substring(1).toUpperCase()
          if (['S', 'H', 'D', 'C'].includes(suit)) {
            tokens.push({
              type: 'play',
              value: { suit, rank: rank === 'T' ? '10' : rank },
            })
          }
        }
      })
    }
  }
  return { initialHands, dealer, declarer, contract, vul, tokens }
}

/**
 * Analyse un fichier LIN (BBO).
 */
function parseLIN(text) {
  const tokens = []
  const initialHands = {}
  let dealer = 'S',
    vul = 'None'

  const parts = text.split('|')
  for (let i = 0; i < parts.length; i += 2) {
    const tag = parts[i].trim(),
      val = parts[i + 1]?.trim() || ''
    if (!tag) {
      continue
    }

    if (tag === 'md') {
      const dMap = { 1: 'S', 2: 'W', 3: 'N', 4: 'E' }
      dealer = dMap[val[0]] || 'S'
      const handsStr = val.substring(1).split(',')
      const pOrder = ['S', 'W', 'N', 'E']

      handsStr.forEach((hs, hIdx) => {
        const p = pOrder[hIdx]
        let suit = null
        const hand = []
        hs.toUpperCase()
          .split('')
          .forEach((char) => {
            if ('SHDC'.includes(char)) {
              suit = char
            } else if (suit && char !== ' ') {
              hand.push({ suit, rank: char === 'T' ? '10' : char })
            }
          })
        initialHands[p] = hand
      })

      // Déduction de la main manquante (Est est souvent omis en LIN)
      if (handsStr.length === 3) {
        const all = [
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
          '2',
        ]
        const eHand = []
        'SHDC'.split('').forEach((s) => {
          all.forEach((r) => {
            if (
              !['S', 'W', 'N'].some((p) =>
                initialHands[p].some((c) => c.suit === s && c.rank === r),
              )
            ) {
              eHand.push({ suit: s, rank: r })
            }
          })
        })
        initialHands['E'] = eHand
      }
    } else if (tag === 'mb') {
      tokens.push({ type: 'bid', value: val })
    } else if (tag === 'pc' && val.length >= 2) {
      tokens.push({
        type: 'play',
        value: {
          suit: val[0].toUpperCase(),
          rank:
            val.substring(1).toUpperCase() === 'T'
              ? '10'
              : val.substring(1).toUpperCase(),
        },
      })
    } else if (tag === 'nt') {
      tokens.push({ type: 'comment', value: val })
    } else if (tag === 'mc') {
      tokens.push({ type: 'comment', value: `Claim : ${val} levées` })
    } else if (tag === 'sv') {
      const vMap = { o: 'None', n: 'NS', e: 'EW', b: 'All' }
      vul = vMap[val] || 'None'
    }
  }
  return { initialHands, dealer, declarer: null, contract: null, vul, tokens }
}
