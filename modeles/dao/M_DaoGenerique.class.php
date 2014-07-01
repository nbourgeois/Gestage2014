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
                $this->getPdo()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
     * Prépare une liste de paramètres pour une requête SQL UPDATE ou INSERT
     * @param Object $objetMetier
     * @return array : tableau ordonné de valeurs
     */
    abstract function objetVersEnregistrement($objetMetier) ;

    /**
     * Lire tous les enregistrements d'une table
     * @return tableau-associatif d'objets : un tableau d'instances de la classe métier
     */
    function getAll() {
        $retour = null;
        // Requête textuelle
        $sql = "SELECT * FROM $this->nomTable ORDER BY $this->nomClefPrimaire";
        try {
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête PDO
            if ($queryPrepare->execute()) {
                // si la requête réussit :
                // initialiser le tableau d'objets à retourner
                $retour = array();
                // pour chaque enregistrement retourné par la requête
                while ($enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC)) {
                    // construir un objet métier correspondant
                    $unObjetMetier = $this->enregistrementVersObjet($enregistrement);
                    // ajouter l'objet au tableau
                    $retour[] = $unObjetMetier;
                }
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }

    /**
     * Lire un enregistrement d'après une valeur de clef primaire
     * la stratégie de chargement est ici le "lazy-loading" : on ne charge pas les objets éventuellement liés
     * @param $valeurClePrimaire
     * @return objet : une instance de la classe métier
     */
    function getOneById($valeurClePrimaire) {
        $retour = null;
        try {
            // Requête textuelle paramétrée (le paramètre est symbolisé par un ?)
            $sql = "SELECT * FROM $this->nomTable  WHERE $this->nomClefPrimaire = ?";
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($valeurClePrimaire))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = $this->enregistrementVersObjet($enregistrement);
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - '.__METHOD__ . ' : '. $e->getMessage();
        }
        return $retour;
    }
    
    /**
     * Suppression d'un enregistrement d'après son identifiant
     * @param identifiant métier de l'objet é détruire
     * @return 
     */
    function delete($idMetier) {
        $retour = FALSE;
        try {
            // Requête textuelle paramétrée 
            $sql = "DELETE FROM $this->nomTable WHERE $this->nomClefPrimaire = :id";
            // préparer la  liste des paramètres (1 seul)
            $parametres = array(':id'=>$idMetier);
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            $retour = $queryPrepare->execute($parametres);
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }   

    /**
     * Insertion d'un nouvel enregistrement
     * @param $objetMetier objet métier contenant les données nécessaires à l'ajout
     * @return 
     */
    abstract function insert($objetMetier);

    /**
     * Mise à jour d'un enregistrement d'après son identifiant
     * @param $idMetier identifiant métier de l'objet à modifier
     * @param $objetMetier objet métier modifié
     * @return 
     */
    abstract function update($idMetier, $objetMetier);


    // ACCESSEURS et MUTATEURS
    public function getPdo() {
        return $this->pdo;
    }

    public function setPdo($pdo) {
        $this->pdo = $pdo;
    }

}
