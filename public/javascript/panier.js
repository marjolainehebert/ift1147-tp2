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