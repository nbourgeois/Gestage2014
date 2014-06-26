<?php

class MaSession implements ISession {

    static function fermer() {
        self::demarrer();
        unset($_SESSION["auth"]);
        session_destroy();
    }

    static function nouvelle($lesDonneesSession) {
        self::demarrer();
        session_regenerate_id();   // changer l'identification de session (sécurité)
        foreach ($lesDonneesSession as $nomDonnee => $valeurDonnee) {
            $_SESSION["auth"]["$nomDonnee"] = $valeurDonnee;
        }
    }

    static function estAuthentifie($lesDonneesSession) {
        self::demarrer();
        $ok = true;
        foreach ($lesDonneesSession as $nomDonnee) {
            $ok = $ok && isset($_SESSION["auth"]["$nomDonnee"]);
        }
        return $ok;
    }

    static function get($nomDonnee) {
        self::demarrer();
        $retour = null;
        if (isset($_SESSION["auth"]["$nomDonnee"])) {
            $retour = $_SESSION["auth"]["$nomDonnee"];
        }
        return $retour;
    }

    static function demarrer() {
        $sid= session_id();
        if (empty($sid)) session_start();
    }

}

?>
