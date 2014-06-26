<?php

class M_ListeEntrepriseCritere extends Modele {
	
	//protected $clePrimaire='NOM_ORGANISATION';


function getSpeci($Colone) {
        $pdo = $this->connecter();
        // Requête textuelle
        $query = "SELECT DISTINCT ".$Colone." FROM ORGANISATION;";
        // Exécuter la requête
        $resultSet = $pdo->query($query);
        // FETCH_CLASS permet de retourner des enregistrements sous forme d'objets de la classe spécifiée
        // ici : $this->nomClasseMetier contient "Enregistrement"
        // La classe Enregistrement est une classe générique vide qui sera automatiquement affublée d'autant
        // d'attributs publics qu'il y a de colonnes dans le jeu d'enregistrements
        $retour = $resultSet->fetchAll(PDO::FETCH_CLASS, $this->nomClasseMetier);
        $this->deconnecter();
        return $retour;
    }
}
?>