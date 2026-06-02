# 🃏 Freebridge

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-blue.svg)](https://www.php.net/)

**Freebridge** est un site web moderne et complet dédié aux passionnés de bridge. Il combine des cours de bridge, des outils d'analyse et une interface utilisateur simple, mais efficace. Le site est développé en PHP et utilise MySQL comme base de données.

Ce projet a été réalisé dans le cadre d'un stage, du 13 avril au 5 juin 2026.

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
├── tools/                  # Scripts d'installation et de configuration (Base de données)
├── .env                    # Configuration des secrets et de la base de données
├── .htaccess               # Configuration du serveur Apache (Rewriting)
├── eslint.config.js        # Configuration des règles ESLint
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

## 📚 Guide de Développement / Ajout de Contenu

### Ajouter un cours PDF

Pour ajouter un nouveau cours au format PDF sur le site :
1. **Ajouter le fichier** : Placez votre fichier PDF dans le dossier approprié des ressources, par exemple `assets/pdf/debuter/nouveau_cours.pdf`.
2. **Modifier la page PHP (ex: `bsol/Debuter/debutant.php`)** : Intégrez le document en créant un lien d'ouverture :
   ```html
   <a href="assets/pdf/debuter/nouveau_cours.pdf" class="lesson-item" target="_blank">
       <i class="fas fa-chalkboard-teacher"></i> Nouveau cours de bridge
   </a>
   ```

### Fonctionnement d'une page PHP simple (sans contrôleur)

Une page "simple" est utilisée pour afficher du contenu statique ou purement informatif, sans logique métier complexe.
- Elle se trouve généralement dans le dossier `pages/` (ex: `pages/mentionslegales_view.php`).
- Le code intègre l'en-tête, le contenu HTML central et le pied de page.

**Exemple concret (`pages/mentionslegales_view.php`) :**
```php
<?php include 'includes/header.php'; ?>

<article>
    <header>
        <h1>Mentions légales</h1>
    </header>
    <p>Conformément aux dispositions des articles 6-III et 19 de la Loi...</p>
</article>

<!-- Autre contenu statique HTML ... -->

<?php include 'includes/footer.php'; ?>
```

### Fonctionnement d'une page PHP complexe (MVC : Modèle, Vue, Contrôleur)

Une page "complexe" nécessite des traitements avancés (vérifications, formulaires, base de données) et suit une architecture modulaire. Ces pages se situent dans le dossier `app/` (par exemple `app/login/`).

1. **Le Routeur (`router.php`)** : Il analyse l'URL demandée et inclut le contrôleur de la fonctionnalité correspondante.
2. **Le Contrôleur (`app/login/controllers/login_controller.php`)** :
   - Vérifie les autorisations et traite les requêtes `$_POST`.
   - Intéragit avec la base de données.
   - Prépare les variables puis inclut la vue.
   ```php
   <?php
   // app/login/controllers/login_controller.php
   
   // Si l'utilisateur est déjà connecté, on le redirige
   if (isset($_SESSION['user_id'])) {
     header('Location: home');
     exit();
   }
   
   // Traitement du formulaire de connexion
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $login = strtolower(trim($_POST['login'] ?? ''));
     $password = $_POST['password'] ?? '';
     
     // Logique de vérification en base de données et connexion...
   }
   
   // Chargement de la vue
   require 'app/login/views/login_view.php';
   ```
3. **La Vue (`app/login/views/login_view.php`)** : C'est le fichier qui prend en charge le rendu final en affichant le formulaire de connexion. Il ne traite pas les requêtes, et inclut le `header.php` et le `footer.php`.

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
   - Importez le fichier `tools/bdd.sql` dans votre gestionnaire de base de données (ou utilisez les scripts PHP fournis dans le dossier `tools/`).
4. **Déploiement** :
   - Assurez-vous que l'extension `mod_rewrite` est activée sur votre serveur Apache.
   - _(Optionnel pour le développement)_ : Exécutez `npm install` pour profiter des outils de formatage (Prettier/ESLint).

---

## 👥 Auteurs

- **Bernard GLORIE** - Initiateur du projet
- **Louis AMEDRO** - Développeur principal (stagiaire) ([Voir mes projets](https://github.com/Osiris-Sio))

---

## 📄 Licence

Ce projet est sous licence **MIT**. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
