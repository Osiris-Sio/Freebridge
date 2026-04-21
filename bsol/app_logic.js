/**
 * Bridge Solver Online - Logique de l'application
 * Extraction des paramètres de l'URL et gestion du chargement des fichiers
 */

/**
 * Récupère le nom du paramètre à partir du tableau des paramètres de l'URL
 * @param {Array} parameters - Tableau de chaînes de paramètres
 * @param {number} i - Index dans le tableau
 * @returns {string} Nom du paramètre
 */
function getParaName(parameters, i) {
  const temp = parameters[i].split('=')
  return unescape(temp[0])
}

/**
 * Récupère la valeur du paramètre à partir du tableau des paramètres de l'URL
 * @param {Array} parameters - Tableau de chaînes de paramètres
 * @param {number} i - Index dans le tableau
 * @returns {string} Valeur du paramètre
 */
function getPara(parameters, i) {
  const temp = parameters[i].split('=')
  const pname = unescape(temp[0])
  let l = unescape(temp[1])

  if (l.length >= 2) {
    if (l.charAt(0) === '"') {
      l = l.substr(1, l.length)
    }
    if (l.charAt(l.length - 1) === '"') {
      l = l.substr(0, l.length - 1)
    }
  }

  return l
}

/**
 * Identifie la langue/le jeu de cartes d'honneur (Anglais, Français, Néerlandais, Allemand)
 * @param {string} str - Chaîne contenant les données de la main
 * @returns {string} Langue identifiée
 */
function identifyHonourCardSet(str) {
  let lang = 'english'

  if (str.indexOf('R') !== -1) lang = 'french'
  else if (str.indexOf('H') !== -1) lang = 'dutch'
  else if (str.indexOf('D') !== -1) lang = 'german'

  return lang
}

/**
 * Convertit les caractères des cartes d'honneur en JQKA standard
 * @param {string} str - Chaîne de la main
 * @param {string} lang - Langue détectée
 * @returns {string} Chaîne convertie
 */
function convertToJQKA(str, lang) {
  if (lang === 'french') {
    str = str.replace(/V/g, 'J')
    str = str.replace(/D/g, 'Q')
    str = str.replace(/R/g, 'K')
  } else if (lang === 'german') {
    str = str.replace(/B/g, 'J')
    str = str.replace(/D/g, 'Q')
  } else if (lang === 'dutch') {
    str = str.replace(/B/g, 'J')
    str = str.replace(/V/g, 'Q')
    str = str.replace(/H/g, 'K')
  }

  return str
}

/**
 * Extrait tous les paramètres de la chaîne de requête de l'URL
 * @returns {Object|boolean} Objet contenant les données du plateau ou false si aucun paramètre
 */
