 <table border="1" width="100%">
        
     <h1>Liste des stages (du plus nouveau au plus ancien) </h1>
        <tr>
            <th>Etudiant</th>
            <th>Entreprise</th>
            <th>Professeur</th>
            <th>Date debut</th>
            <th>Date fin</th>
            <th>Ville</th>
            <th>Divers</th>
        </tr>
        
      <?php 
            foreach ($this->lesStage as $LesStage) { // boucle d'affichage de toute les entreprise
                //contenue des ligne du tableau
                   echo'
                       <tr>
                       <td>'.$LesStage->NOM_ELEVE.' '.$LesStage->PRENOM_ELEVE.'</td>
                       <td>'.$LesStage->NOM_ORGANISATION.'</td>
                       <td>'.$LesStage->NOM_PROF.' '.$LesStage->PRENOM_PROF.'</td>
                       <td>'.$LesStage->DATEDEBUT.'</td>
                       <td>'.$LesStage->DATEFIN.'</td>
                       <td>'.$LesStage->VILLE.'</td>
                       <td>'.$LesStage->DIVERS.'</td>
                       </tr>';   
            }
        ?>      
        
        
        
        
    </table>