// fermer le modal enregistrer et ouvrir le modal connexion
function connexionModal() {
    $('#enregistrer').modal('hide');
    $('#connexion').modal('show');
}

// fermer le modal connexion et ouvrir le modal enregistrer
function enregistrementModal() {
    $('#connexion').modal('hide');
    $('#enregistrer').modal('show');
}



// ------- Fonctions de page Admin ------- //
// montrer le formulaire
function montrer(elem){
    cacher('enregFilm');
    cacher ('listerFilms');
    cacher('modifierFilm');
    cacher('supprimerFilm');
    cacher ('accesRefuse');
    cacher('modifierMembre');
	
    document.getElementById(elem).style.display='block';
}

function montrerM(elem){
    cacher('listerLocationsPM');
    cacher ('genererFacturePM');
    cacher('afficherProfilPM');
	
    document.getElementById(elem).style.display='block';
}

// cacher le formulaire
function cacher(elem){
    if (document.getElementById(elem).style.display='block'){
        document.getElementById(elem).style.display='none';
    }
	
}

// afficher prénom et nom
function afficherNomMembre(prenomLigne,nomLigne){
    let prenom = prenomLigne;
    let nom = nomLigne;
    
}




// ------- Fonctions de validation des formulaires ------- //
//Lister les films
function envoyerLister(par, valeurPar){
	if (par!==""){
		document.getElementById('par').value=par;
		document.getElementById('valeurPar').value=valeurPar;
	}
	document.getElementById('formLister').submit();
}

// Lister les membres
function envoyerListerMembres(){
    document.getElementById('formListerMembres').submit();
}

