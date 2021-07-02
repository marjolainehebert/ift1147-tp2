<?php
    session_start();

    if(!isset($_SESSION['courrielSess'])){
        header("Location:/tp2/public/pages/seConnecter.php");
    }
?>

<!DOCTYPE php>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/style.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/css/styles.css" type="text/css">
    <script src="/tp2/public/javascript/fonctions.js"></script>
    <script src="/tp2/public/javascript/panier.js"></script>
</head>

<body>


    <!-- Header Section Begin -->
    <header class="header-section">
        
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-md-2 col-sm-12">
                        <div class="logo">
                            <img src="/tp2/public/images/streamtopia.png" alt="StreamTopia">
                            <a href="/tp2/index.php">
                                StreamTopia
                            </a>
                        </div>
                    </div>
                    <div class="text-right col-md-10 col-sm-12">
                        <ul class="nav-right">
                            <?php
                                echo  "<li><a href=\"/tp2/index.php\">Accueil</a>";
                                if(!isset($_SESSION['courrielSess'])){
                                    echo "<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#connexion\">Connexion</a></li>";
                                    echo "<li><button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#enregistrer\">Devenir Membre</button></li>";
                                }else if($_SESSION['roleSess']=='A'){
                                    echo "<li><a href=\"/tp2/public/pages/admin.php\">".$_SESSION['prenomSess']." ".$_SESSION['nomSess']."</a></li>";
                                    echo "<li><a href=\"/tp2/public/pages/admin.php\">Page Admin</a></li>";
                                    echo "<li><a href=\"/tp2/serveur/membres/deconnexion.php\" class=\"btn btn-warning\">Déconnexion</a></li>";
                                }else {
                                    echo "<li><a href=\"/tp2/public/pages/membre.php\">".$_SESSION['prenomSess']." ".$_SESSION['nomSess']."</a></li>";
                                    echo "<li><a href=\"/tp2/public/pages/membre.php\"><i class=\"fa fa-shopping-cart\"></i> <span id=\"nbItems\"></span></a></li>";
                                    echo "<li><a href=\"/tp2/public/pages/membre.php\">Profil</a></li>";
                                    echo "<li><a href=\"/tp2/serveur/membres/deconnexion.php\" class=\"btn btn-warning\">Déconnexion</a></li>";
                                }
                            ?>
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
                        <div><h3 style="display:inline-block;" class="mt-2 mb-3"><a href="/tp2/public/pages/admin.php" class="dark-link">Admin</a> > Listes tous les membres</h3></div>
                        <div><a href="/tp2/public/pages/admin.php" class="btn-sm btn-warning">Revenir en arrière</a></div>
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
		                    header("Location:/tp2/public/pages/admin.php?msg=$msg");
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