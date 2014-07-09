function gotoUrl($url) {
    window.location = $url;
}

//fonction de choix de roles
function choixRole() {
//    $monDiv1 = document.getElementById('Formulaire_MaitreStage');
    $monDiv = document.getElementById('Formulaire_Etudiant');
    $monSelect = document.getElementById('role');//récupération de la valeur du roles
    //formulaire qui sera modifier par la fonction
    $monDiv.style.visibility = 'hidden';
    $monDiv.style.height = "0";
//    $monDiv1.style.visibility = 'hidden';
//    $monDiv1.style.height = "0";

    switch ($monSelect.value) { // 4 : Etudiant ; 5 : Maître de stage
        case "4" ://Etudiant
            $monDiv.style.visibility = 'visible';
            $monDiv.style.height = "100%";
//            $monDiv1.style.visibility = 'hidden';
//            $monDiv1.style.height = "0";
            break;
        case "5" : //MaitreDeStage
//            $monDiv1.style.visibility = 'visible';
//            $monDiv1.style.height = "100%";
            $monDiv.style.visibility = 'hidden';
            $monDiv.style.height = "0";
            break;
        default://laisse les option caché pour tout autres utilisateur
            $monDiv.style.visibility = 'hidden';
            $monDiv.style.height = "0";
//            $monDiv1.style.visibility = 'hidden';
//            $monDiv1.style.height = "0";
    }
}





// validation création utilisateur
function valider()
{
    var ok = 1;

    if (document.getElementById('nom').value == "")
    {
        alert("Veuillez indiquer votre nom.");
        ok = 0;
        document.getElementById('nom').focus();
        return false;
    }
    if (document.getElementById('prenom').value == "")
    {
        alert("Veuillez indiquer votre prenom.");
        ok = 0;
        document.getElementById('prenom').focus();
        return false;
    }
    if (document.getElementById('tel').value == "")
    {
        alert("Veuillez indiquer votre téléphone.");
        ok = 0;
        document.getElementById('tel').focus();
        return false;
    }
    if (isNaN(document.getElementById('tel').value))
    {
        alert("Votre téléphone ne comporte pas uniquement des chiffres. \nVeuillez corriger.");
        ok = 0;
        document.getElementById('tel').focus();
        return false;
    }
    if ((document.getElementById('tel').value.length > 10) || (document.getElementById('tel').value.length < 10))
    {
        alert("Votre téléphone ne comporte pas 10 chiffres.");
        ok = 0;
        document.getElementById('tel').focus();
        return false;
    }

    if (isNaN(document.getElementById('tel').value))
    {
        alert("Votre téléphone portable ne comporte pas uniquement des chiffres. \nVeuillez corriger.");
        ok = 0;
        document.getElementById('tel').focus();
        return false;
    }
    if ((document.getElementById('telP').value.length > 10) || (document.getElementById('tel').value.length < 10))
    {
        alert("Votre téléphone portable ne comporte pas 10 chiffres.");
        ok = 0;
        document.getElementById('tel').focus();
        return false;
    }
    if (document.getElementById('mail').value == "")
    {
        alert("Veuillez indiquer votre adresse email.");
        ok = 0;
        document.getElementById('mail').focus();
        return false;
    }

    if ((document.getElementById('mail').value.indexOf("@", 0) < 0) || (document.getElementById('mail').value.indexOf(".", 0) < 0))
    {
        alert("Adresse email incorrecte. \nVeuillez corriger;");
        ok = 0;
        document.getElementById('mail').focus();
        return false;
    }
    if (document.getElementById('login').value == "")
    {
        alert("Veuillez indiquer votre login.");
        ok = 0;
        document.getElementById('login').focus();
        return false;
    }
    if (document.getElementById('mdp').value == "")
    {
        alert("Veuillez indiquer votre mot de passe.");
        ok = 0;
        document.getElementById('mdp').focus();
        return false;
    }
    if (document.getElementById('mdp').value.length < 7)
    {
        alert("Votre mot de passe doit comporter au moins 7 caractères.");
        ok = 0;
        document.getElementById('mdp').focus();
        return false;
    }
    if (document.getElementById('mdp2').value == "")
    {
        alert("Veuillez indiquer votre vérification de mot de passe.");
        ok = 0;
        document.getElementById('mdp2').focus();
        return false;
    }
    if (document.getElementById('mdp2').value.length < 7)
    {
        alert("Votre vérification de mot de passe doit comporté au moins 7 caractères.");
        ok = 0;
        document.getElementById('mdp2').focus();
        return false;
    }
    if ((document.getElementById('mdp').value) != (document.getElementById('mdp2').value))
    {
        alert("Vos mots de passes sont différents.");
        ok = 0;
        document.getElementById('mdp').focus();
        return false;
    }

    if (ok == 1) {

        document.submit();

    }

}
//VAlidation création entreprise
function validerE()
{
    var ok = 1;


    if (document.getElementById('nom').value == "")
    {
        alert("Veuillez indiquer le nom de l'entreprise.");
        ok = 0;
        document.getElementById('nom').focus();
        return false;
    }
    if (document.getElementById('ville').value == "")
    {
        alert("Veuillez indiquer la ville de l'entreprise.");
        ok = 0;
        document.getElementById('ville').focus();
        return false;
    }

    if (document.getElementById('ads').value == "")
    {
        alert("Veuillez indiquer l'adresse l'entreprise.");
        ok = 0;
        document.getElementById('ads').focus();
        return false;
    }
    if (document.getElementById('cp').value == "")
    {
        alert("Veuillez indiquer le code postal.");
        ok = 0;
        document.getElementById('cp').focus();
        return false;
    }
    if (isNaN(document.getElementById('cp').value))
    {
        alert("Le code postal ne comporte pas uniquement des chiffres. \nVeuillez corriger.");
        ok = 0;
        document.getElementById('cp').focus();
        return false;
    }
    if ((document.getElementById('cp').value.length > 5) || (document.getElementById('cp').value.length < 5))
    {
        alert("Le code postal ne comporte pas 5 chifre.");
        ok = 0;
        document.getElementById('cp').focus();
        return false;
    }
    if (document.getElementById('tel').value == "")
    {
        alert("Veuillez indiquer le téléphone de l'entreprise.");
        ok = 0;
        document.getElementById('tel').focus();
        return false;
    }
    if (isNaN(document.getElementById('tel').value))
    {
        alert("Le téléphone ne comporte pas uniquement des chiffres. \nVeuillez corriger.");
        ok = 0;
        document.getElementById('tel').focus();
        return false;
    }
    if ((document.getElementById('tel').value.length > 10) || (document.getElementById('tel').value.length < 10))
    {
        alert("Le téléphone ne comporte pas 10 chifre.");
        ok = 0;
        document.getElementById('tel').focus();
        return false;
    }
    if (document.getElementById('fj').value == "")
    {
        alert("Veuillez indiquer sa forme juridique.");
        ok = 0;
        document.getElementById('fj').focus();
        return false;
    }
    if (ok == 1) {

        document.submit();

    }

}


