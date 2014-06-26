<?php

class V_Vue {

    private $fichier;
    private $donnees;

    function __construct($chemin) {
        $this->fichier = $chemin;
        $this->donnees = array();
        // composants par défaut de la vue
        $this->donnees['entete'] = "../vues/templates/entete.inc.php";
        $this->donnees['gauche'] = "../vues/templates/gauche.inc.php";
        $this->donnees['pied'] = "../vues/templates/pied.inc.php";
    }

    function afficher() {
        include($this->fichier);
    }

    /**
     * ajouter une information à transmettre à la vue : un couple (nom, valeur)
     * @param string $nomDonnee : nom de l'information
     * @param string $valeurDonnee : valeur de l'information
     */
    function ecrireDonnee($nomDonnee, $valeurDonnee) {
        $this->donnees[$nomDonnee] = $valeurDonnee;
    }

    /**
     * retourne valeur d'une information liée à la vue
     * @param string $nomDonnee : nom de l'information recherchée
     * @return string : valeur de l'information recherchée ; null sinon
     */
    function lireDonnee($nomDonnee) {
        $retour = null;
        if (isset($this->donnees[$nomDonnee])) {
            $retour = $this->donnees[$nomDonnee];
        }
        return $retour;
    }

//    /* ACCESSEURS */
//
//    public function getFichier() {
//        return $this->fichier;
//    }
//
//    public function getDonnees() {
//        return $this->donnees;
//    }

}
