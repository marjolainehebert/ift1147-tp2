if(localStorage.getItem("panier")==undefined){
    localStorage.setItem("panier",'[]');//panier vide
}
var panier=null;
let i=1;

/***************** fonctions panier **********************/
function ajouterPanier(id,titre,courriel){
    let film={"id": i,"titre":"Le film "+(i++),"courriel":120};
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
    var lePanier="<h3>Contenu de votre panier</h3></br>";
    panier=JSON.parse(localStorage.getItem("panier"));
    for( var unFilm of panier){
        if(unFilm!==null){
            lePanier+="</br>Id film = "+unFilm.idFilm;
            lePanier+="</br>Titre = "+unFilm.titre;
            lePanier+="</br>Durée = "+unFilm.duree;
            lePanier+="</br>*******************";
        }
    }
    document.querySelector("#votrePanier").innerHTML=lePanier;
}

let payer = () => {
    alert("Cool c'est payé");
    envoyerPanierServeur();

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