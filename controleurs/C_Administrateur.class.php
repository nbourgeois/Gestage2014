
<?php

class C_Administrateur extends Controleur{
    
   
    
    // Fonction d'affichage du formulaire de création d'un utilisateur.
    function creerUtilisateur(){
        $this->vue->titreVue = 'Cr&eacute;ation d\'un utilisateur';   
        
        $this->vue->entete = "../vues/templates/entete.inc.php"; 
                
        $this->vue->gauche = "../vues/templates/gauche.inc.php";
        
        $lesEntreprise = new M_ListeEntreprise();
        $this->vue->lesEntreprise = $lesEntreprise->getAll();       
       
       
        $lesOptions = new M_ListeOptions();
        $this->vue->lesOptions = $lesOptions->getAll();
               
        $lesRoles = new M_ListeRoles();
        $this->vue->lesRoles = $lesRoles->getAll();
        
        $this->vue->loginAuthentification = MaSession::get('login');
       
        $this->vue->centre = "../vues/administrateur/templates/centre.creerUtilisateur.inc.php";
        
        $this->vue->pied = "../vues/templates/pied.inc.php";
        
        $this->vue->afficher();
    }
    
    //validation de création d'utilisateur 
    function validationcreerutilisateur(){
        $this->vue->titreVue = "Validation cr&eacute;ation de l'utilisateur";
        $utilisateur = new M_LesDonneesCreationUtilisateur();
        // préparer la liste des paramètres
        $lesParametres = array();
        $lesLogin = new M_ListeLogin();
        $countLog="";
        $countLog= $lesLogin->getCount($_POST["login"]);
        //$this->vue->ListeLogin = $lesLogin->getCountLogin($_POST["login"]);
        $msg='';    
        //vérifie si le login est présent dans la base de donnée si il ne l'est pas l'utilisateur est créé
       
      if($countLog->NB=="0"){
         
        $lesParametres[0] = $utilisateur->getId('IDSPECIALITE', 'SPECIALITE', 'IDSPECIALITE', $_POST["option"]);
        
        $lesParametres[1] = $utilisateur->getId('IDROLE', 'ROLE', 'LIBELLE', $_POST["role"]);
        $lesParametres[2] = $_POST["civilite"];  
        $lesParametres[3] = $_POST["nom"];
        $lesParametres[4] = $_POST["prenom"];
        $lesParametres[5] = $_POST["tel"];
        $lesParametres[6] = $_POST["mail"];
        $lesParametres[7] = $_POST["telP"];
        
        $lesParametres[8] = $_POST["etudes"];
        $lesParametres[9] = $_POST["formation"];
        $lesParametres[10] = $_POST["entreprise1"];
        
        $lesParametres[11] = $_POST["login"];
        $lesParametres[12] = sha1($_POST["mdp"]);
          
        $ok = $utilisateur->insert($lesParametres);
      }else{
          $msg=' Login déjà utilisé';
          $ok=0;
      }
      
        if ($ok) {
            $this->vue->message = "Utilisateur cr&eacute;&eacute;";
        } else {
            $this->vue->message = "Echec de l ajout de l utilisateur".$msg;
        }
        $this->vue->afficher();
    }
   
      //affichage des étudiant
    function afficherEleve(){
        $this->vue->titreVue = 'Tout les élèves';   
        
        $this->vue->loginAuthentification = MaSession::get('login');
        
        $lesFormations = new M_ListeFormations();
        $this->vue->lesFormations = $lesFormations->getAll();
        
       
        
        $this->vue->entete = "../vues/templates/entete.inc.php"; 
                
        $this->vue->gauche = "../vues/templates/gauche.inc.php"; 
        
        $this->vue->centre = "../vues/administrateur/templates/centre.afficherEleve.inc.php";
        
        $this->vue->pied = "../vues/templates/pied.inc.php";
        
        $this->vue->afficher();
          
          
          
      }

      
}    
?>