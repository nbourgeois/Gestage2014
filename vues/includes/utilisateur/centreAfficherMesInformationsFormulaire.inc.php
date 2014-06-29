<!-- VARIABLES NECESSAIRES -->
<!-- $this->message : à afficher sous le formulaire -->
<?php 
// on récupère un objet métier de type Personne
$unUtilisateur = $this->lireDonnee('utilisateur');
?>
<form method="post" action=".?controleur=utilisateur&action=modifierCoordonnees">
    <h1>Informations personnelles</h1>
    <fieldset>
        <legend>Mes informations</legend>
        <label for="civilite">Civilit&eacute; :</label>
        <input type="text" readonly="readonly" name="civilite" id="civilite" value="<?php echo $unUtilisateur->getCivilite(); ?>"></input><br/>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" readonly="readonly" value="<?php echo $unUtilisateur->getNom(); ?>"></input><br/>
        <label for="prenom">Pr&eacute;nom :</label>
        <input type="prenom" name="prenom" id="mdp" readonly="readonly" value="<?php echo $unUtilisateur->getPrenom(); ?>"></input><br/>
        <label for="mail">E-Mail :</label>
        <input type="text" name="mail" id="mail" readonly="readonly" value="<?php echo $unUtilisateur->getMail();; ?>"></input><br/>
        <label for="tel">Tel :</label>
        <input type="text" name="tel" id="tel" readonly="readonly" value="<?php echo $unUtilisateur->getNumTel(); ?>"></input><br/>
        <?php
        //contenu à afficher en fonction de l'utilisateur
            if (MaSession::get('role') == 4){
                //contenu si c'est un étudiant 
        ?>
                <label for="etudes">Etudes :</label>
                <input type="text" name="etudes" id="etudes" readonly="readonly" value="<?php echo $unUtilisateur->getEtudes(); ?>"></input><br/>
                <label for="formation">Formation :</label>
                <input type="text" name="formation" id="formation" readonly="readonly" value="<?php echo $unUtilisateur->getFormation(); ?>"></input><br/>       
        <?php
            }
        ?>
                <input type="submit" value="Modifier mes informations" />
    </fieldset>
   
</form>
<?php
if (!is_null($this->lireDonnee('message'))) {
    echo "<strong>".$this->lireDonnee('message')."</strong>";
}
?>