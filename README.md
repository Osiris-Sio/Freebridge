# 🃏 Freebridge

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue.svg)](https://www.php.net/)

**Freebridge** est un site web moderne et complet dédié aux passionnés de bridge. Il combine des cours de bridge, des outils d'analyse et une interface utilisateur simple, mais efficace. Le site est développé en PHP et utilise MySQL comme base de données.

---

## 📝 Contexte / Sujet

Le projet **Freebridge** a été repensé pour offrir aux joueurs de Bridge (du débutant à l'expert) un environnement numérique permettant de :

- **Visualiser** des donnes via un lecteur interactif (Bridge Viewer Web).
- **Analyser** des coups et résoudre des contrats grâce à un moteur de calcul intégré (Bridge Solver).
- **Gérer** un espace personnel sécurisé pour suivre sa progression et ses interactions.
- **Administrer** la plateforme via un panneau de gestion dédié (Gestion).

---

## 📂 Arborescence du Projet

Voici l'organisation structurelle du projet :

```text
Freebridge/
├── app/                    # Cœur de l'application (Architecture MVC)
│   ├── account/            # Profil et paramètres utilisateur
│   ├── contact/            # Formulaire de contact
│   ├── gestion/            # Administration du site (Admin Panel)
│   ├── home/               # Page d'accueil
│   ├── login/              # Connexion d'un membre
│   ├── logout/             # Déconnexion d'un membre
│   ├── lostpassword/       # Réinitialisation du mot de passe
│   └── register/           # Inscription d'un nouveau membre
├── assets/                 # Ressources multimédias (images, pdf, etc.)
├── Bridge_Viewer_Web/      # Module spécialisé de visualisation de donnes
├── bsol/                   # Moteur de calcul "Bridge Solver"
├── css/                    # Feuilles de styles (Custom & Pico CSS variables)
├── includes/               # Composants réutilisables (Header, Footer, DB Connection)
├── js/                     # Logique Frontend (Thèmes, Cookies, UI interactions)
├── pages/                  # Contenu statique et pages d'information
├── .env                    # Configuration des secrets et de la base de données
├── .htaccess               # Configuration du serveur Apache (Rewriting)
├── index.php               # Point d'entrée unique de l'application
├── router.php              # Système de routage personnalisé
├── package.json            # Gestion des dépendances de développement (Linting, Prettier)
└── README.md               # Documentation principale
```

---

## 🚀 Fonctionnalités Clés

- **Système de Thème Dynamique** : Support natif du mode Clair et Sombre.
- **Analyse de Fichiers** : Import et lecture des formats standards `PBN` et `LIN`.
- **Interface UI/UX** : Design épuré utilisant **Pico CSS** avec des petites animations fluides.
- **Sécurité** : Hachage des mots de passe et gestion des sessions sécurisée.

---

## 🛠️ Technologies Utilisées

- **Backend** : PHP 8.x (MVC sans framework lourd)
- **Base de données** : MySQL / MariaDB
- **Frontend** : JavaScript ES6+, Pico CSS
- **Outils** : Prettier, ESLint
- **Analytiques** : GoatCounter

---

## ⚙️ Installation

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/Osiris-Sio/Freebridge.git
   ```
2. **Configurer l'environnement** :
   - Copiez `.env.example` vers `.env`.
   - Remplissez les informations de connexion à votre base de données.
3. **Importer la base de données** :
   - Utilisez le schéma SQL fourni (si disponible) dans votre gestionnaire de base de données.
4. **Déploiement** :
   - Assurez-vous que l'extension `mod_rewrite` est activée sur votre serveur Apache.

---

## 👥 Auteurs

- **Bernard GLORIE** - Initiateur du projet
- **Louis AMEDRO** - Développeur principal ([Voir mes projets](https://github.com/Osiris-Sio))

---

## 📄 Licence

Ce projet est sous licence **MIT**. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
