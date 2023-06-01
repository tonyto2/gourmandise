<?php

class AuthentificationVue {
    private $parametre = [];
    private $tpl; // Propriété de type Objet (smarty)

    public function __construct($parametre) {
        $this->parametre = $parametre;

        $this->tpl = new Smarty();
    }

    public function genererAffichage($valeurs) {
        $this->tpl->assign('titreVue', 'GOURMANDISE SARL');
        $this->tpl->assign('action', 'authentifier');
        $this->tpl->assign('unVendeur', $valeurs);

        $this->tpl->display('mod_authentification/vue/authentificationVue.tpl');
    }
}