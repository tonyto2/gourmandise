<?php
/*
 * Role: routeur pour le client
 */
class Client {
    private $parametre = []; // tableau = $_REQUEST
    private $oControleur; // objet de la classe Controleur

    public function __construct($parametre) {
        // Initialisation de la propriété parametre
        $this->parametre = $parametre;
        // Création d'un objet, instance de la classe ClientControleur
        $this->oControleur = new ClientControleur($this->parametre);
    }

    public function choixAction() {
        // ici à venir une structure alternative pour tester les différentes actions possibles
        // type switch
        if(isset($this->parametre['action'])) {
            // traitement des différentes actions
            switch($this->parametre['action']) {
                case 'form_consulter':
                    $this->oControleur->form_consulter();
                    break;
                case 'form_ajouter':
                    $this->oControleur->form_ajouter();
                    break;
                case 'ajouter':
                    $this->oControleur->ajouter();
                    break;
                default:
                    return "Impossible de passer ici. Erreur contactez l'administrateur.";
            }
        } else {
            $this->oControleur->lister();
        }
    }
}