<?php

class AuthentificationTable {
    private $login = "";
    private $motdepasse = "";
    private $autorisationSession = true;
    private static $messageErreur = "";

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



    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        if(empty($login) || ctype_space(strval($login))) {
            self::setMessageErreur("Vous devez saisir votre login. <br />");
            $this->setAutorisationSession(false);
        }
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /**
     * @param string $motdepasse
     */
    public function setMotdepasse(string $motdepasse)
    {
        if(empty($motdepasse) || ctype_space(strval($motdepasse))) {
            self::setMessageErreur("Vous devez saisir votre mot de passe. <br />");
            $this->setAutorisationSession(false);
            $this->motdepasse = "";
        } else {
            // salage
            $gauche = "ar30&y%";
            $droite = "tk!@";
            $this->motdepasse = hash('ripemd128', "$gauche$motdepasse$droite");
        }
    }

    /**
     * @return bool
     */
    public function getAutorisationSession()
    {
        return $this->autorisationSession;
    }

    /**
     * @param bool $autorisationSession
     */
    public function setAutorisationSession(bool $autorisationSession)
    {
        $this->autorisationSession = $autorisationSession;
    }

    /**
     * @return string
     */
    public static function getMessageErreur()
    {
        return self::$messageErreur;
    }

    /**
     * @param string $messageErreur
     */
    public static function setMessageErreur(string $messageErreur)
    {
        self::$messageErreur = self::$messageErreur . $messageErreur;
    }
}