//Enregistrement des films
function validerFormEnregFilms(){
    // obtenir les valeurs du formulaire et les mettre dans des variables
    var titreFilm=document.getElementById('titreFilm').value;
	var realisateur=document.getElementById('realisateur').value;
	var categFilm=document.getElementById('categFilm').value;
    var dureeFilm=document.getElementById('dureeFilm').value;
	var langueFilm=document.getElementById('langueFilm').value;
	var dateFilm=document.getElementById('dateFilm').value;
	var urlFilm=document.getElementById('urlPreview').value;
    var prixFilm=document.getElementById('prix').value;
    // var regexUrl=new RegExp('^(?!mailto:)(?:(?:http|https|ftp)://)(?:\\S+(?::\\S*)?@)?(?:(?:(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}(?:\\.(?:[0-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))|(?:(?:[a-z\\u00a1-\\uffff0-9]+-?)*[a-z\\u00a1-\\uffff0-9]+)(?:\\.(?:[a-z\\u00a1-\\uffff0-9]+-?)*[a-z\\u00a1-\\uffff0-9]+)*(?:\\.(?:[a-z\\u00a1-\\uffff]{2,})))|localhost)(?::\\d{2,5})?(?:(/|\\?|#)[^\\s]*)?$');

    var regexDuree=new RegExp("^[0-9]{1,3}$");
    var regexDate=new RegExp("(?:(?:18|19|20|21)[0-9]{2})");
    var regexUrl=new RegExp('(?:https?:\/\/)?(?:www\.)?youtu(?:\.be\/|be.com\/\S*(?:watch|embed)(?:(?:(?=\/[^&\s\?]+(?!\S))\/)|(?:\S*v=|v\/)))([^&\s\?]+)');
    var regexPrix=new RegExp("[0-9]{1,2}+(\.[0-9][0-9])?$/");

    // aller chercher les éléments et les mettre dans des variables
    var mesTitre = document.getElementById("messageTitre"); 
    var mesRealis = document.getElementById("messageRealis"); 
    var mesCateg = document.getElementById("messageCateg"); 
    var mesDuree = document.getElementById("messageDuree"); 
    var mesLang = document.getElementById("messageLangue"); 
    var mesDate = document.getElementById("messageDate"); 
    var mesUrl = document.getElementById("messageUrl"); 
    var mesPrix = document.getElementById("messagePrix"); 

    // lors de la validation cacher les messages d'erreur
    mesTitre.style.display = "none";
    mesRealis.style.display = "none";
    mesCateg.style.display = "none";
    mesDuree.style.display = "none";
    mesLang.style.display = "none";
    mesDate.style.display = "none";
    mesUrl.style.display = "none";
    mesPrix.style.display = "none";

    if (titreFilm == '') { // vérifier que le titre ne soit pas vide
        mesTitre.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 

    if (realisateur == '') { // vérifier que le titre ne soit pas vide
        mesRealis.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 

    if (categFilm == '') { // vérifier que le titre ne soit pas vide
        mesCateg.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 

    if(dureeFilm == '' || !regexDuree.test(dureeFilm)){
        mesDuree.style.display = "block"; // montrer le message d'erreur
	    return false;
    } 

    if (langueFilm == '') { // vérifier que le titre ne soit pas vide
        mesLang.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 

    if(dateFilm == '' || !regexDate.test(dateFilm)){
        mesDate.style.display = "block"; // montrer le message d'erreur
	    return false;
    } 

    if (urlFilm == '' || !regexUrl.test(urlFilm)) { // vérifier que le titre ne soit pas vide
        mesUrl.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 


    if(prixFilm == '' || !regexPrix.test(prixFilm)){
        mesPrix.style.display = "block"; // montrer le message d'erreur
	    return false;
    } 
}

// validation de l'entrée pour la supression
function validerNombre(param){
    var NumFilmS=document.getElementById(param).value;
    var mesSupprimer = document.getElementById('messageSupprimer'); 
    var regexNombre=new RegExp("^[0-9]{1,4}$");
    mesSupprimer.style.display = "none";
    
    if (NumFilmS  == '' || !regexNombre.test(NumFilmS)){
        mesSupprimer.style.display = "block"; // montrer le message d'erreur
        return false;
    }
}

// valider le formulaire d'enregistrement de membre
function validerFormEnreg(formulaire) {
    let prenom = formulaire.prenom.value; // mettre le prénom entré dans une variable
    let nom = formulaire.nom.value; // mettre le nom entré dans une variable
    let courriel = formulaire.courriel.value; // mettre le courriel entré dans une variable
    let motDePasse = formulaire.motDePasse.value; // mettre le mot de passe entré dans une variable
    let repeterMDP = formulaire.repeterMDP.value; // mettre la confirmation du mot de passe entré dans une variable
    let naissance = formulaire.naissance.value; // mettre la confirmation du mot de passe entré dans une variable
    let validationMDP; // pour la validation du mot de passe
    let validationCourriel; // pour la validation du courriel

    var mesPrenom = document.getElementById("messagePrenom"); // aller chercher l'élément messagePrenom
    var mesNom = document.getElementById("messageNom"); // aller chercher l'élément messageNom
    var mesCourriel = document.getElementById("messageCourriel"); // aller chercher l'élément messageCourriel
    var mesMdpErrone = document.getElementById("messageMdpErrone"); // aller chercher l'élément messageMdpErrone
    var mesConfMdpVide = document.getElementById("messageConfMdpVide"); // aller chercher l'élément messageConfMdpVide
    var mesConfMdpErrone = document.getElementById("messageConfMdpErrone"); // aller chercher l'élément messageConfMdpErrone
    var mesNaissance = document.getElementById("messageNaissance"); // aller chercher l'élément messageNaissance

    // lors de la validation cacher les messages d'erreur
    mesPrenom.style.display = "none";
    mesNom.style.display = "none";
    mesCourriel.style.display = "none";
    mesMdpErrone.style.display = "none";
    mesConfMdpVide.style.display = "none";
    mesConfMdpErrone.style.display = "none";
    mesNaissance.style.display = "none";

    // Vérifier que le champs Prénom ne soit pas vide
    if (prenom == '') { 
        mesPrenom.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 
    
    // Vérifier que le champs Nom ne soit pas vide
    if (nom == '') { 
        mesNom.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 

    if (courriel == '') { // si le courriel est vide
        mesCourriel.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else { //sinon valider le courriel
        validationCourriel = validerCourriel(courriel); // appeler la fonction 
        if (validationCourriel == false) {  // si ça retourne false
            mesCourriel.style.display = "block"; // montrer le message d'erreur
            return false; // retourne false
        }
    }
    
    // validation du mot de passe
    validationMDP = verifierMotsDePasses(motDePasse, repeterMDP); // appeler la fonction 
    if (validationMDP == false) { // si ça retourne false
        return false; // retourne false
    } 
    
    // si la date de naissance est vide
    if (naissance == '') {
        mesNaissance.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 
}


// valider le formulaire d'enregistrement de membre
function validerProfil(formulaire) {
    let prenom = formulaire.prenom.value; // mettre le prénom entré dans une variable
    let nom = formulaire.nom.value; // mettre le nom entré dans une variable
    let motDePasse = formulaire.motDePasse.value; // mettre le mot de passe entré dans une variable
    let repeterMDP = formulaire.repeterMDP.value; // mettre la confirmation du mot de passe entré dans une variable
    let naissance = formulaire.naissance.value; // mettre la confirmation du mot de passe entré dans une variable
    let validationMDP; // pour la validation du mot de passe

    var mesPrenom = document.getElementById("messagePrenomPM"); // aller chercher l'élément messagePrenom
    var mesNom = document.getElementById("messageNomPM"); // aller chercher l'élément messageNom
    var mesMdpErrone = document.getElementById("messageMdpErronePM"); // aller chercher l'élément messageMdpErrone
    var mesConfMdpVide = document.getElementById("messageConfMdpVidePM"); // aller chercher l'élément messageConfMdpVide
    var mesConfMdpErrone = document.getElementById("messageConfMdpErronePM"); // aller chercher l'élément messageConfMdpErrone
    var mesNaissance = document.getElementById("messageNaissancePM"); // aller chercher l'élément messageNaissance

    

    // lors de la validation cacher les messages d'erreur
    mesPrenom.style.display = "none";
    mesNom.style.display = "none";
    mesMdpErrone.style.display = "none";
    mesConfMdpVide.style.display = "none";
    mesConfMdpErrone.style.display = "none";
    mesNaissance.style.display = "none";

    // Vérifier que le champs Prénom ne soit pas vide
    if (prenom == '') { 
        mesPrenom.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 
    
    // Vérifier que le champs Nom ne soit pas vide
    if (nom == '') { 
        mesNom.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 
    
    // validation du mot de passe
    validationMDP = verifierMotsDePassesProfil(motDePasse, repeterMDP); // appeler la fonction 
        if (validationMDP == false) { // si ça retourne false
            return false; // retourne false
        } 
    
    
    // si la date de naissance est vide
    if (naissance == '') {
        mesNaissance.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } 
}

// valider que le courriel est bien rempli
function validerCourriel(courriel) {
    let regexCourriel = /(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@[*[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+]*/;
        
    if (!regexCourriel.test(courriel)) { // si le courriel ne se conforme pas à l'expression régulière
        return false; // retourne false
    } 
}

function validerStatut(param){
    let statutMembre=document.getElementById(param).value;
    // aller chercher les éléments et les mettre dans des variables
    var mesStatut = document.getElementById("messageStatut"); 
    // lors de la validation cacher les messages d'erreur
    mesStatut.style.display = "none";
    if (statutMembre == 'A') {  
        return true;  
    } else if (statutMembre == 'I'){ 
        return true;  
    } else {
        mesStatut.style.display = "block";
        return false;  // retourne false
    }
}

// valider le mot de passe
function validerMotsDePasses(motDePasse) {
    let regexMDP =  /^[a-zA-Z0-9_-]{8,10}$/;
    if (!regexMDP.test(motDePasse)) {  // si le mot de passe ne se conforme pas à l'expression régulière
        return false;  // retourne false
    } 
    
}

function validerMotsDePassesProfil(motDePasse) {
    let regexMDP =  /^[a-zA-Z0-9_-]{8,10}$/;
    if (!motDePasse == ""){ 
        if (!regexMDP.test(motDePasse)) {  // si le mot de passe ne se conforme pas à l'expression régulière
            return false;  // retourne false
        } 
    } 
}

// valider les mots de passe identiques
function verifierMotsDePasses(psw, repPsw) {
    let motDePasse = psw; // mettre le paramètre dans la variable
    let repeterMDP = repPsw; // mettre le paramètre dans la variable
    let validation = validerMotsDePasses(motDePasse); // aller valider le mot de passe
    let mesMdpErrone = document.getElementById("messageMdpErrone"); // aller chercher l'élément messageMdpErrone
    let mesConfMdpVide = document.getElementById("messageConfMdpVide"); // aller chercher l'élément messageConfMdpVide
    let mesConfMdpErrone = document.getElementById("messageConfMdpErrone"); // aller chercher l'élément messageConfMdpErrone
        
    if (validation == false) {
        mesMdpErrone.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else if (repeterMDP == '') { // Si la confirmation du mot de passe est vide
        mesConfMdpVide.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else if (motDePasse != repeterMDP) { // Si les 2 mots de passes sont différents
        mesConfMdpErrone.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else { //sinon
        return true; // retourne true
    }
}

// valider les mots de passe identiques
function verifierMotsDePassesProfil(psw, repPsw) {
    let motDePasse = psw; // mettre le paramètre dans la variable
    let repeterMDP = repPsw; // mettre le paramètre dans la variable
    let validation = validerMotsDePassesProfil(motDePasse); // aller valider le mot de passe
    let mesMdpErrone = document.getElementById("messageMdpErronePM"); // aller chercher l'élément messageMdpErrone
    let mesConfMdpVide = document.getElementById("messageConfMdpVidePM"); // aller chercher l'élément messageConfMdpVide
    let mesConfMdpErrone = document.getElementById("messageConfMdpErronePM"); // aller chercher l'élément messageConfMdpErrone
        
    if (validation == false) {
        mesMdpErrone.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else if (repeterMDP == '' && !motDePasse =='' ) { // Si la confirmation du mot de passe est vide
        mesConfMdpVide.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else if (motDePasse != repeterMDP) { // Si les 2 mots de passes sont différents
        mesConfMdpErrone.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else { //sinon
        return true; // retourne true
    }
}





/**** Pour la connexion ****/
function validerConnexion(formulaire) {
    let courriel = formulaire.courrielMembre.value; // mettre le courriel entré dans une variable
    let motDePasse = formulaire.motDePasseMembre.value; // mettre le mot de passe entré dans une variable
    let validationMDP; // pour la validation du mot de passe
    let validationCourriel; // pour la validation du courriel

    let mesCourriel = document.getElementById("messageCourrielMembre"); // aller chercher l'élément messageCourriel
    let mesMdpErrone = document.getElementById("messageMdpMembreErrone"); // aller chercher l'élément messageMdpErrone

    // lors de la validation cacher les messages d'erreur
    mesCourriel.style.display = "none";
    mesMdpErrone.style.display = "none";
    

    if (courriel == '') { // si le courriel est vide
        mesCourriel.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else { //sinon valider le courriel
        validationCourriel = validerCourriel(courriel);
        if (validationCourriel == false) { 
            mesCourriel.style.display = "block"; // montrer le message d'erreur
            return false; // retourne false
        }
    } 
    
    // validation du mot de passe
    if (courriel!=='admin@streamtopia.com'){
        validationMDP = validerMotsDePasses(motDePasse);
        if (validationMDP == false) { 
            mesMdpErrone.style.display = "block"; // montrer le message d'erreur
            return false; // retourne false
        } 
    } else {return true;} // sinon ça retourne true
    
}

/** Modif Membres **/
function validerCourrielMembre(formulaire) {
    let courriel = formulaire.courrielM.value; // mettre le courriel entré dans une variable
    var mesCourrielM = document.getElementById("messageCourrielM"); // aller chercher l'élément messageCourrielM
    mesCourrielM.style.display = "none"; // lors de la validation cacher les messages d'erreur

    if (courriel == '') { // si le courriel est vide
        mesCourrielM.style.display = "block"; // montrer le message d'erreur
        return false; // retourne false
    } else { //sinon valider le courriel
        validationCourriel = validerCourriel(courriel); // appeler la fonction 
        if (validationCourriel == false) {  // si ça retourne false
            mesCourrielM.style.display = "block"; // montrer le message d'erreur
            return false; // retourne false
        }
    }
}






/** Toast **/
let initialiser = (message) =>{
    let textToast = document.getElementById("textToast");
    let toastElList = [].slice.call(document.querySelectorAll('.toast'))
    let toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    })
    if(message.length > 0){
        textToast.innerHTML = message;
        toastList[0].show();
    }
}



