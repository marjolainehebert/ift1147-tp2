<?php
    session_start();
    require_once("../bdconfig/connexion.inc.php");
    
   $courriel = $_POST['courriel'];
   $panier = json_decode($_POST['panier']);
   
   $rep="Vos locations en cours :".$courriel."<br>";
   $taille = count($panier); //taille du tableau
   $rep.="<table>
   <tr><th>Pochette</th><th>ID</th><th>Titre</th><th>Prix</th></tr>
   ";
   
   

    for ($i=0; $i < $taille; $i++){
       if($panier[$i] != null){
        $idFilm = $panier[i][0];
        $rep.="<tr>";
       
                $uneLocation = $panier[$i];
                $rep.="<td>".$uneLocation->idFilm."</td>";
                $rep.="<td>".$uneLocation->titre."</td>";
                $rep.="<td>".$uneLocation->pochette."</td>";
                $rep.="<td>".$uneLocation->prix."</td>";
            
       }else {
        //$msg = "Il n'y  a pas de locations en cours. Veuillez réessayer.";
        //header("Location:/tp2/public/pages/membre.php?msg=$msg");
       }
       $rep.="<tr>";
   }
   $rep.="</table>";
   echo $rep;
?>

