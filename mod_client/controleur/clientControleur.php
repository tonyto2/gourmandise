<?php

class ClientControleur {
    private $parametre = [];
    private $oModele; // propriété de type objet
    private $oVue; // propriété de type objet

    public function __construct($parametre)
    {
        $this->parametre = $parametre;
        $this->oModele = new ClientModele($this->parametre);
        $this->oVue = new ClientVue($this->parametre);
    }

    public function lister() {
        $listeClients = $this->oModele->getListeClient();

        $this->oVue->genererAffichageListe($listeClients);
    }

    public function form_consulter() {
        $unClient = $this->oModele->getUnClient();

        $this->oVue->genererAffichageFiche($unClient);
    }

    public function form_ajouter() {
        $prepareClient = new ClientTable();

        $this->oVue->genererAffichageFiche($prepareClient);
    }

    public function ajouter() {
        // Quel algo ?
        // 1. Contrôler les données en provenance du formulaire
        // Si problème survient alors
        // retour au formulaire de saisie avec erreurs et les données saisies
        // Sinon
        // ecriture en base de données
        // retour sur liste clients
        // avec un message de succès
        $controleClient = new ClientTable($this->parametre);
        if(!$controleClient->getAutorisationBD()) {
            $this->oVue->genererAffichageFiche($controleClient);
        } else {
            // insertion puis retour liste client
            $this->oModele->addClient($controleClient);
            $this->lister();
        }
    }
}