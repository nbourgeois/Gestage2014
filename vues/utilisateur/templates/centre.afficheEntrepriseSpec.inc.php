<script language="JavaScript" type="text/javascript" src="../includes/jquery.js"> </script>
<script language="JavaScript" type="text/javascript" src="../includes/ajax.inc.js"> </script>
<link rel="stylesheet" type="text/css" href="../vue/css/print.css" media="print"/>

<from>
    <h1>Tableau des entreprise triée</h1>
    <div id="choix">
    <fieldset>
        <!-- choix -->
            <!-- choix 1-->
            <label>type de stage</label>
            <select id="type">
                <option value="null"></option>
                <option value="dev">Dévelopement</option>
                <option value="res">Réseaux</option>
            </select>
            <!-- choix 2-->
            <label>localisation du stage</label>
            <select id="ville">
                <option value="null"></option>
                <?php
            
          
            foreach ($this->lesVilles as $villes) { // boucle d'affichage des diversse ville presente dans la bdd
               //création d'une ligne du selecte  
               echo'<option value="'.$villes->VILLE_ORGANISATION.'">'.$villes->VILLE_ORGANISATION.'</option>';                   
               
               
            }
            
         ?>  
            </select>
            
            <!-- choix 3 -->
            <label>Forme Juridique</label>    
            <select id="fj">
                <option value="null"></option>
                <?php
            
          
            foreach ($this->formJuri as $fj) { // boucle d'affichage des diversse forme juridique presente dans la bdd
               //création d'une ligne du selecte   
               echo'<option value="'.$fj->FORMEJURIDIQUE.'">'.$fj->FORMEJURIDIQUE.'</option>';                   
               
               
            }
            
         ?>  
                
            </select>
           
         <!-- Boutton d'émition des variable pour affiché le tableau -->
        
         <input id="vChoix" type="button" value="Afficher la sélection" onClick="document.getElementById('tableau').innerHTML=''">
         
         </div>  

        
        
    
     
    <input value="Imprimer" type ="button" onClick="window.print()"><!--bouton d'imprétion rapide-->

</framset>
    
</form>