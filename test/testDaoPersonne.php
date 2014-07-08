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
        $role = $dao->getOneById(14);
        var_dump($role);

        
        //Test de sélection de tous les enregistrements
        echo "<p>Test de sélection de tous les enregistrements</p>";
        $lesPers = $dao->getAll();
        var_dump($lesPers);
        
        //Test de sélection sur le login sans association
        echo "<p>Test de sélection sur le login sans association</p>";
        $role = $dao->getOneByLogin('admin');
        var_dump($role);
        
        //Test de sélection sur le login avec association
        echo "<p>Test de sélection sur le login avec association</p>";
        $role = $dao->getOneByLogin('test');
        var_dump($role);

        //Test d'insertion
        echo "<p>Test d'insertion</p>";
        $role = new M_Role(2, 2, "intendant");
        $role= new M_Personne(0, null, $role, "M.", "Hugo", "Victor", "0278901234", "vhugo@free.fr", "0678901234", "", "", "vhugo", "vh");
        var_dump($role);
        $dao->insert($role);
        $persLu = $dao->getOneByLogin('vhugo');
        var_dump($persLu);

        //Test de modification
        echo "<p>Test de modification</p>";
       $role->setMail("victor.hugo@laposte.net");
        $role->setCivilite("Monsieur");
//        $id= $dao->getPdo()->lastInsertId();
        $enr = $dao->getPdo()->query('SELECT MAX(IDPERSONNE) FROM PERSONNE;')->fetch();
        $id= $enr[0];
        $dao->update($id,$role);
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
