<?php
    session_start();
    require_once("../bdconfig/connexion.inc.php");
    
    $courriel = $_SESSION['courrielSess'];
    $prenom = $_SESSION['prenomSess'];
    
    $rep="<p>".$prenom.", voici votre historique de location</p>";
    $rep.="<table class='table table-striped'>";
    $rep.="<tr><th>Pochette</th><th>Titre</th><th>Temps restant</th><th></th></tr>";

    $reqLocations="SELECT * FROM locations ORDER BY date DESC";
    try {        
        $unJour = 60*60*24; // 60 secondes x 60 minutes x 24 = nombre de secondes dans une journée
        $troisJours = $unJour * 3;
        $listeLoca=mysqli_query($connexion,$reqLocations);
        while($ligneLoca=mysqli_fetch_object($listeLoca)){
            if ($courriel == $ligneLoca->courriel){
                $lesFilms = explode(";", $ligneLoca->panier);
                $taille = count($lesFilms); //taille du tableau
                for ($i=0; $i < $taille; $i++){
                    if($lesFilms[$i] != null){
                        $filmID = $lesFilms[$i];
                        $requete="SELECT * FROM films WHERE id=?";
                        $statement=$connexion->prepare($requete);
                        $statement->bind_param("i", $filmID);
                        $statement->execute();
                        $result = $statement->get_result();
                        $ligne = $result->fetch_object();
                        
                        $rep.="<tr>"; // nouvelle ligne
                        $rep.="<td class='align-middle'><img src='/tp2/public/images/pochettes/".($ligne->pochette)."' style='max-width:30px; height:auto;'></td>"; // afficher pochette
                        $rep.="<td class='align-middle'>".($ligne->titre)."</td>"; // afficher le titre
                        $from=strtotime($ligneLoca->date); //la date de location
                        $from = $from + $troisJours; // ajouter 3 jours
                        $today = time(); // la date d'aujourd'hui
                        $difference = $from - $today; // calculer la différence entre les 2 en secondes
                        $nbJours = floor($difference / 86400);  // (60 * 60 * 24)
                        if ($nbJours >= 1){
                            $rep.="<td class='align-middle'>Il vous reste <strong>".$nbJours."</strong> jours</td>";
                            $rep.="<td class='align-middle'><a href='#' class='btn-sm btn-warning'>Visionner</a></td>";
                        } else if ($nbJours < 1 && $nbJours >= 0){
                            $rep.="<td class='align-middle'><div class='alert alert-danger mb-0' role='alert'><strong>Dernier jour</strong></div></td>";
                            $rep.="<td class='align-middle'><a href='#' class='btn-sm btn-warning'>Visionner</a></td>";
                        } else {
                            $rep.="<td class='align-middle'><span class='gris'>Location échue</span></td>";
                            $rep.="<td class='align-middle'><a href='#' class='dark-link'>Relouer</a></td>";
                        }

                        $rep.="</tr>";
                    }
                }

            }
        }
    } catch (Exeption $e) {
        $msg = "Problème pour lister les membres. Veuillez réessayer plus tard.";
        header("Location:/tp2/public/pages/admin.php?msg=$msg");
    } finally {
        $rep.="</table>";
        echo $rep;
        mysqli_close($connexion);
    }

    
?>



