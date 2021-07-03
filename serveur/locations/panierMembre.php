<?php
    session_start();
    require_once("../bdconfig/connexion.inc.php");
    
   $courriel = $_SESSION['courrielSess'];
   $prenom = $_SESSION['prenomSess'];
   $panier = json_decode($_POST['panier']);
   
   

   $rep="<p>".$prenom.", voici votre historique de location</p>";
   $rep.="<table class='table table-striped'>";
   $rep.="<tr><th>Pochette</th><th>ID</th><th>Titre</th><th>Temps restant</th><th></th></tr>";
   $taille = count($panier); //taille du tableau
//    for ($i=0; $i < $taille; $i++){
//        if($panier[$i] != null){
//             $uneLocation = $panier[$i];
//             $rep.="<tr>";
//             $rep.="<td><img src='/tp2/public/images/pochettes/".$uneLocation->pochette."' style='max-width:60px; height:auto;'></td>";
//             $rep.="<td>".$uneLocation->idFilm."</td>";
//             $rep.="<td>".$uneLocation->titre."</td>";

//             $from=strtotime("+3 Days")."<br>";
//             $today = time()."<br>";
//             $difference = $from - $today;
//             $nbJours = floor($difference / 86400);  // (60 * 60 * 24)
//             if ($nbJours <= 3){
//                 $rep.="<td>Il vous reste <strong>".$nbJours."</strong> jours</td>";
//                 $rep.="<td><a href='#' class='btn-sm btn-warning'>Visionner</a></td>";
//             } else {
//                 $rep.="<td>Location échue</td>";
//                 $rep.="<td><a href='#' class='dark-link'>Relouer</a></td>";
//             }

//             $rep.="</tr>";
//        }
//    }

$reqFilm="SELECT * FROM films";
$reqLocations="SELECT * FROM locations";
try {
    $listeLoca=mysqli_query($connexion,$reqLocations);
    while($ligneLoca=mysqli_fetch_object($listeLoca)){
        if ($courriel == $ligneLoca->courriel){
            $rep.="<tr><td>".($ligneLoca->courriel)."</td><td>".($ligneLoca->date)."</td><td>".($ligneLoca->panier)."</td>";
        }
        

        //parcourir le tableau connexion pour trouver la ligne 
        // $listeConnexion=mysqli_query($connexion,$reqListerConnexion);
        // while ($ligneConnexion=mysqli_fetch_object($listeConnexion)){
        //     if ($ligneLoca->courriel == $ligneConnexion->courriel) {
        //         $rep.="<td>".($ligneConnexion->role)."</td><td>".($ligneConnexion->statut)."</td>";
        //     }
        // }
        $rep.="</tr>";
    }
} catch (Exeption $e) {
    $msg = "Problème pour lister les membres. Veuillez réessayer plus tard.";
    header("Location:/tp2/public/pages/admin.php?msg=$msg");
} finally {
    $rep.="</table>";
    echo $rep;
}

mysqli_close($connexion);
?>



