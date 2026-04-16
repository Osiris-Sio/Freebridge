<?php

/**
 * index.php
 * Point d'entrée de l'application
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chargement des variables d'environnement si nécessaire

// Appel du routeur
require_once 'router.php';
