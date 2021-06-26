<?php
    session_start();
    require_once("../bdconfig/connexion.inc.php");
    
    $courrielMembre=$_POST['courrielMembre'];
    $motDePasseMembre=$_POST['motDePasseMembre'];
    
    try{
        $requete="SELECT * FROM connexion WHERE courriel=? AND motDePasse=?";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("ss", $courrielMembre,$motDePasseMembre);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if(!$ligne = $result->fetch_object()){ //si le courriel et le mot de passe ne se retrouve pas dans la BD
            mysqli_close($connexion);
            $msg = "Le courriel ou le mot de passe est erroné, veuillez réessayer.";
            header("Location:../../public/pages/seConnecter.php?msg=$msg");
        } 
        else {
            mysqli_close($connexion);
            //ajouter les variables aux données de session
            $_SESSION['courrielSess']=$courrielMembre;
            $leRole=($ligne->role);
            echo $leRole;
            switch ($leRole) {
                case 'A': // si le role est admin, envoyer vers la page admin
                    header("Location: ../../public/pages/admin.php");
                    break;
                case 'E': // si le role est employé, envoyer vers la page employé
                    header("Location: ../../public/pages/admin.php");
                    break;
                case 'M': // si le role est membre, envoyer vers la page membre
                    header("Location: ../../public/pages/membre.php");
                    break;
                default: // pour tous les autres cas, faire un message d'erreur
                    echo "<";
                    $msg = '<div class="alert alert-danger" role="alert">
                        ERREUR: Le rôle n\'est pas défini. Veuillez réessayer.
                    </div>';
                    header("Location:../../public/pages/seConnecter.php?msg=$msg");
                    break;
            }
        }
    }catch (Exception $e){
        $msg='<h5>Erreur</h5>';
        $msg.='<p>Rpoblème de connexion. Veuillez réessayer plus tard.</p>';
        header("Location:../../public/pages/index.php?msg=$msg");
    }finally {
        mysqli_close($connexion);
    }


    
?>