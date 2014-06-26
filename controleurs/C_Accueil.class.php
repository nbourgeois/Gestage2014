<?php

class C_Accueil extends C_ControleurGenerique {

    /**
     * controleur= accueil & action= index
     * Afficher la page d'accueil
     */
    function defaut() {
        // les fichiers
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->getDonnees['centre'] = "../vues/accueil/centreAccueil.inc.php";
        // les données
        $this->vue->getDonnees['titreVue'] = "GestStage : Accueil";
        $this->vue->getDonnees['loginAuthentification'] = MaSession::get('login');
        $this->vue->afficher();
    }

}
