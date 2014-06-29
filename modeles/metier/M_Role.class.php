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
    
    public function getId() {
        return $this->id;
    }

    public function getRang() {
        return $this->rang;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRang($rang) {
        $this->rang = $rang;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    
    
}
