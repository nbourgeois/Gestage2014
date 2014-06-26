<?php

/**
 * Description of M_Role
 *
 * @author btssio
 */
class M_Role {

    private $id; // type : int
    private $rang; // type : int
    private $libelle; // ADMINISTRATEUR, PROFESSEUR, ETUDIANT, UTILISATEUR, CONTACT

    function __construct($id, $rang, $libelle) {
        $this->id = $id;
        $this->rang = $rang;
        $this->libelle = $libelle;
    }
    
}
