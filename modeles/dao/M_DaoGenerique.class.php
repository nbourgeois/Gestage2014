<?php

abstract class M_DaoGenerique {

    protected $pdo;
    protected $nomTable;
    protected $nomClefPrimaire;

    /**
     * Crée un objet de type PDO et ouvre la connexion 
     * @return un objet de type PDO pour accéder à la base de données
     */
    function connecter() {
        if (!isset($this->pdo)) {
            /* Connexion à une base via PDO */
            try {
                $this->setPdo(new PDO(DSN, USER, MDP));
                $this->getPdo()->query("SET NAMES utf8");
            } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
            }
        }
        return $this->getPdo();
    }

    function deconnecter() {
        $this->setPdo(null);
    }
    
    /**
     * fonction à redéfinir dans chaque classe Dao concrète
     * Permet d'instancier un objet d'après les valeurs d'un enregistrement lu dans la base de données
     * La stratégie de chargement est le "lazy-loading" : on ne charge que l'objet principal, pas ceux qui lui sont liés par des associations
     * (c'est le contraire du "eager-fetching")
     * @param tableau-associatif $unEnregistrement liste des valeurs des champs d'un enregistrement
     * @return objet :  instance de la classe métier, initialisée d'après les valeurs de l'enregistrement 
     */
    abstract function enregistrementVersObjet($unEnregistrement);

    /**
     * Lire tous les enregistrements d'une table
     * @return tableau-associatif d'objets : un tableau d'instances de la classe métier
     */
    function getAll(){
        $retour = null;
        $pdo = $this->connecter();
        // Requête textuelle
        $sql = "SELECT * FROM $this->nomTable ORDER BY $this->nomClefPrimaire";
        // préparer la requête PDO
        $queryPrepare = $pdo->prepare($sql);
        // exécuter la requête PDO
        if ($queryPrepare->execute()) {
            // si la requête réussit :
            // initialiser le tableau d'objets à retourner
            $retour= array();
            // pour chaque enregistrement retourné par la requête
            while($enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC)){
                // construir un objet métier correspondant
                $unObjetMetier = $this->enregistrementVersObjet($enregistrement);
                // ajouter l'objet au tableau
                $retour[] = $unObjetMetier;
            }
        }
        $this->deconnecter();
        return $retour;
    }
    

    /**
     * Lire un enregistrement d'après une valeur de clef primaire
     * la stratégie de chargement est ici le "lazy-loading" : on ne charge pas les objets éventuellement liés
     * @param $valeurClePrimaire
     * @return objet : une instance de la classe métier
     */
    function getOneById($valeurClePrimaire){
        $retour = null;
        $pdo = $this->connecter();
        // Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
        $sql = "SELECT * FROM $this->nomTable  WHERE $this->nomClefPrimaire = ?";
        // préparer la requête PDO
        $queryPrepare = $pdo->prepare($sql);
        // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
        if ($queryPrepare->execute(array($valeurClePrimaire))) {
            // si la requête réussit :
            // extraire l'enregistrement retourné par la requête
            $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
            // construire l'objet métier correspondant
            $retour = $this->enregistrementVersObjet($enregistrement);
        }
        $this->deconnecter();
        return $retour;
    }

