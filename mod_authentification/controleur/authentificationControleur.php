<?php

class AuthentificationControleur
{
    private $parametre = [];
    private $oModele; // propriété de type objet
    private $oVue; // propriété de type objet

    public function __construct($parametre)
    {
        $this->parametre = $parametre;
        $this->oModele = new AuthentificationModele($this->parametre);
        $this->oVue = new AuthentificationVue($this->parametre);
    }

    public function form_authentifier()
    {
        $prepareAuthentification = new AuthentificationTable($this->parametre);
        $this->oVue->genererAffichage($prepareAuthentification);
    }

    public function authentifier()
    {
        $controleAuthentification = new AuthentificationTable($this->parametre);

        if(!$controleAuthentification->getAutorisationSession() || !$this->oModele->rechercherVendeur($controleAuthentification)) {
            $this->oVue->genererAffichage($controleAuthentification);
        } else {
            header("Location: index.php");
        }
    }

    public function deconnecter()
    {
        session_destroy();
        $_SESSION = [];
        header("Location: index.php");
    }
}