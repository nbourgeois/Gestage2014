
<form method="post" action=".?controleur=utilisateur&action=validerModifierCoordonees&id=<?php echo $this->lesInformations->IDPERSONNE; ?>">
    <h1>Modification des information personelle</h1>
    <fieldset>
        <legend>Modification de mes informations</legend>
        <label for="civilite">Civilit&eacute; :</label>
        <input type="text" name="civilite" id="civilite" value="<?php echo $this->lesInformations->CIVILITE; ?>"></input><br/>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?php echo $this->lesInformations->NOM; ?>"></input><br/>
        <label for="prenom">Pr&eacute;nom :</label>
        <input type="prenom" name="prenom" id="mdp" value="<?php echo $this->lesInformations->PRENOM; ?>"></input><br/>
        <label for="mail">E-Mail :</label>
        <input type="text" name="mail" id="mail" value="<?php echo $this->lesInformations->ADRESSE_MAIL; ?>"></input><br/>
        <label for="tel">Tel :</label>
        <input type="text" name="tel" id="tel" value="<?php echo $this->lesInformations->NUM_TEL; ?>"></input><br/>
        <?php
            if (MaSession::get('role') != 4){
                //contenue à affichée si l'utilisateur n'est pas un étudiant
                
            }else{//contenue à affichée si l'utilisateur est un étudiant
        ?>
                <label for="etudes">Etudes :</label>
                <input type="text" name="etudes" id="etudes"  value="<?php echo $this->lesInformations->ETUDES; ?>"></input><br/>
                <label for="formation">Formation :</label>
                <input type="text" name="formation" id="formation"  value="<?php echo $this->lesInformations->FORMATION; ?>"></input><br/>
                
        
        <?php
            }
        ?>
                <br />
                <input type="submit" value="Sauvegarder" /><!--validation modification-->
                <input type="button" value="Retour" onclick="history.go(-1)"><!--allez à la page précédente-->
                
    </fieldset>
   
</form>
<?php
if (isset($this->message)) {
    echo "<strong>".$this->message."</strong>";
}
?>