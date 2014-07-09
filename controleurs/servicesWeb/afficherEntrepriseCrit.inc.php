     <?php
        //instanciation des données
        $type='';
        $ville='';
        $fj='';
        $partie1='';
        $partie2='';
        $partie3='';
        $entre1='';
        $entre2='';
        //récupération des valeur transmises
        if(isset($_GET['value1'])){
        $type=$_GET['value1'];
            }
        if(isset($_GET['value2'])){
        $ville=$_GET['value2'];
        }
        if(isset($_GET['value3'])){
        $fj=$_GET['value3'];
            }
            //création du contenue du select 
        if($type!="null")   // si un type a été choisie on remplie la partie 1 
        {
         $partie1="ACTIVITE LIKE '%".$type."%' ";   
        }
        if($ville!="null")   // si un type a été choisie on remplie la partie 2
        {
         $partie2=" VILLE_ORGANISATION='".$ville."' ";   
        }
        if($fj!="null")   // si un type a été choisie on remplie la partie 3
        {
         $partie3=" FORMEJURIDIQUE='".$fj."';";   
        }
        if(($partie1!="")&&($partie2!="")){ // si la partie 1 et 2 sont remplie met un AND entre les 2 élément
            $entre1=" AND ";
        }
        if(($partie2!="")&&($partie3!="")){// si la partie 2 et 3 sont remplie met un AND entre les 2 élément
            $entre2=" AND ";
        }
        if(($partie1!="")&&($partie2=="") && ($partie2!="")){// si la partie 1 et 3 sont remplie et que la partie 2 et vide met un AND entre les 2 élément
        $entre1=" AND ";
        }
        
            
             $requet="SELECT * FROM ORGANISATION WHERE ".$partie1." ".$entre1." ".$partie2." ".$entre2." " .$partie3; // création de la requette 
             $requetExe=mysql_query($requet);      
            // création du contenue du tableau :
            
             echo'<table border="1">';
        
        echo'<tr><th>Nom entreprise</th><th>ville</th><th>adresse</th><th>code postal</th><th>Tel</th><th>Type de stage</th></tr>';
            While ($data=mysql_fetch_assoc($requetExe))  { //boucle de remplissage
                      
                   echo'<tr><td>'.$data['NOM_ORGANISATION'].'</td><td>'.$data['VILLE_ORGANISATION'].'</td><td>'.$data['ADRESSE_ORGANISATION'].'</td><td>'.$data['CP_ORGANISATION'].'</td><td>'.$data['TEL_ORGANISATION'].'</td><td>'.$data['ACTIVITE'].'</td></tr>';  
                   
                   
            
        }
        echo'</table>';
        ?>