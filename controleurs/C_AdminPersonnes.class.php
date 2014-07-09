<?php


/**
 * Description of C_AdminPersonnes
 * CRUD Personnes
 * @author btssio
 */
class C_AdminPersonnes extends C_ControleurGenerique {
    // Fonction d'affichage du formulaire de création d'une personne
    function creerPersonne(){
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue', 'Cr&eacute;ation d\'une personne');
        // ... depuis la BDD       
        $daoPers = new M_DaoPersonne();
        $daoPers->connecter();
        $pdo = $daoPers->getPdo();
       
        // Mémoriser la liste des spécialités disponibles
        $daoSpecialite = new M_DaoSpecialite();
        $daoSpecialite->setPdo($pdo);
        $this->vue->ecrireDonnee('lesSpecialites', $daoSpecialite->getAll());
               
        // Mémoriser la liste des rôles disponibles
        $daoRole = new M_DaoRole();
        $daoRole->setPdo($pdo);
        $this->vue->ecrireDonnee('lesRoles', $daoRole->getAll());
        
        $this->vue->ecrireDonnee('loginAuthentification',MaSession::get('login'));       
        $this->vue->ecrireDonnee('centre', "../vues/includes/adminPersonnes/centreCreerPersonne.inc.php");
               
        $this->vue->afficher();
    }
    
    //validation de création d'utilisateur 
    function validationcreerPersonne(){
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
    
}
