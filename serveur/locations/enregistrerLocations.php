<?php
                session_start();
                require_once("../bdconfig/connexion.inc.php");

                // attribuer des valeurs aux variables
                $courriel = $_SESSION['courrielSess'];
                $prenom = $_SESSION['prenomSess'];
                $dateLocation = date('Y-m-d');
                $panier = json_decode($_POST['panier']);
                $idsPanier="";
                $taille = count($panier); //taille du tableau
                
                try { 
                    if (!$panier==NULL){
                        for ($i=0; $i < $taille; $i++){
                            if($panier[$i] != null){
                                $uneLocation = $panier[$i];
                                $idsPanier.= $uneLocation->idFilm.";";
                            }
                        }
                        $requete="INSERT INTO locations values(?,?,?)";
                        $stmt=$connexion->prepare($requete);
                        $stmt->bind_param("sss", $courriel,$dateLocation,$idsPanier);
                        $stmt->execute();
                        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>";
                        echo "<h4 class='text-center'>".$prenom.", nous avons reçu votre paiement. Merci.</h4>";
                        echo "<h5 class='text-center'>Votre commande a bien été enregistrée.</h5>";
                        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                        echo "<span aria-hidden='true'>&times;</span>";
                        echo "</button>";
                        echo "</div>";
                    } else echo "Votre panier est vide. Aucun film n'a été enregistré.";
                    
                } catch (Exeption $e) {
                    $msg = "Problème pour se connecter. Veuillez réessayer plus tard.";
                    header("Location:/tp2/public/pages/membre.php?msg=$msg");
                } finally {
                    mysqli_close($connexion);
                }

    
?>