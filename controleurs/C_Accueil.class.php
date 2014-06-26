<?php

class C_Accueil extends C_ControleurGenerique {

    /**
     * controleur= accueil & action= index
     * Afficher la page d'accueil
     */
    function defaut() {
        // les fichiers
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ajouterDonnee('centre',"../vues/includes/accueil/centreAccueil.inc.php");
        // les données
        $this->vue->ajouterDonnee('titreVue',"GestStage : Accueil");
        $this->vue->ajouterDonnee('loginAuthentification',MaSession::get('login'));
        $this->vue->afficher();
    }

}
