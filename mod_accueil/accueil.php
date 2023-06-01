<?php

/*
 * Routeur de la classe Accueil
 */

class Accueil
{

    private $parametre = []; // tableau = $_REQUEST
    private $oControleur; // objet de la classe Controleur

    public function __construct($parametre)
    {
        // Initialisation de la propriété parametre
        $this->parametre = $parametre;
        // Appel du controller
//        require_once 'mod_accueil/controleur/accueilControleur.php';
        // Création d'un objet, instance de la classe AccueilControleur
        $this->oControleur = new AccueilControleur($this->parametre);
    }

    public function choixAction()
    {
        // ici à venir une structure alternative pour tester les différentes actions possibles
        // type switch
        if (isset($this->parametre['action'])) {

            switch ($this->parametre['action']) {
                case 'generer_stats' :
                    $this->oControleur->charts();
                    break;
            }
        } else {

            $this->oControleur->lister();
        }
    }
}