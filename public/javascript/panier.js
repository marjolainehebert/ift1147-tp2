if(localStorage.getItem("panier")==undefined){
    localStorage.setItem("panier",'[]');//panier vide
}
var panier=null;
var idFilmSelect;
let i=1;


function viderPanier(){
    storage.clear();
}

function ajoutPanier(bouton) {
    let idFilm = $(bouton).data('idFilm');
    idFilmSelect = idFilm;
    let pochette = $(bouton).data('pochette');
    let titre = $(bouton).data('title');
    let prix = $(bouton).data('prix');
    
    let film={"idFilm": idFilm,"titre":titre,"pochette":pochette,"prix":prix};
    panier=JSON.parse(localStorage.getItem("panier"));
    panier.push(film);
    localStorage.setItem("panier",JSON.stringify(panier));
}

function retirerPanier(idF) {
    panier=JSON.parse(localStorage.getItem("panier"));
    let nouveauPanier=panier.filter(unFilm=>{
        return unFilm.idFilm != idF;
    })
    if(nouveauPanier.length == panier.length){
        alert("Le film "+idF+" n'existe pas");
    }else{
        localStorage.setItem("panier",JSON.stringify(nouveauPanier));
        afficherPanier();
    }
    document.querySelector("#divRetirer").style.display='none';
}

function afficherPanier() {
    montrerM('listerLocationsPM');
    var lePanier="<div class='d-flex justify-content-between align-items-baseline'>";
    lePanier+="<h4>Contenu de votre panier</h4>";
    lePanier+="<button class='btn btn-outline-warning' onClick='viderPanier()'>abandonner</button>";
    lePanier+="<button class='btn btn-warning' onClick='payer()'>Payer</button>";
    lePanier+="</div>";
    lePanier+="<hr>";
    panier=JSON.parse(localStorage.getItem("panier"));
    nombre=0;
    let leTotal=0;

    lePanier+="<table class='table table-striped'>";
    lePanier+="<tr><th>Pochette</th><th>ID</th><th>Titre</th><th>Prix/3 jours</th><th></th></tr>";
    for( var unFilm of panier){
        lePanier+="<tr>"
        if(unFilm!==null){
            lePanier+="<td><img src='../images/pochettes/"+unFilm.pochette+"' style='max-width:60px; height:auto;'></td>";
            lePanier+="<td>"+unFilm.idFilm+"</td>";
            lePanier+="<td>"+unFilm.titre+"</td>";
            lePanier+="<td>"+unFilm.prix+" $</td>";
            lePanier+="<td><a class='dark-link' onClick='retirerPanier("+unFilm.idFilm+")'>Retirer</a></td>";
            nombre++; 
            leTotal+= parseFloat(unFilm.prix);
        } else {lePanier+="<p>Le panier est vide.</p><a href='../../index.php' class='btn btn-warning'>Ajouter des films</a>"}

        lePanier+="</tr>";
    }
    lePanier+="</table>";
    lePanier+="<hr>";
    lePanier+="<div d-flex d-flex align-items-end><div>Le total est : <strong>"+leTotal+"<strong></div>";
    document.querySelector("#votrePanier").innerHTML=lePanier;
    document.querySelector("#nbItems").innerHTML=nombre;
}

let payer = () => {
    
    envoyerPanierServeur();

}
let courriel = $_SESSION['courrielSess'];
let envoyerPanierServeur = () => {
    $.ajax({
        type:"POST",
        url:"../../serveur/locations/enregistrerLocations.php",
        data:{"courriel": courriel, "panier" : localStorage.getItem("panier")},
        dataType : "text",
        //La réponse du serveur
        success : (reponse) => {
            //alert(reponse);
            document.getElementById("panierServeur").innerHTML=reponse;
        },
        fail : () => {
            alert("Erreur: impossible d'envoyer votre commande au serveur. Veuillez réessayer plus tard.");
        }
    })
}