function validerStage()
{
    var ok = 1;


    if (document.getElementById('date_debut').value == "")
    {
        alert("Veuillez indiquer une date de debut !");
        ok = 0;
        document.getElementById('date_debut').focus();
        return false;
    }

    if (document.getElementById('date_fin').value == "")
    {
        alert("Veuillez indiquer une date de fin !");
        ok = 0;
        document.getElementById('date_fin').focus();
        return false;
    }

    if (document.getElementById('date_visite').value == "")
    {
        alert("Veuillez indiquer une date de visite !");
        ok = 0;
        document.getElementById('date_visite').focus();
        return false;
    }

    if (document.getElementById('ville').value == "")
    {
        alert("Veuillez indiquer une ville!");
        ok = 0;
        document.getElementById('ville').focus();
        return false;
    }

    if (isNaN(document.getElementById('participation_ccf').value))
    {
        alert("La participation CCF ne peut être que composé de chiffres !");
        ok = 0;
        document.getElementById('participation_ccf').focus();
        return false;
    }

    if (ok == 1) {

        document.submit();

    }

}



// donction d'impretion
//function imprimer(){
///var impression=document.creatElement("a");
/// var test_impression=document.createTextNode("Imprimer La sélection");
/// impression.appendChild(test_impression);
/// var imprimersortie=document.getElementByID("tableau");
/// imprimersortie.appendChild(impression);
//}
function imprimer() {
    document.body.className += "print";
    windows.print();
    document.body.className = document.body.classNAme.replace(/\bprint\b/, "");

}
    