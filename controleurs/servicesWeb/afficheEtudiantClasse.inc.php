 
        <?php
        //connection à la base de donnée 
        $db=mysql_connect('localhost','root','joliverie');
        mysql_select_db('GESTAGE',$db);
        //instantiation des variable
        $classe='';
        $option='';
        //récupération des variable envoyer par jquery
        if(isset($_GET['value1'])){
        $classe=$_GET['value1'];
            }
        if(isset($_GET['value2'])){
        $option=$_GET['value2'];
            }
            
             $requet="SELECT * FROM PERSONNE WHERE ETUDES='".$classe."' AND IDSPECIALITE='".$option."' ;"; // requete pour récupérer le contenue  du tableaux
             $requetExe=mysql_query($requet);      
            // création du contenue du tableau :
             echo'<tr><th>Nom</th><th>Prenom</th></tr>';
            While ($data=mysql_fetch_assoc($requetExe))  { //boucle de ligne du tableau
                      
                   echo'<tr><th>'.$data['NOM'].'</th><th>'.$data['PRENOM'].'</th></tr>';   
                   
                   
            
        }
        ?>