//    // fonction qui permetra de connaitre le nombre fois qu'une Identité est déjà présente dans la base de donnée 
//    function getCount($valeurACompter) {
//        $pdo = $this->connecter();
//        // Requête textuelle
//        $query = "SELECT COUNT(*) AS NB FROM " . $this->table . " WHERE " . $this->clePrimaire . "= ? ;";
//        $queryPrepare = $pdo->prepare($query);
//        // Spécifier le type de classe à instancier
//        $queryPrepare->setFetchMode(PDO::FETCH_CLASS, $this->nomClasseMetier);
//        // Exécuter la requête avec les valeurs des paramètres
//        $retour = null;
//        if ($queryPrepare->execute(array($valeurACompter))) {
//            $retour = $queryPrepare->fetch(PDO::FETCH_CLASS);
//        }
//        $this->deconnecter();
//        return $retour;
//    }
//
//
//
//    function getId($id, $table, $nomLibelle, $valeur) {
//        $pdo = $this->connecter();
//        // Requête textuelle
//        $query = "SELECT " . $id . " FROM " . $table . " WHERE " . $nomLibelle . " = '" . $valeur . "'";
//        $resultSet = $pdo->query($query);
//        // FETCH_CLASS permet de retourner des enregistrements sous forme d'objets de la classe spécifiée
//        // ici : $this->nomClasseMetier contient "Enregistrement"
//        // La classe Enregistrement est une classe générique vide qui sera automatiquement affublée d'autant
//        // d'attributs publics qu'il y a de colonnes dans le jeu d'enregistrements
//        $retour = $resultSet->fetchAll(PDO::FETCH_COLUMN, 0);
//        $this->deconnecter();
//        return $retour[0];
//    }
//
//    /**
//     * update
//     * Mise à jour d'un article
//     * @param type $valeurClePrimaire (identifiant de la table)
//     * @param type $tabChampsValeurs tableau associatif des couple (champ,valeur) à intégrer à la requête
//     * @return boolean : succès/échec de la mise à jour
//     */
//    function update($valeurClePrimaire, $tabChampsValeurs) {
//        $pdo = $this->connecter();
//        // Construction de la requête textuelle
//        $query = "UPDATE " . $this->table . " SET ";
//        $tabValeurs = array();   // tableau des valeurs à construire pour l'exécution de la requête
//        $numParam = 0;              // on compte les paramètres : le premier n'est pas précédé d'une virgule
//        foreach ($tabChampsValeurs as $champ => $valeur) {
//            if ($numParam != 0) {
//                $query.= ", ";
//            }
//            $query.= $champ . " = ? ";  // ajout d'une clause du type champ = ?
//            $tabValeurs[] = $valeur; // mémorisation de la valeur
//            $numParam++;
//        }
//        // Clause de restriction
//        $query.= " WHERE IDPERSONNE = ? ";
//        $tabValeurs[] = $valeurClePrimaire;
//        $queryPrepare = $pdo->prepare($query);
//        // Exécution de la requête
//        $retour = $queryPrepare->execute($tabValeurs);
//        $this->deconnecter();
//
//        return $retour;
//    }
//
//    //même que précédent mais pour une organisation
//    function updateE($valeurClePrimaire, $tabChampsValeurs) {
//        $pdo = $this->connecter();
//        // Construction de la requête textuelle
//        $query = "UPDATE " . $this->table . " SET ";
//        $tabValeurs = array();   // tableau des valeurs à construire pour l'exécution de la requête
//        $numParam = 0;              // on compte les paramètres : le premier n'est pas précédé d'une virgule
//        foreach ($tabChampsValeurs as $champ => $valeur) {
//            if ($numParam != 0) {
//                $query.= ", ";
//            }
//            $query.= $champ . " = ? ";  // ajout d'une clause du type champ = ?
//            $tabValeurs[] = $valeur; // mémorisation de la valeur
//            $numParam++;
//        }
//        // Clause de restriction
//        $query.= " WHERE IDORGANISATION = ? ";
//        $tabValeurs[] = $valeurClePrimaire;
//        $queryPrepare = $pdo->prepare($query);
//        // Exécution de la requête
//        $retour = $queryPrepare->execute($tabValeurs);
//        $this->deconnecter();
//
//        return $retour;
//    }
//
//    /**
//     * insert
//     * ajouter un enregistrement dans la table 
//     * @param type $tabValeurs : tableau indexé des valeurs à intégrer à la requête (sans l'identifiant)
//     * @return boolean : succès/échec de l'insertion
//     */
//    function insert($tabValeurs) {
//        $pdo = $this->connecter();
//        $query = "INSERT INTO " . $this->table . " VALUES ( null";
//        // Pour chaque valeur à ajouter dans l'enregistrement, insérer un ?
//        for ($i = 0; $i < count($tabValeurs); $i++) {
//            $query.= ",?";
//        }
//        $query.= " ) ";
//
//        $queryPrepare = $pdo->prepare($query);
//        $retour = $queryPrepare->execute($tabValeurs);
//        $this->deconnecter();
//        return $retour;
//    }
//
//    /**
//     * delete
//     * Supprimer un enregistrement de la table
//     * @param type $valeurClePrimaire : identifiant de la table
//     * @return boolean : succès/échec de la suppression
//     */
//    function delete($valeurClePrimaire) {
//        $pdo = $this->connecter();
//        $query = "DELETE FROM " . $this->table;
//        $query.= " WHERE " . $this->clePrimaire . ' = ?';
//        $queryPrepare = $pdo->prepare($query);
//        $retour = $queryPrepare->execute(array($valeurClePrimaire));
//        $this->deconnecter();
//        return $retour;
//    }

    // ACCESSEURS et MUTATEURS
    public function getPdo() {
        return $this->pdo;
    }

    public function setPdo($pdo) {
        $this->pdo = $pdo;
    }