function extractParas() {
  const validDealers = 'NSEW'
  let i
  const pStr = location.search

  if (pStr.length === 0) return false // No parameters

  const params = location.search.substring(1).split('&')

  const result = {}
  result.boards = []

  const board = {}
  const deal = []
  let ddPresent = false
  let jsonlin = ''

  for (i = 0; i < params.length; i++) {
    const pname = getParaName(params, i).toLowerCase()
    const pvalue = getPara(params, i)

    if (pname === 'board') {
      if (pvalue.length > 15) {
        alert('Board parameter value is too long (maximum 15 characters)')
        return ''
      }
      board.board = pvalue
    } else if (pname === 'dealer') {
      const upperVal = pvalue.toUpperCase()
      if (upperVal.length !== 1) {
        alert('Invalid value for Dealer parameter (must be single character)')
      } else {
        const index = validDealers.indexOf(upperVal)
        if (index === -1) {
          alert('Invalid value for Dealer Parameter - must be one of N,S,E,W')
          return ''
        }
      }
      board.Dealer = upperVal
    } else if (pname === 'vul') {
      let upperVal = pvalue.toUpperCase()
      if (
        upperVal !== 'NS' &&
        upperVal !== 'EW' &&
        upperVal !== 'ALL' &&
        upperVal !== 'NONE'
      ) {
        alert('Invalid vulnerability - must be one of NS,EW,All, or None')
        return ''
      }

      if (upperVal === 'ALL' || upperVal === 'BOTH') upperVal = 'All'
      if (upperVal === 'NONE') upperVal = 'None'

      board.Vulnerable = upperVal
    } else if (pname === 'north') deal[0] = pvalue.toUpperCase()
    else if (pname === 'east') deal[1] = pvalue.toUpperCase()
    else if (pname === 'south') deal[2] = pvalue.toUpperCase()
    else if (pname === 'west') deal[3] = pvalue.toUpperCase()
    else if (pname === 'contract') {
      let contractVal = pvalue.toUpperCase()
      contractVal = contractVal.replace(/X/g, 'x').replace(/\*/g, 'x')
      if (validateContract(contractVal)) board.Contract = contractVal
    } else if (pname === 'declarer') {
      const upperVal = pvalue.toUpperCase()
      if (upperVal.length === 1 && validDealers.indexOf(upperVal) !== -1) {
        board.Declarer = upperVal
      }
    } else if (pname === 'title') {
      result.Title = pvalue
    } else if (pname === 'analyse') {
      if (pvalue.toUpperCase() === 'TRUE') result.forceAnalyse = 1
    } else if (pname === 'dd') {
      const lowerVal = pvalue.toLowerCase()
      if (lowerVal.length !== 20) {
        alert('Double Dummy Tricks parameter must be 20 characters long')
        return ''
      }

      const substr = lowerVal.replace(/[^1234567890abcd\-\*]/g, '')
      if (substr.length !== lowerVal.length) {
        alert(
          'Double Dummy parameter value may only contain the characters 0 to 9, a to d, A to D, -, and *',
        )
        return ''
      }

      let fullInfo = 0
      for (let j = 0; j < 20; j++) {
        if (lowerVal.charAt(j) > '1' && lowerVal.charAt(j) < '7') {
          fullInfo = 1
          break
        }
      }

      let pvalue2 = ''
      for (let j = 0; j < 20; j++) {
        if (fullInfo === 0) {
          if (lowerVal.charAt(j) < '7') pvalue2 = pvalue2.concat('-')
          else pvalue2 = pvalue2.concat(lowerVal.charAt(j))
        } else pvalue2 = pvalue2.concat(lowerVal.charAt(j))
      }

      board.DoubleDummyTricks = pvalue2
      ddPresent = true
    } else if (pname === 'optimumscore') {
      board.OptimumScore = pvalue
    } else if (pname === 'leadcard') {
      const upperVal = pvalue.toUpperCase()
      let validCard = true

      if (upperVal.length !== 2) {
        validCard = false
      } else {
        const cvalue = upperVal.charAt(0)
        const cards = '23456789TJQKA'
        if (cards.indexOf(cvalue) === -1) {
          validCard = false
        } else {
          const suit = 'CHDS'
          if (suit.indexOf(upperVal.charAt(1)) === -1) validCard = false
        }
      }

      if (validCard) {
        const pvalue2 = upperVal.charAt(1).concat(upperVal.charAt(0))
        const played = [pvalue2]
        board.Played = played
        board.Bids = []
      }
    } else if (pname === 'lin') {
      result.lin = pvalue
    } else if (pname === 'eventid' || pname === 'event') {
      result.event = pvalue
    } else if (pname === 'club') {
      result.club = pvalue
    } else if (pname === 'pair_number') {
      result.pair_number = pvalue
    } else if (pname === 'direction') {
      result.direction = pvalue
    } else if (pname === 'compare') {
      result.compare = 1
    } else if (pname === 'file') {
      result.file = pvalue
    } else if (pname === 'xml') {
      result.xml = pvalue
    } else if (pname === 'sessid') {
      result.sessid = pvalue
    } else if (pname === 'msec') {
      result.msec = pvalue
    } else if (pname === 'display') {
      const lowerVal = pvalue.toLowerCase()
      if (
        lowerVal !== 'allpairs' &&
        lowerVal !== 'personal' &&
        lowerVal !== 'board'
      ) {
        alert(
          'value of "display" parameter, when present, must be "allpairs", "personal", or "board"',
        )
      } else {
        result.display = lowerVal
      }
    } else if (pname === 'analysis') {
      result.analysis = pvalue.toLowerCase()
    } else if (pname === 'debug') {
      if (pvalue === 'true') result.debug = pvalue
    } else if (pname === 'jsonlin') {
      jsonlin = pvalue
    }
  }

  if (jsonlin === '') {
    if (!ddPresent) board.DoubleDummyTricks = '********************'

    board.Deal = deal
    result.boards[0] = board

    if (
      typeof result.file === 'undefined' &&
      typeof result.lin === 'undefined'
    ) {
      const dealstr = deal[0] + deal[1] + deal[2] + deal[3]
      const lang = identifyHonourCardSet(dealstr)
      deal[0] = convertToJQKA(deal[0], lang)
      deal[1] = convertToJQKA(deal[1], lang)
      deal[2] = convertToJQKA(deal[2], lang)
      deal[3] = convertToJQKA(deal[3], lang)

      if (validateBoard(board) === 0) return ''
    }

    if (
      typeof board.Declarer === 'undefined' ||
      typeof board.Contract === 'undefined'
    ) {
      delete board.Declarer
      delete board.Contract
      delete board.Played
      delete board.Bids
    }
  } else {
    const boardFromJson = JSON.parse(jsonlin)
    result.boards[0] = boardFromJson
    if (validateBoard(boardFromJson) === 0) return ''
  }

  return result
}

/**
 * Valide une chaîne de contrat de bridge
 * @param {string} pvalue - Chaîne du contrat (ex: "3NT")
 * @returns {boolean} True si valide
 */
function validateContract(pvalue) {
  const suits = 'NSHDC'
  if (pvalue.length > 5) return false

  const level = pvalue.charAt(0)
  if (level < '1' || level > '7') return false
  if (suits.indexOf(pvalue.charAt(1)) === -1) return false

  return true
}

