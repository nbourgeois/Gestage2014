<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>test DaoPersonne</title>
    </head>
    <body>
        <?php
        require_once("../includes/parametres.inc.php");
        require_once("../includes/fonctions.inc.php");

        $pdo = new M_DaoPersonne();

        $pers = $pdo->getOneById(16);
        var_dump($pers);
        
//        $lesPers = $pdo->getAll();
//        var_dump($lesPers);
        
        $pers = $pdo->getOneByLoginLazy('admin');
        var_dump($pers);
        
        $pers = $pdo->getOneByLoginEager('test');
        var_dump($pers);
        
        ?>
    </body>
</html>
