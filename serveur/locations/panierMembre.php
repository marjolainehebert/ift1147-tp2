<?php
    session_start();
    require_once("../bdconfig/connexion.inc.php");
    
   $courriel = $_SESSION['courrielSess'];
   $prenom = $_SESSION['prenomSess'];
   $panier = json_decode($_POST['panier']);
   //echo "Vous avez choisi le film ".$panier[3]->idFilm;
   $rep=$prenom.", voici votre historique de location<br>";
   $taille = count($panier); //taille du tableau
   for ($i=0; $i < $taille; $i++){
       if($panier[$i] != null){
            $uneLocation = $panier[$i];
            $rep.="<br>ID = ".$uneLocation->idFilm;
            $rep.="<br>TITRE = ".$uneLocation->titre;
            $rep.="<br>DURÉE = ".$uneLocation->duree;
            $rep.="<br>********************************";
       }
   }
   echo $rep;
?>