/**
 * Vérifie si une donne est valide (syntaxe uniquement)
 * @param {Object} board - Objet du plateau
 * @param {number} polarity - 0:Nord, 1:Est, 2:Sud, 3:Ouest
 * @returns {number} 1 si valide, 0 sinon
 */
function checkDeal(board, polarity) {
  const directions = ['North', 'East', 'South', 'West']
  const dirName = directions[polarity]
  const str = board.Deal[polarity].replace(/[23456789TAJQK]/g, '')
  const str2 = str.replace(/\./g, '')

  if (str2.length !== str.length - 3) {
    alert(dirName + ' Hand does not contain exactly 3 suit separators')
    return 0
  }
  if (str2.length !== 0) {
    alert(dirName + ' Hand contains invalid characters')
    return 0
  }
  return 1
}

/**
 * Vérifie les cartes en double dans l'ensemble de la donne
 * @param {Object} board - Objet du plateau
 * @returns {number} 1 si valide, 0 sinon
 */
function checkForDuplicates(board) {
  const cvalues = '23456789TJQKA'
  const cardsFound = Array.from({ length: 4 }, () => new Array(13).fill(0))

  for (let i = 0; i < 4; i++) {
    const hand = board.Deal[i].split('.')
    for (let j = 0; j < 4; j++) {
      for (let k = 0; k < hand[j].length; k++) {
        const cardIndex = cvalues.indexOf(hand[j][k])
        if (cardsFound[j][cardIndex] !== 0) {
          alert('Invalid Deal - duplicate card detected')
          return 0
        }
        cardsFound[j][cardIndex]++
      }
    }
  }

  return 1
}

/**
 * Validation complète d'un objet plateau
 * @param {Object} board - Objet du plateau
 * @returns {number} 1 si valide, 0 sinon
 */
function validateBoard(board) {
  if (typeof board.board === 'undefined') {
    alert('Board Number not specified')
    return 0
  }
  if (typeof board.Dealer === 'undefined') {
    alert('Dealer not specified')
    return 0
  }
  if (typeof board.Vulnerable === 'undefined') {
    alert('Vulnerability not specified')
    return 0
  }
  if (
    typeof board.Deal[0] === 'undefined' ||
    typeof board.Deal[1] === 'undefined' ||
    typeof board.Deal[2] === 'undefined' ||
    typeof board.Deal[3] === 'undefined'
  ) {
    alert('One or more hands not specified')
    return 0
  }

  for (let i = 0; i < 4; i++) {
    if (checkDeal(board, i) === 0) return 0
  }

  if (checkForDuplicates(board) === 0) return 0

  return 1
}

/**
 * Crée un plateau vide pour la saisie manuelle
 */
function createEmptyBoard() {
  const result = {
    boards: [
      {
        board: '1',
        Vulnerable: 'None',
        Dealer: 'N',
        Deal: ['...', '...', '...', '...'],
        DoubleDummyTricks: '********************',
      },
    ],
  }

  document.getElementById('form1').style.display = 'none'
  const options =
    "{'options':{'ns':['true','false','false'],'ew':['true','false','false'],'mk':['true','false'],'auto':'true'}}"
  buildPage(result, options)
}

/**
 * Lit le contenu texte d'un fichier (PBN, LIN, DLM)
 * @param {File} file - Objet fichier
 */
function readText(file) {
  const reader = new FileReader()
  reader.onload = function (e) {
    const result = {
      handstr: e.target.result,
      board: 1,
    }

    const filename = file.name.toUpperCase()
    if (filename.endsWith('.PBN')) result.handstrType = 'pbn'
    else if (filename.endsWith('.LIN')) result.handstrType = 'lin'
    else result.handstrType = 'dlm'

    document.getElementById('form1').style.display = 'none'
    const options =
      "{'options':{'ns':['true','false','false'],'ew':['true','false','false'],'mk':['true','false'],'auto':'true'}}"
    buildPage(result, options)
  }
  reader.readAsText(file)
}

/**
 * Gère la sélection de fichier pour charger les donnes
 * @param {Event} evt - Événement de changement
 */
function handleLoadFileSelect(evt) {
  const files = evt.target.files
  if (files.length > 0) {
    const infile = files[0]
    const name = infile.name.toUpperCase()
    if (
      name.endsWith('.PBN') ||
      name.endsWith('.LIN') ||
      name.endsWith('.DLM')
    ) {
      readText(infile)
      evt.target.value = null
    } else {
      alert('Not a PBN, LIN, or DLM file')
    }
  }
}

/**
 * Processus initial pour gérer les paramètres de l'URL ou afficher le chargeur de fichier
 */
function processRequest() {
  const result = extractParas()

  if (result === false) {
    document.getElementById('form1').style.display = 'block'
    const loadfilectl = document.getElementById('loadFile')
    loadfilectl.addEventListener('change', handleLoadFileSelect, false)
    return
  }

  if (result !== '') {
    const options =
      "{'options':{'ns':['true','false','false'],'ew':['true','false','false'],'mk':['true','false'],'auto':'true'}}"
    buildPage(result, options)
  }

  window.focus()
}
