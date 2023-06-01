<?php

class ClientTable {
    private $codec = "";
    private $nom = "";
    private $adresse = "";
    private $cp = "";
    private $ville = "";
    private $telephone = "";
    private $autorisationBD = true;

    private static $messageErreur = "";
    private static $messageSucces = "";

    public function __construct($data = null) {
        if($data != null) {
            $this->hydrater($data);
        }
    }

    public function hydrater(Array $rows) {
        foreach($rows as $k => $v) {
            // Concaténation du préfixe set et du nom de la propriété avec la première lettre en majuscule
            $setter = 'set' . ucfirst($k);
            if(method_exists($this, $setter)) {
                // On appelle la méthode
                $this->$setter($v);
            }
        }
    }

    // GETTERS / SETTERS

    /**
     * @return string
     */
    public static function getMessageSucces(): string
    {
        return self::$messageSucces;
    }

    /**
     * @param string $messageSucces
     */
    public static function setMessageSucces(string $messageSucces): void
    {
        self::$messageSucces = self::$messageSucces . $messageSucces;
    }

    /**
     * @return string
     */
    public static function getMessageErreur(): string
    {
        return self::$messageErreur;
    }

    /**
     * @param string $messageErreur
     */
    public static function setMessageErreur(string $messageErreur): void
    {
        self::$messageErreur = self::$messageErreur . $messageErreur;
    }

    public function getCodec() {
        return $this->codec;
    }

    public function setCodec($codec) {
        $this->codec = $codec;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        if(empty($nom) || ctype_space(strval($nom))) {
            $this->setAutorisationBD(false);
            self::setMessageErreur("Le nom est obligatoire. <br />");
        }
        $this->nom = $nom;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getCp() {
        return $this->cp;
    }

    public function setCp($cp) {
        if(empty($cp) || ctype_space(strval($cp))) {
            $this->setAutorisationBD(false);
            self::setMessageErreur("Le code postal est obligatoire. <br />");
        }
        $this->cp = $cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        if(empty($ville) || ctype_space(strval($ville))) {
            $this->setAutorisationBD(false);
            self::setMessageErreur("La ville est obligatoire. <br />");
        }
        $this->ville = $ville;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    /**
     * @return bool
     */
    public function getAutorisationBD(): bool
    {
        return $this->autorisationBD;
    }

    /**
     * @param bool $autorisationBD
     */
    public function setAutorisationBD(bool $autorisationBD): void
    {
        $this->autorisationBD = $autorisationBD;
    }

}