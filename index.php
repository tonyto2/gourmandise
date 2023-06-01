<?php
session_start();
require_once 'include/configuration.php';

// gestion = ? client produit profil accueil
// action = ? lister (action par defaut), ajouter, modifier, supprimer, rechercher, trier etc
// action = form_ajouter (appel formulaire vierge), form_consulter (formulaire en consultation)

Autoloader::chargerClasses();

if(!isset($_SESSION['login'])) {
    $_REQUEST['gestion'] = 'authentification';
} elseif(!isset($_REQUEST['gestion'])) {
    $_REQUEST['gestion'] = 'accueil';
}

// Appel du routeur
//require_once 'mod_' . $_REQUEST['gestion'] . '/' . $_REQUEST['gestion'] . '.php';

// Création d'un objet, instance de la classe de type routeur accueil
$oRouteur = new $_REQUEST['gestion']($_REQUEST);
$oRouteur->choixAction();
