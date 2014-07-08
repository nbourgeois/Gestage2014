<?php

class M_DaoPersonne extends M_DaoGenerique {

    function __construct() {
        $this->nomTable = "PERSONNE";
        $this->nomClefPrimaire = "IDPERSONNE";
    }

    /**
     * Redéfinition de la méthode abstraite de M_DaoGenerique
     * Permet d'instancier un objet d'après les valeurs d'un enregistrement lu dans la base de données
     * @param tableau-associatif $unEnregistrement liste des valeurs des champs d'un enregistrement
     * @return objet :  instance de la classe métier, initialisée d'après les valeurs de l'enregistrement 
     */
    public function enregistrementVersObjet($enreg) {
        // on instancie les objets Role et Specialite s'il y a lieu
        $leRole = null;
        if (isset($enreg['LIBELLE'])) {
            $daoRole = new M_DaoRole();
            $daoRole->setPdo($this->pdo);
            $leRole = $daoRole->getOneById($enreg['IDROLE']);
        }
        $laSpecialite = null;
        if (isset($enreg['LIBELLELONGSPECIALITE'])) {
            $daoSpe = new M_DaoSpecialite();
            $daoSpe->setPdo($this->pdo);
            $laSpecialite = $daoSpe->getOneById($enreg['IDSPECIALITE']);
        }
        // on construit l'objet Personne 
        $retour = new M_Personne(
                $enreg['IDPERSONNE'], $laSpecialite, $leRole, $enreg['CIVILITE'], $enreg['NOM'], $enreg['PRENOM'], $enreg['NUM_TEL'], $enreg['ADRESSE_MAIL'], $enreg['NUM_TEL_MOBILE'], $enreg['ETUDES'], $enreg['FORMATION'], $enreg['LOGINUTILISATEUR'], $enreg['MDPUTILISATEUR']
        );
        return $retour;
    }

    /**
     * Prépare une liste de paramètres pour une requête SQL UPDATE ou INSERT
     * @param Object $objetMetier
     * @return array : tableau ordonné de valeurs
     */
    public function objetVersEnregistrement($objetMetier) {
        // construire un tableau des paramètres d'insertion ou de modification
        // l'ordre des valeurs est important : il correspond à celui des paramètres de la requête SQL
        // le rôle et la spécialité seront mis à jour séparément
        if (!is_null($objetMetier->getRole())) {
            $idRole = $objetMetier->getRole()->getId();
        } else {
            $idRole = 0; // "Autre" (simple visiteur)
        }
        $retour = array(
            ':idRole' => $idRole,
            ':civilite' => $objetMetier->getCivilite(),
            ':nom' => $objetMetier->getNom(),
            ':prenom' => $objetMetier->getPrenom(),
            ':numTel' => $objetMetier->getNumTel(),
            ':mail' => $objetMetier->getMail(),
            ':mobile' => $objetMetier->getMobile(),
            ':etudes' => $objetMetier->getEtudes(),
            ':formation' => $objetMetier->getFormation(),
            ':login' => $objetMetier->getLogin(),
            ':mdp' => $objetMetier->getMdp(),
        );
        return $retour;
    }

