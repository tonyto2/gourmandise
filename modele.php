<?php
/**
 * Classe abstraite (non instanciable).
 * Elle gère la connexion à la base de données et
 * l'exécution des requêtes simples ou préparées
 */
abstract class Modele {
	/**
	 * @var object cnx  Identifiant de connexion
	 */
	private $cnx; 
	
	/**
	 * 
	 * @param chaine $sql de caractères $sql Contient la requête à exécuter
	 * @param array $parametre paramètre optionnel
	 * @return object $resultat Identifiant de requête
	 */
	protected function executeRequete($sql, $parametre = NULL) {
		if ($parametre == NULL) {
			
			$resultat= $this->getBD()->query($sql); //Requête simple
			
		} else {

			$resultat = $this->getBD()->prepare($sql); // requête préparée
			
			$resultat->execute($parametre);
		}

		return $resultat;
	}

	/**
	 * 
	 * @return object Identifiant de connexion à MySQL
	 */
	private function getBD() {

		if ($this->cnx == NULL) {

			$this->cnx = new PDO('mysql:host=' . SERVEUR . ';dbname=' . BASE, NOM, PASSE, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			
		}
		
		return $this->cnx;
	}

}
