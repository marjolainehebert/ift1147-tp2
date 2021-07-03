<?php
    session_start();
    require_once("../bdconfig/connexion.inc.php");
    
   $courriel = $_SESSION['courrielSess'];
   $panier = json_decode($_POST['panier']);
   
   $rep ="<h4>".$_SESSION['prenomSess'].", vos locations en cours :</h4>";
   $rep.="<hr>";
   $rep.="<h5 class='pb-3'>Paiement reçu. Merci!</h5>";
   $taille = count($panier); //taille du tableau
   $rep.="<table class='table table-striped'>
   <tr><th>Pochette</th><th>ID</th><th>Titre</th><th>Prix</th></tr>
   ";
   
   

    for ($i=0; $i < $taille; $i++){
       if($panier[$i] != null){
        $rep.="<tr>";
       
                $uneLocation = $panier[$i];
                $rep.="<td><img src='/tp2/public/images/pochettes/".$uneLocation->pochette."' style='max-width:60px; height:auto;'></td>";
                $rep.="<td>".$uneLocation->id."</td>";
                $rep.="<td>".$uneLocation->titre."</td>";
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