    /**
     * Lire tous les enregistrements d'une table
     * @return tableau-associatif d'objets : un tableau d'instances de la classe métier
     */
    function getAll() {
        echo "--- getAll redéfini ---<br/>";
        $retour = null;
        // Requête textuelle
        $sql = "SELECT * FROM $this->nomTable P ";
        $sql .= "LEFT OUTER JOIN SPECIALITE S ON S.IDSPECIALITE = P.IDSPECIALITE ";
        $sql .= "LEFT OUTER JOIN ROLE R ON R.IDROLE = P.IDROLE ";
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
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    // eager-fetching
    function getOneById($id) {
        $retour = null;
        try {
            // Requête textuelle
            $sql = "SELECT * FROM $this->nomTable P ";
            $sql .= "LEFT OUTER JOIN SPECIALITE S ON S.IDSPECIALITE = P.IDSPECIALITE ";
            $sql .= "LEFT OUTER JOIN ROLE R ON R.IDROLE = P.IDROLE ";
            $sql .= "WHERE $this->nomClefPrimaire = :id";
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array(':id' => $id))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = $this->enregistrementVersObjet($enregistrement);
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    // eager-fetching
    function getOneByLogin($valeurLogin) {
        $retour = null;
        try {
            // Requête textuelle
            $sql = "SELECT * FROM $this->nomTable P ";
            $sql .= "LEFT OUTER JOIN SPECIALITE S ON S.IDSPECIALITE = P.IDSPECIALITE ";
            $sql .= "LEFT OUTER JOIN ROLE R ON R.IDROLE = P.IDROLE ";
            $sql .= "WHERE P.LOGINUTILISATEUR = ?";
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
            if ($queryPrepare->execute(array($valeurLogin))) {
                // si la requête réussit :
                // extraire l'enregistrement retourné par la requête
                $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
                // construire l'objet métier correspondant
                $retour = $this->enregistrementVersObjet($enregistrement);
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    /**
     * verifierLogin
     * @param string $login
     * @param string $mdp
     * @return boolean 
     */
    function verifierLogin($login, $mdp) {
        $retour = null;
        try {
            $sql = "SELECT * FROM $this->nomTable WHERE LOGINUTILISATEUR=:login AND MDPUTILISATEUR=:mdp";
            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute(array(':login' => $login, ':mdp' => sha1($mdp)))) {
                $retour = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    /**
     * suppression
     * @param type $idMetier
     * @return boolean Cette fonction retourne TRUE en cas de succès ou FALSE si une erreur survient.
     */
    function insert($objetMetier) {
        $retour = FALSE;
        try {
            // Requête textuelle paramétrée (paramètres nommés)
            $sql = "INSERT INTO $this->nomTable (";
            $sql .= "CIVILITE,IDROLE,NOM,PRENOM,NUM_TEL,ADRESSE_MAIL,NUM_TEL_MOBILE,";
            $sql .= "ETUDES,FORMATION,LOGINUTILISATEUR,MDPUTILISATEUR)  ";
            $sql .= "VALUES (";
            $sql .= ":civilite, :idRole, :nom, :prenom, :numTel, :mail, :mobile, ";
            $sql .= ":etudes, :formation, :login, :mdp)";
//            var_dump($sql);
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // préparer la  liste des paramètres, avec l'identifiant en dernier
            $parametres = $this->objetVersEnregistrement($objetMetier);
            // exécuter la requête avec les valeurs des paramètres dans un tableau
            $retour = $queryPrepare->execute($parametres);
//            debug_query($sql, $parametres);
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

    function update($idMetier, $objetMetier) {
        $retour = FALSE;
        try {
            // Requête textuelle paramétrée (paramètres nommés)
            $sql = "UPDATE $this->nomTable SET ";
            $sql .= "IDROLE = :idRole , ";
            $sql .= "CIVILITE = :civilite , ";
            $sql .= "NOM = :nom , ";
            $sql .= "PRENOM = :prenom , ";
            $sql .= "NUM_TEL = :numTel , ";
            $sql .= "ADRESSE_MAIL = :mail , ";
            $sql .= "NUM_TEL_MOBILE = :mobile , ";
            $sql .= "ETUDES = :etudes , ";
            $sql .= "FORMATION = :formation , ";
            $sql .= "LOGINUTILISATEUR = :login , ";
            $sql .= "MDPUTILISATEUR = :mdp ";
            $sql .= "WHERE IDPERSONNE = :id";
//            var_dump($sql);
            // préparer la requête PDO
            $queryPrepare = $this->pdo->prepare($sql);
            // préparer la  liste des paramètres la valeur de l'identifiant
            //  à prendre en compte est celle qui a été passée en paramètre à la méthode
            $parametres = $this->objetVersEnregistrement($objetMetier);
            $parametres[':id'] = $idMetier;
            // exécuter la requête avec les valeurs des paramètres dans un tableau
            $retour = $queryPrepare->execute($parametres);
//            debug_query($sql, $parametres);
        } catch (PDOException $e) {
            echo get_class($this) . ' - ' . __METHOD__ . ' : ' . $e->getMessage();
        }
        return $retour;
    }

}


