<script language="JavaScript" type="text/javascript" src="../includes/fonctionsJavascript.inc.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/jquery.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ajax.inc.js"></script>

<form method="post" action=".?controleur=utilisateur&action=validationcreerstage" name="creationStage" >

 <h1>Creation d'un stage</h1>
    <fieldset> 
        
        
        <label for="id_etudiant">*Etudiant:</label>
        <select name="id_etudiant">
             <?php 
            foreach ($this->lesEtudiant as $LesEtudiant) { // boucle d'affichage de toute les entreprise
                //contenue des ligne du tableau
                   echo'<option value="'.$LesEtudiant->IDPERSONNE.'">'.$LesEtudiant->NOM.' '.$LesEtudiant->PRENOM.'</option>';   
            }
        ?>     
        </select><br />
        
        
        
        <legend>Informations importantes</legend>

        <label for="id_professeur_referant">*Professeur referant:</label>
        <select name="id_professeur_referant" >
        
         <?php 
            foreach ($this->lesProf as $LesProf) { // boucle d'affichage de toute les entreprise
                //contenue des ligne du tableau
                   echo'<option value="'.$LesProf->IDPERSONNE.'">'.$LesProf->NOM.' '.$LesProf->PRENOM.'</option>';   
            }
        ?>
        </select><br />
        
        
        
        
    </fieldset>

    <fieldset>
        <legend>Date de stage :</legend>
        
        <label for="date_debut">*Annee scolaire</label>
        <select name="anneescol">
        <?php 
            foreach ($this->lesAnneesScolaire as $LesAnneesScolaire) { // boucle d'affichage de toute les entreprise
                //contenue des ligne du tableau
                   echo'<option value="'.$LesAnneesScolaire->ANNEESCOL.'">'.$LesAnneesScolaire->ANNEESCOL.'</option>';   
            }
        ?>  
	</select><br />
		
        <label for="date_debut">*Date debut : (YYYY-MM-DD )</label>
        <input type="text" name="date_debut" id="date_debut" ></input><br/>
        
        <label for="date_fin">*Date fin : (YYYY-MM-DD )</label>
        <input type="text" name="date_fin" id="date_fin" ></input><br/>
        
        <label for="date_visite">*Date de visite : (YYYY-MM-DD )</label>
        <input type="text" name="date_visite" id="date_visite" ></input><br/>
        
    </fieldset>

    <fieldset>
        <legend>Informations liees a l'entreprise :</legend>
        
        <label for="id_maitre_stage">*Maitre de stage :</label>
        <select name="id_maitre_stage">
        
         <?php 
            foreach ($this->lesMaitreDeStage as $LesMaitreDeStage) { // boucle d'affichage de toute les entreprise
                //contenue des ligne du tableau
                   echo'<option value="'.$LesMaitreDeStage->IDPERSONNE.'">'.$LesMaitreDeStage->NOM.' '.$LesMaitreDeStage->PRENOM.'</option>';   
            }
        ?>  
        </select><br />
        
        
        
        
        
        <label for="id_entreprise">*Entreprise :</label>
        <select name="id_entreprise">
         <?php 
            foreach ($this->lesOrganisation as $LesOrganisation) { // boucle d'affichage de toute les entreprise
                //contenue des ligne du tableau
                   echo'<option value="'.$LesOrganisation->IDORGANISATION.'">'.$LesOrganisation->NOM_ORGANISATION.'</option>';   
            }
        ?>  
        </select><br />
        
        <label for="ville">*Ville :</label>
        <input type="text" name="ville" id="ville" ></input><br/>
        
        <label for="divers">Divers :</label>
        <input type="text" name="divers" ></input><br/>
        
    </fieldset>

     <fieldset>
         
         <legend>Bilan du stage :</legend>
         
        <label for="bilan_travaux">Bilan travaux :</label>
        <textarea rows="4" cols="50" name="bilan_travaux"></textarea> <br/>
        
        <label for="ressources_outils">Ressources outils:</label>
        <textarea rows="4" cols="50" name="ressources_outils"></textarea> <br/>
        
        <label for="commentaires">Commentaires :</label>
        <textarea rows="4" cols="50" name="commentaires"></textarea> <br/>
        
        <label for="participation_ccf">Participation CCF :</label>
        <input type="text" name="participation_ccf" id="participation_ccf" ></input><br/>
        
        </fieldset>
    
     <fieldset>
        <input type="submit" value="Rajouter le stage" onclick="return validerStage()" ></input><br />
        * champs obligatoires
     </fieldset>
</form>
