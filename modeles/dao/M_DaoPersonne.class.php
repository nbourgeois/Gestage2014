<?php

class M_DaoPersonne extends M_DaoGenerique {

//    protected $valeurLogin = '$_SESSION["auth"]["login"]';

    function __construct() {
        $this->nomTable = "PERSONNE";
        $this->nomClefPrimaire = "IDPERSONNE";
    }

    /**
     * Redéfinition de la méthode abstraite de M_DaoGenerique
     * Permet d'instancier un objet d'après les valeurs d'un enregistrement lu dans la base de données
     * La stratégie de chargement est le "lazy-loading" : on ne charge que l'objet principal, pas ceux qui lui sont liés par des associations
     * @param tableau-associatif $unEnregistrement liste des valeurs des champs d'un enregistrement
     * @return objet :  instance de la classe métier, initialisée d'après les valeurs de l'enregistrement 
     */
    public function enregistrementVersObjet($enreg) {
        $leRole = null;         // "lazy-loading"
        $laSpecialite = null;   // "lazy-loading"
        $retour = new M_Personne(
                $enreg['IDPERSONNE'], $laSpecialite, $leRole, $enreg['CIVILITE'], $enreg['NOM'], $enreg['PRENOM'], $enreg['NUM_TEL'], $enreg['ADRESSE_MAIL'], $enreg['NUM_TEL_MOBILE'], $enreg['ETUDES'], $enreg['FORMATION'], $enreg['LOGINUTILISATEUR'], $enreg['MDPUTILISATEUR']
        );
        return $retour;
    }

    public function enregistrementVersObjetEager($enreg) {
        // on construit l'objet Personne sans spécialité ni rôle
        $retour = $this->enregistrementVersObjet($enreg);
        // on instancie les objets Role et Specialite s'il y a lieu
        var_dump($enreg);
        $leRole = null;
        if ($enreg['IDROLE'] != null) {
            $leRole = new M_Role($enreg['IDROLE'], $enreg['RANG'], $enreg['LIBELLE']);
        }
        $laSpecialite = null;
        if ($enreg['IDSPECIALITE'] != null) {
            $laSpecialite = new M_Specialite($enreg['IDSPECIALITE'], $enreg['LIBELLECOURTSPECIALITE'], $enreg['LIBELLELONGSPECIALITE']);
        }
        // ces objets sont liés à la personne
        $retour->setRole($leRole) ;
        $retour->setSpecialite($laSpecialite);
        return $retour;
    }

    // eager-fetching
    function getOneByLoginEager($valeurLogin) {
        $retour = null;
        $pdo = $this->connecter();
        // Requête textuelle
        $sql = "SELECT * FROM $this->nomTable P ";
        $sql .= "LEFT OUTER JOIN SPECIALITE S ON S.IDSPECIALITE = P.IDSPECIALITE ";
        $sql .= "LEFT OUTER JOIN ROLE R ON R.IDROLE = P.IDROLE ";
        $sql .= "WHERE P.LOGINUTILISATEUR = ?";
        // préparer la requête PDO
        $queryPrepare = $pdo->prepare($sql);
        // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
        if ($queryPrepare->execute(array($valeurLogin))) {
            // si la requête réussit :
            // extraire l'enregistrement retourné par la requête
            $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
            // construire l'objet métier correspondant
            $retour = $this->enregistrementVersObjetEager($enregistrement);
        }
        $this->deconnecter();
        return $retour;
    }

    /**
     * Lire un enregistrement d'après la valeur du login de l'utilisateur 
     * @param type $valeurLogin
     * @return objet : une instance Personne
     */
    function getOneByLoginLazy($valeurLogin) {
        $retour = null;
        $pdo = $this->connecter();
        // Requête textuelle paramétrée (le paramètre est symbolisé par un ?
        $query = "SELECT * FROM $this->nomTable WHERE LOGINUTILISATEUR = ?";
        // préparer la requête PDO
        $queryPrepare = $pdo->prepare($query);
        // exécuter la requête avec les valeurs des paramètres (il n'y en a qu'un ici) dans un tableau
        if ($queryPrepare->execute(array($valeurLogin))) {
            // si la requête réussit :
            // extraire l'enregistrement retourné par la requête
            $enregistrement = $queryPrepare->fetch(PDO::FETCH_ASSOC);
            // construire l'objet métier correspondant
            $retour = $this->enregistrementVersObjet($enregistrement);
        }
        $this->deconnecter();
        return $retour;
    }

    /**
     * verifierLogin
     * @param string $login
     * @param string $mdp
     * @return boolean 
     */
    function verifierLogin($login, $mdp) {
        $retour=null;
        $pdo = $this->connecter();
        if ($pdo) {
            $sql = "SELECT * FROM $this->nomTable WHERE LOGINUTILISATEUR=:login AND MDPUTILISATEUR=:mdp";
            $stmt = $pdo->prepare($sql);
            $execute = $stmt->execute(array(':login' => $login, ':mdp' => sha1($mdp)));
            $retour = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $retour;
    }



}

?>
