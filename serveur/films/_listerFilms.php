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
                            <li><a href="#" data-toggle="modal" data-target="#connexion">Connexion</a></li>
                            <li><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#enregistrer">Devenir Membre</button></li>
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
                        <div><h3 style="display:inline-block;" class="mt-2 mb-3"><a href="../../public/pages/admin.php" class="dark-link">Admin</a> > Listes tous les films</h3></div>
                        <div><a href="../../public/pages/admin.php" class="btn-sm btn-warning">Revenir en arrière</a></div>
                    </div>
                    
                    <?php
                        require_once("../bdconfig/connexion.inc.php");

                        $rep='<table class="table table-striped">';
                        $rep.='<tr><th>ID</th><th>Titre</th><th>Réalisateur</th><th>Catégorie</th><th>Durée</th><th>Langue</th><th>Année</th><th>URL</th><th>Pochette</th></tr>';

                        $requeteLister="SELECT * FROM films";
                        try {
                            $listeFilms=mysqli_query($connexion,$requeteLister);
                            while($ligne=mysqli_fetch_object($listeFilms)){
                                $rep.="<tr><td>".($ligne->id)."</td><td>".($ligne->titre)."</td><td>".($ligne->realisateur)."</td><td>".($ligne->categorie)."</td><td>".($ligne->duree)."</td><td>".($ligne->langue)."</td><td>".($ligne->annee)."</td><td><a href=\"".($ligne->urlPreview)."\" class=\"dark-link\">Visualiser</a></td><td><img src=\"../../public/images/pochettes/".($ligne->pochette)."\" class=\"img-lister\"></td></tr>";
                            }
                        } catch (Exeption $e) {
                            $msg = "Problème pour lister. Veuillez réessayer plus tard.";
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