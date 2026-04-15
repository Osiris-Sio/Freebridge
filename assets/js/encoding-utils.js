// Utilitaire pour gérer l'encodage des fichiers .lin
window.detectAndFixEncoding = function (str) {
  if (!str) {
    return str
  }

  // Table de correspondance pour les caractères spéciaux
  const charMap = {
    'Ã¨': 'è',
    'Ã©': 'é',
    'Ã ': 'à',
    Ãª: 'ê',
    'Ã«': 'ë',
    'Ã®': 'î',
    'Ã¯': 'ï',
    'Ã´': 'ô',
    'Ã¶': 'ö',
    'Ã¹': 'ù',
    'Ã»': 'û',
    'Ã¼': 'ü',
    'Ã§': 'ç',
    'Å"': 'œ',
    'â€™': "'",
    'â€"': '–',
    'â€': '"',
    'Â°': '°',
    '': '', // Supprime les caractères non reconnus
  }

  try {
    // Première tentative : remplacement direct des séquences connues
    let result = str
    Object.entries(charMap).forEach(([encoded, decoded]) => {
      result = result.replace(new RegExp(encoded, 'g'), decoded)
    })

    // Si la chaîne contient encore des caractères problématiques, essayer une autre méthode
    if (result.includes('')) {
      try {
        // Tentative avec TextDecoder
        const bytes = new Uint8Array(str.split('').map((c) => c.charCodeAt(0)))
        const decoder = new TextDecoder('iso-8859-1')
        result = decoder.decode(bytes)
      } catch {
        // Ignoré
      }
    }

    return result
  } catch {
    return str
  }
}
