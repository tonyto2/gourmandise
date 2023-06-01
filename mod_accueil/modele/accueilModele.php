<?php
class AccueilModele extends Modele {
    private $parametre = array();


    function _construct($parametre)
    {
        $this->parametre = $parametre;
    }


    public function caMois()
    {
// Requête attendue de type SELECT
        $sql = "SELECT MONTH(date_livraison) AS mois, SUM(total_ht) AS total_ht FROM commande GROUP BY MONTH(date_livraison)";

        $resultat = $this->executeRequete($sql);

        return $resultat->fetchall(PDO::FETCH_ASSOC);
    }


}
