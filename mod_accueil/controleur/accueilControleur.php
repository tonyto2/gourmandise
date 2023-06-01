<?php

class AccueilControleur
{

    private $parametre = [];
    private $oVue; // propriété de type objet

    public function __construct($parametre)
    {
        $this->parametre = $parametre;
        // chargement, appel de la vue
//        require_once 'mod_accueil/vue/accueilVue.php';
        $this->oModele = new AccueilModele($parametre);
        $this->oVue = new AccueilVue($this->parametre);
    }

    public function lister() {

        $this->oVue->genererAffichageListe();
    }


    public function charts(){

        $valeurs = $this->oModele->caMois();
        $this->oVue->genererCamois($valeurs);
}
}