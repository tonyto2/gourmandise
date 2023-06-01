<?php

class ClientVue {
    private $parametre = [];
    private $tpl; // Propriété de type Objet (smarty)

    public function __construct($parametre) {
        $this->parametre = $parametre;

        $this->tpl = new Smarty();
    }

    public function chargementValeurs() {
        $this->tpl->assign('deconnexion', 'Déconnexion');
        $this->tpl->assign('login', $_SESSION['prenomNom']);
        $this->tpl->assign('titreVue', 'Gourmandise SARL');
    }

    public function genererAffichageListe($listeClients) {
        $this->chargementValeurs();

        $this->tpl->assign('titrePage', 'Liste des clients');
        $this->tpl->assign('listeClients', $listeClients);

        $this->tpl->display('mod_client/vue/clientListeVue.tpl');
    }

    public function genererAffichageFiche($unClient) {
        $this->chargementValeurs();

        switch($this->parametre['action']) {
            case 'form_consulter':
                $this->tpl->assign('action', 'consulter');
                $this->tpl->assign('readonly', 'disabled');
                $this->tpl->assign('titrePage', 'Fiche Client : Consultation');
                break;
            case 'form_ajouter':
            case 'ajouter':
                $this->tpl->assign('action', 'ajouter');
                $this->tpl->assign('readonly', '');
                $this->tpl->assign('titrePage', 'Fiche Client : Création');
        }

        $this->tpl->assign('unClient', $unClient);
        $this->tpl->display('mod_client/vue/clientFicheVue.tpl');
    }
}