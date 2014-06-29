<?php

class C_Connexion extends C_ControleurGenerique {

    /**
     * controleur= connexion & action= seConnecter
     * Afficher le formulaire d'authentification au centre
     */
    function seConnecter() {
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee("titreVue","GestStage : Connexion");
        // Centre : formulaire de connexion
        $this->vue->ecrireDonnee('centre',"../vues/includes/connexion/centreSeConnecterFormulaire.inc.php");
        $this->vue->afficher();
    }

    /**
     * controleur= accueil & action= authentifier
     * Vérifier les données d'authentification :
     *  - si c'est correct, démarrer une nouvelle session et afficher la page d'accueil
     *  - sinon, réafficher l'écran d'authentification
     */
    function authentifier() {
        $this->vue = new V_Vue("../vues/templates/template.inc.php");
        $this->vue->ecrireDonnee('titreVue',"GestStage : Accueil");
        $this->vue->ecrireDonnee('centre',"../vues/includes/connexion/centreAuthentifier.inc.php");


        //------------------------------------------------------------------------
        // VUE CENTRALE
        //------------------------------------------------------------------------
        $daoPersonne = new M_DaoPersonne();
        // Vérifier login et mot de passe saisis dans la formulaire d'authentification
        if (isset($_POST['login']) && isset($_POST['mdp'])) {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $daoPersonne->connecter();
            $unUser = $daoPersonne->verifierLogin($login, $mdp);
            $daoPersonne->deconnecter();
            if ($unUser) {
                // Si le login et le mot de passe sont valides, ouvrir une nouvelle session
                MaSession::nouvelle(array('login' => $login, 'role' => $unUser["IDROLE"])); // service minimum
                header("Location:  index.php");
//                $this->vue->getDonnees['message'] = "Authentification r&eacute;ussie";
//                $this->vue->getDonnees['centre'] = "../vues/connexion/centreAuthentifier.inc.php";
            } else {
                $this->vue->ecrireDonnee('message',"ECHEC d'identification : login ou mot de passe inconnus ");
                $this->vue->ecrireDonnee('centre',"../vues/includes/connexion/centreSeConnecterFormulaire.inc.php");
            }
        } else {
            $this->vue->ecrireDonnee('message',"Attention : le login ou le mot de passe ne sont pas renseign&eacute;s");
            $this->vue->ecrireDonnee('centre',"../vues/includes/connexion/centreSeConnecterFormulaire.inc.php");
        }
        //------------------------------------------------------------------------

        $this->vue->ecrireDonnee('loginAuthentification', MaSession::get('login'));
        $this->vue->afficher();


//        $this->vue->ajouterDonnee('roleAuthentification', get('idRole'));
    }

    /**
     * controleur= accueil & action= seDeconnecter
     * Afficher fermer la session en cours et afficher la page d'accueil
     */
    function seDeconnecter() {
        MaSession::fermer();
        header("Location:  index.php");
    }

}
