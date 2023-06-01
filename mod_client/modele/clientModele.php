<?php

class ClientModele extends Modele
{

    private $parametres = []; // Tableau = $_REQUEST du fichier Index

    public function __construct($parametres)
    {
        $this->parametres = $parametres;
    }

    public function getListeClient()
    {
        $sql = "SELECT * FROM client";

        $idRequete = $this->executeRequete($sql);

        if ($idRequete->rowCount() > 0) {
            while ($row = $idRequete->fetch(PDO::FETCH_ASSOC)) {
                $listeClients[] = new ClientTable($row);
            }

            return $listeClients;
        } else {
            return null;
        }
    }

    public function getUnClient()
    {
        $sql = "SELECT * FROM client WHERE codec = ?";
        $idRequete = $this->executeRequete($sql, [$this->parametres['codec']]);

        return new ClientTable($idRequete->fetch(PDO::FETCH_ASSOC));
    }

    public function addClient(ClientTable $client)
    {
        $sql = "INSERT INTO client (nom, adresse, cp, ville, telephone) VALUES (?, ?, ?, ?, ?)";
        $idRequete = $this->executeRequete($sql, [$client->getNom(), $client->getAdresse(), $client->getCp(), $client->getVille(), $client->getTelephone()]);

        if($idRequete) {
            ClientTable::setMessageSucces("Création du client réussie. <br />");
        }
    }

}