<!-- VARIABLES NECESSAIRES -->
<!-- Constantes globales  de includes/version.inc.php -->
<!-- loginAuthentification : login si authentification ok -->
<!-- listeCateg : tableau de <Enregistrement> avec les champs 'cat_code' et 'cat_libelle' -->
<div id="gauche">
    <ul class="menugauche">
        <p><h2>Menu</h2></p><p class="note">
        <li><a href="./index.php" >-Accueil</a></li>
        <hr/>
        <?php
        if (!is_null($this->lireDonnee('loginAuthentification'))) {
            echo "<h2>Partie " . $this->lireDonnee('loginAuthentification') . "</h2>";
            //menu de gauche présent pour tous les utilisateurs
            echo "<li><a href=\".?controleur=utilisateur&action=coordonees\">-Mes informations</a></li>";
            echo "<li><a href=\".?controleur=utilisateur&action=afficherEntreprise\">-Afficher les entreprises</a></li>";
        } else {
            echo "<li><a href=\".?controleur=connexion&action=seConnecter\">Se connecter</a></li>";
        }
        if (!is_null($this->lireDonnee('loginAuthentification')) && MaSession::get('role') == 1) {
            //ajout menu de gauche pour l'administrateur
            echo "<hr>";
            echo "<li><a href=\".?controleur=administrateur&action=creerUtilisateur\">-Cr&eacute;er un utilisateur</a></li>";
            echo "<li><a href=\".?controleur=administrateur&action=afficherEleve\">-Afficher tout les eleves</a></li>";
//    echo "<li><a href=\".?controleur=administrateur&action=creerClasse\">-Cr&eacute;er une classe</a></li>";
            echo "<li><a href=\".?controleur=administrateur&action=creerUtilisateur&role=MaitreStage\">-Ajouter un maitre de stage</a></li>";
        }
        if (!is_null($this->lireDonnee('loginAuthentification')) && MaSession::get('role') != 2) {
            //ajout menu de gauche pour les utilisateurs autres que secrétaire
            echo "<hr>";
            echo "<li><a href=\".?controleur=utilisateur&action=creerEntreprise\">-Ajouter une entreprise</a></li>";
            echo "<li><a href=\".?controleur=utilisateur&action=MajEntreprise\">-M.A.J entreprise</a></li>";
            echo "<hr>";
            echo "<li><a href=\".?controleur=utilisateur&action=ajoutStage\">-Ajouter un stage</a></li>";
            echo "<li><a href=\".?controleur=utilisateur&action=afficheListeStage\">-Liste des stages</a></li>";
            echo "<hr>";
        }
        ?>
    </ul>
</div>