//    function getAllStage() {
//        $pdo = $this->connecter();
//        // Requête textuelle
//        $query = "SELECT p1.NOM AS NOM_ELEVE, p1.PRENOM AS PRENOM_ELEVE, NOM_ORGANISATION,p.NOM AS NOM_PROF, p.PRENOM AS PRENOM_PROF ,DATEDEBUT, DATEFIN, VILLE, DIVERS  FROM " . $this->table . " 
//        INNER JOIN PERSONNE p1 ON STAGE.IDETUDIANT = p1.IDPERSONNE
//        INNER JOIN PERSONNE p ON STAGE.IDPROFESSEUR = p.IDPERSONNE
//        INNER JOIN ORGANISATION ON STAGE.IDORGANISATION = ORGANISATION.IDORGANISATION
//        ORDER BY " . $this->clePrimaire . " DESC";
//        // Exécuter la requête
//        $resultSet = $pdo->query($query);
//        // FETCH_CLASS permet de retourner des enregistrements sous forme d'objets de la classe spécifiée
//        // ici : $this->nomClasseMetier contient "Enregistrement"
//        // La classe Enregistrement est une classe générique vide qui sera automatiquement affublée d'autant
//        // d'attributs publics qu'il y a de colonnes dans le jeu d'enregistrements
//        $retour = $resultSet->fetchAll(PDO::FETCH_CLASS, $this->nomClasseMetier);
//        $this->deconnecter();
//        return $retour;
//    }
//
//    function getAllEtudiant() {
//        $pdo = $this->connecter();
//        // Requête textuelle
//        $query = "SELECT * FROM PERSONNE WHERE IDROLE=4";
//        // Exécuter la requête
//        $resultSet = $pdo->query($query);
//        // FETCH_CLASS permet de retourner des enregistrements sous forme d'objets de la classe spécifiée
//        // ici : $this->nomClasseMetier contient "Enregistrement"
//        // La classe Enregistrement est une classe générique vide qui sera automatiquement affublée d'autant
//        // d'attributs publics qu'il y a de colonnes dans le jeu d'enregistrements
//        $retour = $resultSet->fetchAll(PDO::FETCH_CLASS, $this->nomClasseMetier);
//        $this->deconnecter();
//        return $retour;
//    }
//
//    function getAllProf() {
//        $pdo = $this->connecter();
//        // Requête textuelle
//        $query = "SELECT * FROM PERSONNE WHERE IDROLE=3";
//        // Exécuter la requête
//        $resultSet = $pdo->query($query);
//        // FETCH_CLASS permet de retourner des enregistrements sous forme d'objets de la classe spécifiée
//        // ici : $this->nomClasseMetier contient "Enregistrement"
//        // La classe Enregistrement est une classe générique vide qui sera automatiquement affublée d'autant
//        // d'attributs publics qu'il y a de colonnes dans le jeu d'enregistrements
//        $retour = $resultSet->fetchAll(PDO::FETCH_CLASS, $this->nomClasseMetier);
//        $this->deconnecter();
//        return $retour;
//    }
//
//    function getAllMaitreDeStage() {
//        $pdo = $this->connecter();
//        // Requête textuelle
//        $query = "SELECT * FROM PERSONNE WHERE IDROLE=5";
//        // Exécuter la requête
//        $resultSet = $pdo->query($query);
//        // FETCH_CLASS permet de retourner des enregistrements sous forme d'objets de la classe spécifiée
//        // ici : $this->nomClasseMetier contient "Enregistrement"
//        // La classe Enregistrement est une classe générique vide qui sera automatiquement affublée d'autant
//        // d'attributs publics qu'il y a de colonnes dans le jeu d'enregistrements
//        $retour = $resultSet->fetchAll(PDO::FETCH_CLASS, $this->nomClasseMetier);
//        $this->deconnecter();
//        return $retour;
//    }
//
//    function getAllOrganisation() {
//        $pdo = $this->connecter();
//        // Requête textuelle
//        $query = "SELECT * FROM ORGANISATION ORDER BY NOM_ORGANISATION";
//        // Exécuter la requête
//        $resultSet = $pdo->query($query);
//        // FETCH_CLASS permet de retourner des enregistrements sous forme d'objets de la classe spécifiée
//        // ici : $this->nomClasseMetier contient "Enregistrement"
//        // La classe Enregistrement est une classe générique vide qui sera automatiquement affublée d'autant
//        // d'attributs publics qu'il y a de colonnes dans le jeu d'enregistrements
//        $retour = $resultSet->fetchAll(PDO::FETCH_CLASS, $this->nomClasseMetier);
//        $this->deconnecter();
//        return $retour;
//    }
//
//    function getAllAnneesScolaire() {
//        $pdo = $this->connecter();
//        // Requête textuelle
//        $query = "SELECT * FROM ANNEESCOL";
//        // Exécuter la requête
//        $resultSet = $pdo->query($query);
//        // FETCH_CLASS permet de retourner des enregistrements sous forme d'objets de la classe spécifiée
//        // ici : $this->nomClasseMetier contient "Enregistrement"
//        // La classe Enregistrement est une classe générique vide qui sera automatiquement affublée d'autant
//        // d'attributs publics qu'il y a de colonnes dans le jeu d'enregistrements
//        $retour = $resultSet->fetchAll(PDO::FETCH_CLASS, $this->nomClasseMetier);
//        $this->deconnecter();
//        return $retour;
//    }

}
