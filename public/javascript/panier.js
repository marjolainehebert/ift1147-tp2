if(localStorage.getItem("panier")==undefined){
    localStorage.setItem("panier",'[]');//panier vide
}
var panier=null;
let i=1;




function ajoutPanier(bouton) {
    // alert('patatepoil');
    // alert ($(bouton).data('title'));
    let id = $(bouton).data('idFilm');
    let pochette = $(bouton).data('pochette');
    let titre = $(bouton).data('title');
    let prix = $(bouton).data('prix');
    
    let film={"idFilm": idFilm,"titre":titre,"pochette":pochette,"prix":prix};
    alert (film);
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
    lePanier+="<button class='btn btn-warning' onClick='payer()'>Payer</button>";
    lePanier+="</div>";
    panier=JSON.parse(localStorage.getItem("panier"));
    nombre=0;

    lePanier+="<table class='table table-striped'>";
    lePanier+="<tr><th>ID</th><th>Pochette</th><th>Titre</th><th>Nombre de jours</th><th>Prix</th><th>Retirer</th></tr>";
    for( var unFilm of panier){
        lePanier+="<tr>"
        if(unFilm!==null){
            lePanier+="<td><img src='"+unFilm.pochette+"' style='max-width:60px; height:auto;'></td>";
            lePanier+="<td>"+unFilm.id+"</td>";
            lePanier+="<td>"+unFilm.titre+"</td>";
            lePanier+="<td><input type='text' id='nombreJours' name='nombreJours'></td>";
            lePanier+="<td>"+unFilm.prix+"</td>";
            lePanier+="<td><button class='btn btn-warning' onClick='retirerPanier("+unFilm.id+")'>Retirer</button></td>";
            nombre++;
        } else {lePanier+="<p>Le panier est vide.</p><a href='../../index.php' class='btn btn-warning'>Ajouter des films</a>"}

        lePanier+="</tr>";
    }
    document.querySelector("#votrePanier").innerHTML=lePanier;
    document.querySelector("#nbItems").innerHTML=nombre;
}

let payer = () => {
    montrerM('genererFacturePM')
    envoyerPanierServeur();

}
let courriel = $_SESSION['courrielSess'];
let envoyerPanierServeur = () => {
    $.ajax({
        type:"POST",
        url:"../../serveur/locations/panierMembre.php",
        data:{"courriel": courriel, "panier" : localStorage.getItem("panier")},
        dataType : "text",
        //La réponse du serveur
        success : (reponse) => {
            //alert(reponse);
            document.getElementById("panierServeur").innerHTML=reponse;
        },
        fail : () => {
            alert("Grave Erreur");
        }
    })
}



function ajouterNombre(){
    $nbItems=$_SESSION['panierTaille'];
    $nbItems=$nbItems++;
    alert ($nbItems);
}

function retirerNombre(){
    $nbItems=$_SESSION['panierTaille'];
    $nbItems=$nbItems--;
    alert ($nbItems);
}