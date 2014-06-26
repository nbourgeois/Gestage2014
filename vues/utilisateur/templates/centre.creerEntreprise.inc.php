<script language="JavaScript" type="text/javascript" src="../includes/fonctionsJavascript.inc.js"> </script>

<!-- $this->message : à afficher sous le formulaire -->
<form method="post" action=".?controleur=utilisateur&action=validationcreerentreprise&id=<?php echo $this->id; ?>" name="CreateEntreprise">
    <h1>Creation d'entreprise</h1>
    <fieldset>
        <legend>Ses informations </legend>
        Tout les champs sont obligatoire sauf note contraire.<br/>
        <input type="hidden" readonly="readonly" name="id" id="id"></input>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom"></input><br/>
        <label for="ville">Ville de l'ocalisation:</label>
        <input type="test" name="ville" id="ville"></input><br/>
        <label for="ads">Adresse:</label>
        <input type="text" name="ads" id="ads"></input><br/>
        <label for="cp">Code Postal :</label>
        <input type="text" name="cp" id="cp"></input><br/>
        <label for="tel">Téléphone :</label>
        <input type="text" name="tel" id="tel"></input><br/>
        <label for="fax">Fax*:</label>
        <input type="text" name="fax" id="fax"></input><br/>          
        <label for="fj">Forme Juridique:</label>
        <input type="text" name="fj" id="fj"></input><br/> 
        <label for="type">Type de stage**:</label>
        <input type="text" name="type" id="type"></input><br/> 
        </br>
  <!--bouton d'envoie des information de création d'entreprise-->
        <input type="submit" value="Cr&eacute;er l'entreprise" onclick="return validerE()"></input><!-- OnClick éxécutera le JS qui testera tout les champ du formulaire. -->
        
    </fieldset>
    <fieldset>
        <legend>note: </legend><!--nota de la création d'entreprise-->
        <ul>*: Non obligatoire</ul>
        
        <ul>**: Syntax pour le type de stage: dev pour dévelopement , res pour reseaux et dev/res si l'entreprise accepte les 2 type de stage .</ul>
    </fieldset>
    
    
    
</form>    
    