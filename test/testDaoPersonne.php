<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test DaoPersonne</title>
    </head>
    <body>
        <?php
        require_once("../includes/parametres.inc.php");
        require_once("../includes/fonctions.inc.php");

        $dao = new M_DaoPersonne();
        $dao->connecter();

        //Test de sélection par Id 
        echo "<p>Test de sélection par Id </p>";
        $pers = $dao->getOneById(14);
        var_dump($pers);

        
        //Test de sélection de tous les enregistrements
        echo "<p>Test de sélection de tous les enregistrements</p>";
        $lesPers = $dao->getAll();
        var_dump($lesPers);
        
        //Test de sélection sur le login sans association
        echo "<p>Test de sélection sur le login sans association</p>";
        $pers = $dao->getOneByLogin('admin');
        var_dump($pers);
        
        //Test de sélection sur le login avec association
        echo "<p>Test de sélection sur le login avec association</p>";
        $pers = $dao->getOneByLogin('test');
        var_dump($pers);

        //Test d'insertion
        echo "<p>Test d'insertion</p>";
        $role = new M_Role(2, 2, "intendant");
        $pers= new M_Personne(0, null, $role, "M.", "Hugo", "Victor", "0278901234", "vhugo@free.fr", "0678901234", "", "", "vhugo", "vh");
        var_dump($pers);
        $dao->insert($pers);
        $persLu = $dao->getOneByLogin('vhugo');
        var_dump($persLu);

        //Test de modification
        echo "<p>Test de modification</p>";
       $pers->setMail("victor.hugo@laposte.net");
        $pers->setCivilite("Monsieur");
//        $id= $dao->getPdo()->lastInsertId();
        $enr = $dao->getPdo()->query('SELECT MAX(IDPERSONNE) FROM PERSONNE;')->fetch();
        $id= $enr[0];
        $dao->update($id,$pers);
        $persLu = $dao->getOneByLogin('vhugo');
        var_dump($persLu);
 
        //Test de suppression
        echo "<p>Test de suppression</p>";
        $id = $persLu->getId();
        echo "Supprimer : ".$id."<br/>";
        $dao->delete($id);
        $persLu = $dao->getOneById($id);
        var_dump($persLu);
        
        $dao->deconnecter();
        ?>
    </body>
</html>
