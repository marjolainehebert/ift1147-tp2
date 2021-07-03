
if(localStorage.getItem("panier")==undefined){
    localStorage.setItem("panier",'[]');//panier vide
}

var panier=null;
let i=1;
function ajoutPanier(bouton) {
    let pochette = $(bouton).data('pochette');
    let leFilm = $(bouton).data('lefilm');
    let titre = $(bouton).data('title');
    let prix = $(bouton).data('prix');
    let film={"idFilm": leFilm,"titre":titre,"pochette":pochette,"prix":prix,"increment":i++};
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
    var lePanier=" ";
    nombre=0;
    let leTotal=0;
    panier=JSON.parse(localStorage.getItem("panier"));
    if (!panier==[]){
        lePanier+="<table class='table table-striped'>";
        lePanier+="<tr><th>Pochette</th><th>ID</th><th>Titre</th><th>Prix/3 jours</th><th></th></tr>";
        for( var unFilm of panier){
            if(unFilm!==null){
                lePanier+="<tr>";
                lePanier+="<td><img src='/tp2/public/images/pochettes/"+unFilm.pochette+"' style='max-width:60px; height:auto;'></td>";
                lePanier+="<td>"+unFilm.idFilm+"</td>";
                lePanier+="<td>"+unFilm.titre+"</td>";
                lePanier+="<td>"+unFilm.prix+" $</td>";
                lePanier+="<td><a class='dark-link' onClick='retirerPanier("+unFilm.idFilm+")'>Retirer</a></td>";
                
                lePanier+="</tr>";
                nombre++; 
                leTotal+= parseFloat(unFilm.prix);
            }
        }
        lePanier+='</table>'; 
        lePanier+="<hr>";
        lePanier+="<div class='d-flex justify-content-end  align-items-center'>";
        lePanier+="<h4 class='mx-3'>Le total est : <strong>"+leTotal+"$<strong></h4>"; 
        lePanier+="<button class='btn btn-warning ms-2' onClick='payer()'>Payer</button>";
        lePanier+="</div>";
    } else {lePanier+="Le panier est vide";}
    document.querySelector("#votrePanier").innerHTML=lePanier;
    document.querySelector("#nbItems").innerHTML=nombre;
}

function confirmSubmit(){
    var agree=confirm("Voulez-vous vraiment vider votre panier?");
    if (agree){
        viderPanier();
        return true ;
    }
    else {
        return false ;
    }
}

function viderPanier(){
    localStorage.clear();
    afficherPanier();
}

let payer = () => {
    alert("Paiement reçu. Merci.");
    envoyerPanierServeur();
    viderPanier();
}
let courriel = "abc@abc.com";
let envoyerPanierServeur = () => {
    $.ajax({
        type:"POST",
        url:"/tp2/serveur/locations/enregistrerLocations.php",
        data:{"courriel": courriel, "panier" : localStorage.getItem("panier")},
        dataType : "text",
        //La réponse du serveur
        success : (reponse) => {
            //alert(reponse);
            document.getElementById("panierServeur").innerHTML=reponse;
        },
        fail : () => {
            alert("Erreur de connexion au serveur. Veuillez réessayer plus tard.");
        }
    })
}