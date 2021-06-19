<?php
    define("CONNEXION","donnees/connexion.txt"); 

    // vérification si on peut ouvrir le fichier
    if(!$connex=fopen(CONNEXION,"r")) { 
        echo "Problème pour ouvrir le fichier connexion.txt"; 
        exit; 
    }
    
    $courriel=$_POST['courrielMembre'];
    $motDePasse=$_POST['motDePasseMembre'];
    
    $ligne=fgets($connex);
    $trouverCourriel=false;
    
    // tant que ce n'est pas la fin du fichier et que le courriel n'est pas trouvé, recherche du courriel
    while (!feof($connex) && !$trouverCourriel) {
        $tab=explode(";",$ligne);
        if ($tab[0] === $courriel) {
            $leRole=$tab[3];
            $trouverCourriel=true;
        }
        else {
            $ligne=fgets($connex);
        }
    }

    fclose($connex);
    
    if($trouverCourriel){ // si on trouve le courriel
        if ($motDePasse === $tab[1]) { //vérifier que le mot de passe est le même
            switch ($leRole) {
                case 'A': // si le role est admin, envoyer vers la page admin
                    header("Location: ../public/pages/admin.php");
                    break;
                case 'E': // si le role est employé, envoyer vers la page employé
                    header("Location: ../public/pages/employe.php");
                    break;
                case 'M': // si le role est membre, envoyer vers la page membre
                    header("Location: ../public/pages/membre.php");
                    break;
                default: // pour tous les autres cas, faire un message d'erreur
                    echo "ERREUR: Le rôle n'est pas défini";
            }
        } else { // sinon envoyer à la page d"erreur de connexion
            header("Location: ../public/pages/errConnexion.php");
            exit;
        }
        
    }
    else { // sinon envoyer vers la page de courriel non trouvé
        header("Location: ../public/pages/nonTrouve.php");
        exit;
    }
    
?>