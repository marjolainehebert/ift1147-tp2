
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
    var lePanier="</br>";
    nombre=0;
    let leTotal=0;
    panier=JSON.parse(localStorage.getItem("panier"));
    if (!panier==[]){
        lePanier+="<table class='table table-striped'>";
        lePanier+="<tr><th>Pochette</th><th>ID</th><th>Titre</th><th>Prix/3 jours</th><th></th></tr>";
        for( var unFilm of panier){
            if(unFilm!==null){
                // lePanier+="</br>Id film = "+unFilm.idFilm;
                // lePanier+="</br>Titre = "+unFilm.titre;
                // lePanier+="</br>Durée = "+unFilm.pochette;
                // lePanier+="</br>Durée = "+unFilm.prix;
                // lePanier+="</br>*******************";
                // nombre++
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
    // var lePanier="<p>Votre panier est vide</p></br>";
    // document.querySelector("#votrePanier").innerHTML=lePanier;
    afficherPanier()
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
        url:"gestionLocations.php",
        data:{"courriel": courriel, "panier" : localStorage.getItem("panier")},
        dataType : "text",
        //La réponse du seerveur
        success : (reponse) => {
            //alert(reponse);
            document.getElementById("panierServeur").innerHTML=reponse;
        },
        fail : () => {
            alert("Grave Erreur");
        }
    })
}