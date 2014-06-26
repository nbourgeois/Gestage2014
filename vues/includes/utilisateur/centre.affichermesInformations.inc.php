<!-- VARIABLES NECESSAIRES -->
<!-- $this->message : à afficher sous le formulaire -->
<form method="post" action=".?controleur=utilisateur&action=modifierCoordonees">
    <h1>Information personelle</h1>
    <fieldset>
        <legend>Mes informations</legend>
        <label for="civilite">Civilit&eacute; :</label>
        <input type="text" readonly="readonly" name="civilite" id="civilite" value="<?php echo $this->lesInformations->CIVILITE; ?>"></input><br/>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" readonly="readonly" value="<?php echo $this->lesInformations->NOM; ?>"></input><br/>
        <label for="prenom">Pr&eacute;nom :</label>
        <input type="prenom" name="prenom" id="mdp" readonly="readonly" value="<?php echo $this->lesInformations->PRENOM; ?>"></input><br/>
        <label for="mail">E-Mail :</label>
        <input type="text" name="mail" id="mail" readonly="readonly" value="<?php echo $this->lesInformations->ADRESSE_MAIL; ?>"></input><br/>
        <label for="tel">Tel :</label>
        <input type="text" name="tel" id="tel" readonly="readonly" value="<?php echo $this->lesInformations->NUM_TEL; ?>"></input><br/>
        <?php
        //contenue a affiché en fonction de l'utilsiateur
            if (MaSession::get('role') != 4){
                //contenue si ce n'est pas un étudiant , donc vide
                
            }else{//contenue si c'est un étudiant
        ?>
                <label for="etudes">Etudes :</label>
                <input type="text" name="etudes" id="etudes" readonly="readonly" value="<?php echo $this->lesInformations->ETUDES; ?>"></input><br/>
                <label for="formation">Formation :</label>
                <input type="text" name="formation" id="formation" readonly="readonly" value="<?php echo $this->lesInformations->FORMATION; ?>"></input><br/>
                
        
        <?php
            }
        ?>
                <input type="submit" value="Modifier mes informations" />
    </fieldset>
   
</form>
<?php
if (isset($this->message)) {
    echo "<strong>".$this->message."</strong>";
}
?>