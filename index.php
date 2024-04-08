<?php
require_once "model.php";


// Configuration et initialisation
$pageTitle = "Accueil";
$contentView = "base_view.php";
$activeAccueil = "active";
$additionalMetaTags = '<link rel="stylesheet" href="/css/home_view.css">';
// Vérifier s'il y a une action spécifique dans l'URL
$action = isset($_GET['url']) ? $_GET['url'] : '';

// Déterminer la vue en fonction de l'action
switch ($action) {
    case 'accueil':
        $pageTitle = "Accueil";
        $contentView = "home_view.php";
        $activeAccueil = "active";
        $activeAvion = "";
        $activeContact = "";
        $activeCompte ="";
        $activeLogin = "";
        $additionalMetaTags = '<link rel="stylesheet" href="/css/home_view.css">';
        break;

    case 'avion':
        $pageTitle = "Avions";
        $contentView = "avion.php";
        $activeAccueil = "";
        $activeAvion = "active";
        $activeContact = "";
        $activeCompte ="";
        $activeLogin = "";
        $additionalMetaTags = '<link rel="stylesheet" href="/css/avion.css">';
        break;

    case 'login':
        $pageTitle = "Connexion";
        $contentView = "login.php";
        $activeAccueil = "";
        $activeAvion = "";
        $activeContact = "";
        $activeCompte ="";
        $activeLogin = "active";
        $additionalMetaTags = '<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />';
        $additionalMetaTags .= '<link rel="stylesheet" href="/css/login.css">';
        break;

    case 'contact':
        $pageTitle = "Contact";
        $contentView = "contact.php";
        $activeAccueil = "";
        $activeAvion = "";
        $activeContact = "active";
        $activeCompte ="";
        $activeLogin = "";
        $additionalMetaTags .= '<link rel="stylesheet" href="/css/contact.css">';
        break;
    case'compte':
        if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {
        $pageTitle = $_SESSION['nom']." ".$_SESSION['prenom'];
        }else{
          $pageTitle = "Connectez-vous";  
        }
        $contentView = "compte.php";
        $activeAccueil = "";
        $activeAvion = "";
        $activeContact = "";
        $activeCompte ="active";
        $activeLogin = "";
        $additionalMetaTags .= '<link rel="stylesheet" href="/css/compte.css">';
        break;


    default:
        if (!isset($_GET['url'])) {
            header('Location: index.php?url=accueil');
            exit();
        }
}

// Inclure la vue de base
include 'views/base_view.php';
