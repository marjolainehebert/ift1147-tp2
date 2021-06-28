<?php
    session_start();
   $courriel = $_SESSION['courrielSess'];
   $panier = json_decode($_POST['panier']);
   //echo "Vous avez choisi le film ".$panier[3]->idFilm;
   $rep="Panier pour le membre :".$courriel."<br>";
   $taille = count($panier); //taille du tableau
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
   echo $rep;
?>

