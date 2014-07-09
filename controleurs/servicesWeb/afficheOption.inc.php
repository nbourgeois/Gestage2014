<?php
    // connection à la base de donées
    $db=mysql_connect('localhost','root','joliverie');
    mysql_select_db('GESTAGE',$db);
    //instentiation des donnée
    $chaine='';
    //récupération des donnée envoyer par jQuery
    if(isset($_GET['value'])){
        $chaine=$_GET['value'];
    }
    //si la valeur récupérer est égale a 4 (étudiant SIO) les option sont créé
    if($chaine=='4'){
    //début de la création du select
        echo'<label for="option">option :</label>';
        echo'<select type="select" name="option" id="option">';
 
        $requet="SELECT * FROM SPECIALITE ;"; // requette pour récupérer les donnée option
        $requetExe=mysql_query($requet);
    //$lesClasses = new M_ListeClasses();
    //$classe=$lesClasses->get($chaine);
       While ($data=mysql_fetch_assoc($requetExe)) { // boucle de remplissage
                  echo'<option value='.$data['IDSPECIALITE'].'>'.$data['LIBELLECOURTSPECIALITE'].'</option>';   
                 }
       echo'</select>' ;      
    }           
    
?>