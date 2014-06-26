<?php

class C_Utilisateur extends C_ControleurGenerique {
    
    /**
     * préparation et affichage des coordonnées de l'utilisateur courant
     */
    function coordonnees(){
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue','Vos informations');   
        // charger les coordonnées de l'utilisateur connecté depuis la BDD       
        $daoPers = new M_DaoPersonne();
        $utilisateur = $daoPers->getOneByLoginLazy(MaSession::get('login'));
        $this->vue->ecrireDonnee('utilisateur',$utilisateur);
        // transmettre le login        
        $this->vue->ecrireDonnee('loginAuthentification',MaSession::get('login'));
        // vue centrale à inclure
        $this->vue->ecrireDonnee('centre',"../vues/includes/utilisateur/centreAfficherMesInformationsFormulaire.inc.php");
        $this->vue->afficher();
    }
    
    /**
     *  modification des coordonnées de l'utilisateur courant
     */
    function modifierCoordonnees(){
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue','Modification de vos informations');   
        // charger les coordonnées de l'utilisateur connecté depuis la BDD       
        $daoPers = new M_DaoPersonne();
        $utilisateur = $daoPers->getOneByLoginLazy(MaSession::get('login'));
        $this->vue->ecrireDonnee('utilisateur',$utilisateur);
        // transmettre le login        
        $this->vue->ecrireDonnee('loginAuthentification',MaSession::get('login'));
       
        $this->vue->ecrireDonnee('centre',"../vues/includes/utilisateur/centreModifierMesInformationsFormulaire.inc.php");
        $this->vue->afficher();
    }
    
    //validation de modification des donnée personelle à l'utilisateur
    function validerModifierCoordonnees(){
        
        $this->vue->titreVue = "Modification de vos informations";
        $utilisateur = new M_LesDonneesCreationUtilisateur();
        // préparer la liste des paramètres
        $lesParametres = array();
        // récupérer les données du formulaire
        $lesParametres["CIVILITE"] = $_POST["civilite"]; 
        $lesParametres["NOM"] = $_POST["nom"];
        $lesParametres["PRENOM"] = $_POST["prenom"];
        $lesParametres["NUM_TEL"] = $_POST["tel"];
        $lesParametres["ADRESSE_MAIL"] = $_POST["mail"];
        $lesParametres["ETUDES"] = $_POST["etudes"];
        $lesParametres["FORMATION"] = $_POST["formation"];
                       
        $ok = $utilisateur->update($_GET["id"], $lesParametres);
        if ($ok) {
            $this->vue->message = "Modifications enregistr&eacute;es";
        } else {
            $this->vue->message = "Echec des modifications";
        }
        $this->vue->afficher();
        
    }
 
}
?>