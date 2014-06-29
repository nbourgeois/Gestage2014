<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test Vue</title>
    </head>
    <body>
        <?php
        require("../includes/fonctions.inc.php");
        $maVue = new V_Vue("../vues/templates/template.inc.php");
        $maVue->ecrireDonnee('titreVue',"GestStage : Accueil");
        var_dump($maVue);
        ?>
    </body>
</html>
