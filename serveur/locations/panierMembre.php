<?php
    session_start();
   $courriel = $_POST['courriel'];
   $panier = json_decode($_POST['panier']);
   //echo "Vous avez choisi le film ".$panier[3]->idFilm;
   $rep="Vos locations en cours :".$courriel."<br>";
   $taille = count($panier); //taille du tableau
   $rep.="<table>";
   for ($i=0; $i < $taille; $i++){
       if($panier[$i] != null){
            $uneLocation = $panier[$i];
            $rep.="<br>ID = ".$uneLocation->idFilm;
            $rep.="<br>TITRE = ".$uneLocation->titre;
            $rep.="<br>DURÉE = ".$uneLocation->pochette;
            $rep.="<br>DURÉE = ".$uneLocation->prix;
            $rep.="<br>********************************";
       }
   }
   $rep.="</table>";
   echo $rep;
?>

