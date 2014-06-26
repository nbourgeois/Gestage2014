<?php
/**
 * Description of M_Personne
 *
 * @author btssio
 */
class M_Personne {
    private $id;
    private $role;          // objet Role
    private $specialite;    // objet Specialite
    private $civilite;
    private $nom;
    private $prenom;
    private $numTel;
    private $mail;
    private $mobile;
    private $etudes;
    private $formation;
    private $login;
    private $mdp;

    function __construct($id, $specialite, $role, $civilite, $nom, $prenom, $numTel, $mail, $mobile, $etudes, $formation, $login, $mdp) {
        $this->id = $id;
        $this->specialite = $specialite;
        $this->role = $role;
        $this->civilite = $civilite;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numTel = $numTel;
        $this->mail = $mail;
        $this->mobile = $mobile;
        $this->etudes = $etudes;
        $this->formation = $formation;
        $this->login = $login;
        $this->mdp = $mdp;
    }


    
    public function getId() {
        return $this->id;
    }

    public function getSpecialite() {
        return $this->specialite;
    }
    
    public function getRole() {
        return $this->role;
    }

    public function getCivilite() {
        return $this->civilite;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNumTel() {
        return $this->numTel;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function getEtudes() {
        return $this->etudes;
    }

    public function getFormation() {
        return $this->formation;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getMdp() {
        return $this->mdp;
    }
    
   public function setId($id) {
        $this->id = $id;
    }

    public function setSpecialite($specialite) {
        $this->specialite = $specialite;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setCivilite($civilite) {
        $this->civilite = $civilite;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setNumTel($numTel) {
        $this->numTel = $numTel;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    public function setEtudes($etudes) {
        $this->etudes = $etudes;
    }

    public function setFormation($formation) {
        $this->formation = $formation;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    
}
