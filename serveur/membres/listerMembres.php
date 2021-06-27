<?php
    session_start();

    if(!isset($_SESSION['courrielSess'])){
        header("Location:../../public/pages/seConnecter.php");
    }
?>

<!DOCTYPE php>
<html lang="fr">

<head>
    <link rel="stylesheet" href="../../public/utilitaires/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/utilitaires/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/utilitaires/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="../../public/utilitaires/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../../public/utilitaires/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/utilitaires/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../../public/utilitaires/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/utilitaires/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/utilitaires/css/style.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/styles.css" type="text/css">
    <script src="../../public/javascript/fonctions.js"></script>
</head>

<body>


    <!-- Header Section Begin -->
    <header class="header-section">
        
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <div class="logo">
                            <img src="../../public/images/streamtopia.png" alt="StreamTopia">
                            <a href="../../index.php">
                                StreamTopia
                            </a>
                        </div>
                    </div>
                    <div class="text-right col-md-10 col-sm-12">
                        <ul class="nav-right">
                            <li><a href="../../serveur/membres/deconnexion.php" class="btn btn-warning">Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </header>
    <!-- Header End -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex  justify-content-between align-items-baseline">
                        <div><h3 style="display:inline-block;" class="mt-2 mb-3"><a href="../../public/pages/admin.php" class="dark-link">Admin</a> > Listes tous les membres</h3></div>
                        <div><a href="../../public/pages/admin.php" class="btn-sm btn-warning">Revenir en arrière</a></div>
                    </div>
                    
                    <?php
                        require_once("../bdconfig/connexion.inc.php");

                        $rep='<table class="table table-striped">';
                        $rep.='<tr><th>Prénom</th><th>Nom</th><th>Courriel</th><th>Sexe</th><th>Naissance</th><th>Role</th><th>Statut</th></tr>';

                        $reqListerMembres="SELECT * FROM membres";
                        $reqListerConnexion="SELECT * FROM connexion";
                        try {
                            $listeMembres=mysqli_query($connexion,$reqListerMembres);
                            while($ligneMembre=mysqli_fetch_object($listeMembres)){
                                $rep.="<tr><td>".($ligneMembre->prenom)."</td><td>".($ligneMembre->nom)."</td><td>".($ligneMembre->courriel)."</td><td>".($ligneMembre->sexe)."</td><td>".($ligneMembre->naissance)."</td>";

                                //parcourir le tableau connexion pour trouver la ligne 
                                $listeConnexion=mysqli_query($connexion,$reqListerConnexion);
                                while ($ligneConnexion=mysqli_fetch_object($listeConnexion)){
                                    if ($ligneMembre->courriel == $ligneConnexion->courriel) {
                                        $rep.="<td>".($ligneConnexion->role)."</td><td>".($ligneConnexion->statut)."</td>";
                                    }
                                }
                                $rep.="</tr>";
                            }
                        } catch (Exeption $e) {
                            $msg = "Problème pour lister les membres. Veuillez réessayer plus tard.";
		                    header("Location:../../public/pages/admin.php?msg=$msg");
                        } finally {
                            $rep.="</table>";
                            echo $rep;
                        }

                        mysqli_close($connexion);
                    ?>
                </div>
            </div>
        </div>
    </section>
    
</body>