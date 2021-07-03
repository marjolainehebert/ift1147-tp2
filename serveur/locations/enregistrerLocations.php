<?php
                session_start();
                require_once("../bdconfig/connexion.inc.php");
                // attribuer des valeurs aux variables
                $courriel = $_SESSION['courrielSess'];
                $dateLocation = date('Y-m-d');
                $panier = json_decode($_POST['panier']);

                try { 
                    if (!panier==[]){
                        $requete="INSERT INTO locations values(?,?,?)";
                        $stmt=$connexion->prepare($requete);
                        $stmt->bind_param("sss", $courriel,$dateLocation,$panier);
                        $stmt->execute();
                        echo "Votre commande a bien été enregistrée.";
                    } else {
                        echo "votre panier est vide.";
                    }
                    
                    // $msg = "Votre commande a bien été enregistrée.";
                    // header("Location:/tp2/public/pages/membre.php?msg=$msg");
                    
                } catch (Exeption $e) {
                    $msg = "Problème pour se connecter. Veuillez réessayer plus tard.";
                    header("Location:/tp2/public/pages/membre.php?msg=$msg");
                } finally {
                    mysqli_close($connexion);
                }

    
?>