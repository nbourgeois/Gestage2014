<form>
     <h1>Choisir l'entreprise prenant le stagiaire</h1>
<fieldset>
    
        
        <select id ="choixEntrepriseStage">
      <?php 
            foreach ($this->lesEntreprise as $LesEntreprise) { // boucle d'affichage de toute les entreprise
                   echo"<option value='".$LesEntreprise->IDORGANISATION ."'>".$LesEntreprise->NOM_ORGANISATION."</value>" ;
            }
        ?>    
            <option value="creation">Non présente</option>
        
        </select> 
        
        
   
    
</fieldset>
   
</form>