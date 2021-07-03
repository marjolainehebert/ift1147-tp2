<?php
    session_start();
    require_once("../bdconfig/connexion.inc.php");
    
   $courriel = $_SESSION['courrielSess'];
   $prenom = $_SESSION['prenomSess'];
   $panier = json_decode($_POST['panier']);
   
   

   $rep="<p>".$prenom.", voici votre historique de location</p>";
   $rep.="<table class='table table-striped'>";
   $rep.="<tr><th>Pochette</th><th>ID</th><th>Titre</th><th>Jusqu'au</th><th></th></tr>";
   $taille = count($panier); //taille du tableau
   for ($i=0; $i < $taille; $i++){
       if($panier[$i] != null){
            $uneLocation = $panier[$i];
            $rep.="<tr>";
            $rep.="<td><img src='/tp2/public/images/pochettes/".$uneLocation->pochette."' style='max-width:60px; height:auto;'></td>";
            $rep.="<td>".$uneLocation->idFilm."</td>";
            $rep.="<td>".$uneLocation->titre."</td>";

            $from=strtotime("+3 Days")."<br>";
            $today = time()."<br>";
            $jusquAu = $from."<br>"; 
            $jusquAu = $jusquAu / 86400;
            echo $time = date("Y-m-d",$jusquAu);     
            $rep.="<td>".$jusquAu."</td>";
            $difference = $from - $today;
            $nbJours = floor($difference / 86400);  // (60 * 60 * 24)
            if ($nbJours <= 3){
                $rep.="<td>Il vous reste <strong>".$nbJours."</strong> jours</td>";
                $rep.="<td><a href='#' class='btn-sm btn-warning'>Visionner</a></td>";
            } else {
                $rep.="<td>Location échue</td>";
                $rep.="<td><a href='#' class='dark-link'>Relouer</a></td>";
            }

            $rep.="</tr>";
       }
   }
   $rep.="</table>";
   echo $rep;
?>



