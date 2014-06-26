<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test Vue</title>
    </head>
    <body>
        <?php
        require("../includes/fonctions.inc.php");
        $maVue = new V__Vue("../vues/templates/template.inc.php");
        $maVue->getDonnees['titreVue'] = "GestStage : Accueil";
        var_dump($maVue);
        ?>
    </body>
</html>
