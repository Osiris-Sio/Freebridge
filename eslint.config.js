import js from '@eslint/js'
import globals from 'globals'
import html from 'eslint-plugin-html'
import prettierConfig from 'eslint-config-prettier'
import prettierPlugin from 'eslint-plugin-prettier'

export default [
  // Configuration de base pour tous les fichiers JS
  {
    files: ['**/*.js'],
    languageOptions: {
      ecmaVersion: 'latest',
      sourceType: 'module',
      globals: {
        ...globals.browser,
        ...globals.node,
      },
    },
    plugins: {
      prettier: prettierPlugin,
    },
    rules: {
      ...js.configs.recommended.rules,
      ...prettierConfig.rules, // Désactive les règles ESLint qui entrent en conflit avec Prettier
      'prettier/prettier': 'error', // Affiche les problèmes Prettier comme des erreurs ESLint

      // Règles strictes personnalisées
      'no-console': 'warn',
      'no-unused-vars': ['error', { argsIgnorePattern: '^_' }],
      eqeqeq: ['error', 'always'], // Force l'utilisation de === et !==
      curly: ['error', 'all'], // Force les accolades pour les blocs if/else
      'no-var': 'error', // Interdit 'var' (utilise 'let' ou 'const')
      'prefer-const': 'error', // Force 'const' si la variable n'est pas réassignée
    },
  },

  // Support du JS dans les fichiers HTML
  {
    files: ['**/*.html'],
    plugins: {
      html,
    },
    settings: {
      'html/html-extensions': ['.html'],
    },
  },

  // Ignorer certains dossiers
  {
    ignores: ['node_modules/', 'dist/', 'vendor/'],
  },
]
