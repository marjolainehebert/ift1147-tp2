<?php
    session_start();
   $courriel = $_POST['courriel'];
   $panier = json_decode($_POST['panier']);
   //echo "Vous avez choisi le film ".$panier[3]->idFilm;
   $rep="Vos locations en cours :".$courriel."<br>";
   $taille = count($panier); //taille du tableau
   $rep.="<table>
   <tr><th>Pochette</th><th>ID</th><th>Titre</th><th>Prix</th></tr>
   ";
   for ($i=0; $i < $taille; $i++){
       if($panier[$i] != null){
            $rep.="<tr>";
            $uneLocation = $panier[$i];
            $rep.="<td>".$uneLocation->idFilm."</td>";
            $rep.="<td>".$uneLocation->titre."</td>";
            $rep.="<td>".$uneLocation->pochette."</td>";
            $rep.="<td>".$uneLocation->prix."</td>";
            $rep.="<tr>";
       }else {
           $rep.="<tr><td>Il n'y  a pas de locations en cours</td></tr>";
       }
   }
   $rep.="</table>";
   echo $rep;
?>

