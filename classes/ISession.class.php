<?php

interface ISession {

    // mettre fin à la session authentifiée
    static function fermer() ;

    /** ouvrir une nouvelle session authentifiée :
     *   - générer un nouvel identifiant de session
     *   - enregistrer la ou les donnée(s) de session fournies en paramètre
     * @param array() $lesDonneesSession : tableau associatif contenant les données à inscrire en session
     */    
    static function nouvelle($lesDonneesSession);
    
    /**
     * Vérifie qu'une session est en cours
     * @param array() $lesDonneesSession : tableau contenant la liste des noms de données à vérifier
     * @return boolean =true si la session est bien en cours ; =false sinon
     */
    static function estAuthentifie($lesDonneesSession);

}

?>
