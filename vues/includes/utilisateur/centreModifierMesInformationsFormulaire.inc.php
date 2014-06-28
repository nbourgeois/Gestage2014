
<?php 
// on récupère un objet métier de type Personne
$unUtilisateur = $this->lireDonnee('utilisateur');
?>

<form method="post" action=".?controleur=utilisateur&action=validerModifierCoordonnees&id=<?php echo $unUtilisateur->getId(); ?>">
    <h1>Modification des information personelle</h1>
    <fieldset>
        <legend>Mes informations</legend>
        <label for="civilite">Civilit&eacute; :</label>
        <input type="text"  name="civilite" id="civilite" value="<?php echo $unUtilisateur->getCivilite(); ?>"></input><br/>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom"  value="<?php echo $unUtilisateur->getNom(); ?>"></input><br/>
        <label for="prenom">Pr&eacute;nom :</label>
        <input type="prenom" name="prenom" value="<?php echo $unUtilisateur->getPrenom(); ?>"></input><br/>
        <label for="mail">E-Mail :</label>
        <input type="text" name="mail" id="mail" value="<?php echo $unUtilisateur->getMail();; ?>"></input><br/>
        <label for="tel">Tel :</label>
        <input type="text" name="tel" id="tel" value="<?php echo $unUtilisateur->getNumTel(); ?>"></input><br/>
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