<form>
     <h1>Tableau des entreprise</h1>
<fieldset>
    <table border="1">
        
        <tr><th>Nom de l'entreprise</th><th>ville</th><th>adresse</th><th>code postal</th><th>Tel</th><th>Type de stage</th></tr>
      <?php 
            foreach ($this->lesEntreprise as $LesEntreprise) { // boucle d'affichage de toute les entreprise
                //contenue des ligne du tableau
                   echo'<tr><td>'.$LesEntreprise->NOM_ORGANISATION.'</td><td>'.$LesEntreprise->VILLE_ORGANISATION.'</td><td>'.$LesEntreprise->ADRESSE_ORGANISATION.'</td><td>'.$LesEntreprise->CP_ORGANISATION.'</td><td>'.$LesEntreprise->TEL_ORGANISATION.'</td><td>'.$LesEntreprise->ACTIVITE.'</td></tr>';   
            }
        ?>      
        
        
        
        
    </table>
    
</fieldset>
    <input value="Imprimer" type ="button" onClick="window.print()"><!--bouton d'imprétion rapide-->
    <input type="button" value="Retour" onclick="history.go(-1)"><!--bouton de retour à la pages précédente-->
</form>