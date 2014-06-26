<script language="JavaScript" type="text/javascript" src="../includes/jquery.js"> </script>
<script language="JavaScript" type="text/javascript" src="../includes/ajax.inc.js"> </script>
<script language="JavaScript" type="text/javascript" src="../includes/fonctionsJavascript.inc.js"> </script>
<form method="post" action=".?controleur=utilisateur&action=validermodifierEntreprise">
    <h1>Metre a jour une entreprise</h1>
    <fieldset>
        <legend>Choisir l'entreprise à modifier</legend>
    <select type ="select" id="entreprise"><!--selecte de choix d'entreprise-->
        <option value=""></option>
    
<?php 
            foreach ($this->lesEntreprise as $LesEntreprise) { // boucle d'affichage de toute les entreprise
                // création d'une ligne du selecte 
                   echo'<option value="'.$LesEntreprise->IDORGANISATION.'">'.$LesEntreprise->NOM_ORGANISATION.'</option>';   
            }
        ?>    
    </select> 
    </fieldset>
    <fieldset>
            
 <legend>Information</legend>
 <!--affichage des infirmation de l'entreprise -->
        <div id="formulaireEntreprise">
        </div>
        
        
    </fieldset>
</form>
<?php
//affichag de message pour a validation ou non de la création d'entreprise 
if (isset($this->message)) {
    echo "<strong>".$this->message."</strong>";
}
?>