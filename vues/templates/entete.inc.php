<div id="entete">

    <h1 id="Titreappli">GestStage <b style="font-size:10px;" >Version <?php echo VERSION_APPLICATION ?></b></h1>

    <?php
    if (!is_null($this->lireDonnee('loginAuthentification'))) {
        ?>
        <span class="deconnexion" >
            <a href=".?controleur=connexion&action=seDeconnecter">
                <img src="../vues/images/exit.png" style="width:25px; height:25px;" alt="" />
            </a>
        </span>

        <?php
    }
    ?>

</div>