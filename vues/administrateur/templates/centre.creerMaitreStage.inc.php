<script language="JavaScript" type="text/javascript" src="../includes/fonctionsJavascript.inc.js"> </script>
<script language="JavaScript" type="text/javascript" src="../includes/jquery.js"> </script>
<script language="JavaScript" type="text/javascript" src="../includes/ajax.inc.js"> </script>


<!-- VARIABLES NECESSAIRES -->

<!-- $this->message : à afficher sous le formulaire -->
<form method="post" action=".?controleur=administrateur&action=validationcreermaitrestage&id=<?php echo $this->id; ?>" name="CreateUser">
  <h1>Création maitre de stage</h1>
    <!-- Choix du type de compte pour affiché les diférente information pour crée un compte spécifique -->
        <fieldset>
          
        <legend>Type de compte</legend>
        <input type="hidden" readonly="readonly" name="id" id="id"></input>
        	<label for="role">R&ocirc;le :</label>
        <select OnChange="javascript:ChoixRole();"  name="role" id="role"><!-- le OnChange éxécute la fontion qui affichera ou non le formulaire etudiant -->
            <option value=""></option>
        <?php
            
           //affichage de la liste déroulente des roles
            $tab=array();//variable de stockage des roles
            $cpt=0;
            // création du selecte qui contien les roels !
            foreach ($this->lesRoles as $role) { 
               $tab[$cpt]=$role->LIBELLE;  
               echo'<option value="'.$tab[$cpt].'">'.$tab[$cpt].'</option>';                   
               $cpt=$cpt+1;
               
            }
            
         ?>  
        </select>
            
        </fieldset>
   

        
        
        <!-- Information générales utilisé sur tout les compte -->
        <fieldset>
        <legend>Ses informations g&eacute;n&eacute;rales</legend>
        <input type="hidden" readonly="readonly" name="id" id="id"></input>
        <label for="civilite">Civilit&eacute; :</label>
      
        <select type="select" name="civilite" id="civilite">
            <option>Monsieur</option>
            <option>Madame</option>
            <option>Mademoiselle</option>
        </select>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom"></input><br/>
        <label for="prenom">Pr&eacute;nom :</label>
        <input type="prenom" name="prenom" id="prenom"></input><br/>
        <label for="mail">E-Mail :</label>
        <input type="text" name="mail" id="mail"></input><br/>
        <label for="tel">Tel :</label>
        <input type="text" name="tel" id="tel"></input><br/>
        <label for="tel">Tel protable:</label>
        <input type="text" name="telP" id="telP"></input><br/>
                     </fieldset>

        <!-- Information nécessaire uniquement aux étudiants -->
        
        <div id="Formulaire_Etudiant" style="visibility:hidden" height="0">
        <fieldset>
        <legend>Information spécifique aux étudiant</legend>
       
        
        <label for="etudes">Etudes :</label>
        <input type="text" name="etudes" id="etudes"></input><br/>
        <label for="formation">Formation :</label>
        <input type="text" name="formation" id="formation"></input><br/>
        <label for="option">Specialité :</label>
        <select name ="option" id="option">
            <option value=""></option>
        <?  //création du contenue du select pour l'option des étudiant
            $tab1=array();
            $cpt1=0;
            foreach ($this->lesOptions as $data) {   
              
            $tab1[$cpt]=$data->IDSPECIALITE;// on stock les valeurs dans un tableau 
            echo'<option value="'.$tab1[$cpt].'">'.$data->LIBELLECOURTSPECIALITE.'</option>'; //echo de la ligne 
            $cpt1=$cpt1+1;
            
        }
        ?>
        </select>
        
        </fieldset>

        </div>
       
    <!-- Donnée de conection des utilisateur -->
    <fieldset>
        <legend>Ses identifiants de connexion</legend>
        <label for="login">Login :</label>
        <input type="text" name="login" id="login"></input><br/>
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp"></input><br/>
        <label for="mdp2">Retaper votre mot de passe :</label>  <!-- vérification de mots de passe -->
        <input type="password" name="mdp2" id="mdp2"></input><br/>
        
    </fieldset>
    <fieldset>
        <input type="submit" value="Cr&eacute;er l'utilisateur" onclick="return valider()"></input><!-- OnClick éxécutera le JS qui testera tout les champ du formulaire. -->
        <input type="button" value="Retour" onclick="history.go(-1)">
    </fieldset>
</form>
<?php
// message de validation de création ou non 
if (isset($this->message)) {
    echo "<strong>".$this->message."</strong>";
}
?>