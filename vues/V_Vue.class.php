<?php

class V_Vue {

    private $fichier;
    private $donnees;

    function __construct($chemin) {
        $this->fichier = $chemin;
        $this->donnees = array();
        $this->getDonnees['entete'] = "../vues/templates/entete.inc.php";
        $this->getDonnees['gauche'] = "../vues/templates/gauche.inc.php";
        $this->getDonnees['pied'] = "../vues/templates/pied.inc.php";
    }

    function afficher() {
        include($this->fichier);
    }

    /* ACCESSEURS */

    public function getFichier() {
        return $this->fichier;
    }

    public function getDonnees() {
        return $this->donnees;
    }


}
