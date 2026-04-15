/* exported convertXML */

function getAttribute(node, attributeName) {
  try {
    const attributes = node.attributes
    return attributes.getNamedItem(attributeName).nodeValue
  } catch {
    return ''
  }
}

function getNodeValue(node) {
  try {
    const childNodes = node.childNodes
    return childNodes[0].nodeValue
  } catch {
    return ''
  }
}

function getNodeValueByName(node, name) {
  try {
    const cnode = node.getElementsByTagName(name)[0]
    const childNodes = cnode.childNodes
    return childNodes[0].nodeValue
  } catch {
    return ''
  }
}

window.convertXML = function (data) {
  const bdindices = []
  let i
  let j
  let tximps = false // true if cross imp fields present for teams events
  const parser = new DOMParser()
  const xmlDoc = parser.parseFromString(data, 'text/xml')
  const evNode = xmlDoc.getElementsByTagName('EVENT')[0]

  getNodeValue(evNode)

  const json = {}
  json.event = {}

  json.event.event_type = getAttribute(evNode, 'EVENT_TYPE')

  if (
    json.event.event_type === 'TEAMS' ||
    json.event.event_type === 'TEAMS_OF_FOUR' ||
    json.event.event_type === 'KO'
  ) {
    json.event.event_type = 'Teams'
  } else if (json.event.event_type === 'SWISS_TEAMS') {
    json.event.event_type = 'Swiss_Teams'
  } else {
    json.event.event_type = 'Pairs'
  }

  if (
    json.event.event_type === 'Teams' ||
    json.event.event_type === 'Swiss_Teams'
  ) {
    const ximpnodes = evNode.getElementsByTagName('NS_CROSS_IMP_POINTS')

    if (ximpnodes.length !== 0) {
      tximps = true
    } // This event contains cross imp information for a Teams event
  }

  json.event.board_scoring_method = ''

  const board_scoring_method = getNodeValueByName(
    evNode,
    'BOARD_SCORING_METHOD',
  )

  if (board_scoring_method === 'MATCH_POINTS') {
    json.event.board_scoring_method = 'MatchPoints'
    json.event.match_scoring_method = 'MatchPoints'
  } else if (
    board_scoring_method === 'IMPS' ||
    board_scoring_method === 'CROSS_IMPS' ||
    board_scoring_method === 'BUTLER_IMPS'
  ) {
    json.event.board_scoring_method = 'IMP'
  } else {
    json.event.board_scoring_method = board_scoring_method
  }

  let pximps = false

  if (
    json.event.event_type === 'Pairs' &&
    json.event.board_scoring_method === 'IMP'
  ) {
    pximps = true
  }

  json.event.winner_type = getNodeValueByName(evNode, 'WINNER_TYPE')

  if (json.event.winner_type.length === 0) {
    json.event.winner_type = 1
  } else {
    json.event.winner_type = Number(json.event.winner_type)
  }

  let participants = {}
  json.event.participants = participants
  const pair = []
  participants.pair = pair

  participants = evNode.getElementsByTagName('PARTICIPANTS')[0]
  const pnodes = participants.getElementsByTagName('PAIR')

  for (i = 0; i < pnodes.length; i++) {
    const cpnode = pnodes[i]
    const cpair = {}

    if (json.event.winner_type === 1) {
      cpair.direction = 'N'
    } else {
      cpair.direction = getNodeValueByName(cpnode, 'DIRECTION').charAt(0)

      if (cpair.direction === '') {
        cpair.direction = 'N'
        json.event.winner_type = 1 // Probably a double howell event, so chage winner_type to 1
      }
    }

    cpair.pair_number = getNodeValueByName(cpnode, 'PAIR_NUMBER')
    cpair.place = getNodeValueByName(cpnode, 'PLACE').replace('=', '')
    cpair.percentage = getNodeValueByName(cpnode, 'PERCENTAGE')
    if (cpair.percentage === '') {
      cpair.percentage = '-'
    } // As used by Scorebridge to indicate percentage N/A
    cpair.total_score = getNodeValueByName(cpnode, 'TOTAL_SCORE') // ****?????

    const playerNodes = cpnode.getElementsByTagName('PLAYER_NAME')
    const players = []
    players[0] = {}
    players[0].player_name = getNodeValue(playerNodes[0])
    players[1] = {}
    players[1].player_name = getNodeValue(playerNodes[1])
    cpair.player = players
    pair.push(cpair)
  }

  const boardNodes = evNode.getElementsByTagName('BOARD')

  const board = []
  json.event.board = board

  for (i = 0; i < boardNodes.length; i++) {
    const cnode = boardNodes[i]
    const boardno = getNodeValueByName(cnode, 'BOARD_NUMBER')
    let cboard
    let tlines

    if (typeof bdindices[boardno] !== 'undefined') {
      cboard = bdindices[boardno]
      tlines = cboard.traveller_line
    } else {
      cboard = {}
      cboard.board_no = boardno
      bdindices[boardno] = cboard
      tlines = []
      cboard.traveller_line = tlines
      board.push(cboard)
    }

    const nodeTlines = cnode.getElementsByTagName('TRAVELLER_LINE')

    for (j = 0; j < nodeTlines.length; j++) {
      const cnTline = nodeTlines[j]
      const tline = {}

      tline.lead = getNodeValueByName(cnTline, 'LEAD') // Should reverse this
      tline.contract = getNodeValueByName(cnTline, 'CONTRACT')
      tline.lindata = getNodeValueByName(cnTline, 'LIN_DATA')

      if (tline.contract.length !== 0) {
        if (tline.contract.toUpperCase() === 'PASSED') {
          tline.contract = 'Passed'
        }
      }

      const score = getNodeValueByName(cnTline, 'SCORE')

      tline.score = score

      if (score > 0) {
        tline.ns_score = score
        tline.ew_score = ''
      } else {
        tline.ew_score = -score
        tline.ns_score = ''
      }

      if (!pximps) {
        tline.ns_match_points = getNodeValueByName(cnTline, 'NS_MATCH_POINTS')
        tline.ew_match_points = getNodeValueByName(cnTline, 'EW_MATCH_POINTS')
      } else {
        tline.ns_match_points = getNodeValueByName(
          cnTline,
          'NS_CROSS_IMP_POINTS',
        )
        tline.ew_match_points = getNodeValueByName(
          cnTline,
          'EW_CROSS_IMP_POINTS',
        )

        if (tline.ns_match_points === '') {
          // No Cross-Imps, so assume Butler Imps
          tline.ns_match_points = getNodeValueByName(
            cnTline,
            'NS_BUTLER_POINTS',
          )
          tline.ew_match_points = getNodeValueByName(
            cnTline,
            'EW_BUTLER_POINTS',
          )
        }
      }

      if (tximps) {
        tline.ns_cross_imp_points = getNodeValueByName(
          cnTline,
          'NS_CROSS_IMP_POINTS',
        )
        tline.ew_cross_imp_points = getNodeValueByName(
          cnTline,
          'EW_CROSS_IMP_POINTS',
        )
      }

      tline.ns_pair_number = getNodeValueByName(cnTline, 'NS_PAIR_NUMBER')
      tline.played_by = getNodeValueByName(cnTline, 'PLAYED_BY')
      tline.tricks = getNodeValueByName(cnTline, 'TRICKS')
      tline.ew_pair_number = getNodeValueByName(cnTline, 'EW_PAIR_NUMBER')
      tlines.push(tline)
    }
  }

  json.event.board.sort(function (a, b) {
    try {
      if (Number(a.board_no) > Number(b.board_no)) {
        return 1
      } else if (Number(a.board_no) === Number(b.board_no)) {
        return 0
      } else {
        return -1
      }
    } catch {
      return 0
    } // if non-numeric board number
  })

  return JSON.stringify(json)
}
