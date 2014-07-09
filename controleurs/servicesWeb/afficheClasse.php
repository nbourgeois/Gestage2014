<?php
include("../pagePhpAjax/fonctionPhpAjax.inc.php");
//récupération des donnée envoyer par jQuery
if(isset($_GET['value'])){
    $chaine=$_GET['value'];
}

$data=afficheClasse($chaine);//apelle la fonction situé dans fonctionAjax.inc.php
//début de création du select
 echo'<label for="classe">Classe :</label>';
 echo'<select type="select" name="classe" id="classe">';
 foreach($data as $val ) { //boucle de remplissage du select 
                  echo'<option value='.$val.'>'.$val.'</option>';   
                 }
 echo'</select>'       
           
    
?>
