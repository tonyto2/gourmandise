<?php

class Authentification {
    // MOT DE PASSE COMPTES = sowhat
    private $parametre = []; // tableau = $_REQUEST
    private $oControleur; // objet de la classe Controleur

    public function __construct($parametre) {
        // Initialisation de la propriété parametre
        $this->parametre = $parametre;
        // Création d'un objet, instance de la classe ClientControleur
        $this->oControleur = new AuthentificationControleur($this->parametre);
    }

    public function choixAction() {
        // ici à venir une structure alternative pour tester les différentes actions possibles
        // type switch
        if(isset($this->parametre['action'])) {
            // traitement des différentes actions
            switch($this->parametre['action']) {
                case 'authentifier':
                    $this->oControleur->authentifier();
                    break;
                case 'deconnecter':
                    $this->oControleur->deconnecter();
                    break;
                default:
                    return "Impossible de passer ici. Erreur contactez l'administrateur.";
            }
        } else {
            $this->oControleur->form_authentifier();
        }
    }
}