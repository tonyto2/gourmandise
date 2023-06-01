<?php

class AuthentificationModele extends Modele
{
    private $parametres = []; // Tableau = $_REQUEST du fichier Index

    public function __construct($parametres)
    {
        $this->parametres = $parametres;
    }

    public function rechercherVendeur(AuthentificationTable $authEnCours)
    {
        $sql = "SELECT * FROM vendeur WHERE login = ?";
        $idRequete = $this->executeRequete($sql, [
            $authEnCours->getLogin()
        ]);

        $authExistant = $idRequete->fetch(PDO::FETCH_ASSOC);

        if ($idRequete->rowCount() == 1 && $authEnCours->getLogin() == $authExistant['login']
            && $authEnCours->getMotdepasse() == $authExistant['motdepasse']) {
            $_SESSION['login'] = $authExistant['login'];
            $_SESSION['prenomNom'] = $authExistant['prenom'] . " " . $authExistant['nom'];
            $_SESSION['codev'] = $authExistant['codev'];
            return true;
        }
        AuthentificationTable::setMessageErreur("L'authentification est invalide. <br />");
        return false;
    }
}