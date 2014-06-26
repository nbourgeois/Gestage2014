<?php

function afficheClasse($chaine){
   //connection à la base de donnée 
        $db=mysql_connect('localhost','root','joliverie');
        mysql_select_db('GESTAGE',$db);
   $result=array(); 
 $requet="SELECT * FROM CLASSE WHERE NUMFILIERE='".$chaine."';";//création de la requet
 $requetExe=mysql_query($requet);//récupération du contenue de la requet
while($data=mysql_fetch_assoc($requetExe))
{
    $result[]=$data['NOMCLASSE'];
            }
return $result;
        
    }
?>
