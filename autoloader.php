<?php

class Autoloader {

    public static function chargerClasses() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($maClasse) {
        // premier caractere en minuscule pour le nom de la classe
        $maClasse = lcfirst($maClasse);

        $repertoires = [
            'mod_accueil/',
            'mod_accueil/controleur/',
            'mod_accueil/modele/',
            'mod_accueil/vue/',
            'mod_client/',
            'mod_client/controleur/',
            'mod_client/modele/',
            'mod_client/vue/',
            'mod_authentification/',
            'mod_authentification/controleur/',
            'mod_authentification/modele/',
            'mod_authentification/vue/',
        ];

        foreach ($repertoires as $repertoire) {
            // vérifier si un script php existe dans le répertoire
            if(file_exists($repertoire.$maClasse.'.php')) {
                require_once($repertoire.$maClasse.'.php');
                return;
            }
        }
    }
}