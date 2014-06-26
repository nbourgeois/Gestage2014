<?php

class C_Utilisateur extends Controleur{
    // affichage des coordonnée de l'utilisateur 
    function coordonees(){
        
        $this->vue->titreVue = 'Vos informations';   
        
        $this->vue->entete = "../vues/templates/entete.inc.php"; 
                
        $this->vue->gauche = "../vues/templates/gauche.inc.php";
        
        $lesInformations = new M_Utilisateurs();
        
        $this->vue->lesInformations = $lesInformations->getFromLogin(MaSession::get('login'));
                
        $this->vue->loginAuthentification = MaSession::get('login');
       
        $this->vue->centre = "../vues/utilisateur/templates/centre.affichermesInformations.inc.php";
        
        $this->vue->pied = "../vues/templates/pied.inc.php";
        
        $this->vue->afficher();
    }
       // midification des coordonnée de l'utilisateur 
    function modifierCoordonees(){
        
        $this->vue->titreVue = 'Modification de vos informations';   
        
        $this->vue->entete = "../vues/templates/entete.inc.php"; 
                
        $this->vue->gauche = "../vues/templates/gauche.inc.php";
        
        $lesInformations = new M_Utilisateurs();
                
        $this->vue->lesInformations = $lesInformations->getFromLogin(MaSession::get('login'));
                        
        $this->vue->loginAuthentification = MaSession::get('login');
       
        $this->vue->centre = "../vues/utilisateur/templates/centre.modifierMesInformations.inc.php";
        
        $this->vue->pied = "../vues/templates/pied.inc.php";
        
        $this->vue->afficher();
    }
    //validation de modification des donnée personelle à l'utilisateur
    function validerModifierCoordonees(){
        
        $this->vue->titreVue = "Modification de mes informations";
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