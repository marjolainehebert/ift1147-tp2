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
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <h1 style="display:inline-block;" class="mt-2 mb-3">Listes tous les films</h1>
            <a href="../../public/pages/admin.php" class="btn btn-outline-warning mb-3 ps-5">Revenir en arrière</a>
                <?php
                    require_once("../bdconfig/connexion.inc.php");

                    $rep='<table class="table table-striped">';
                    $rep.='<tr><th>ID</th><th>Titre</th><th>Réalisateur</th><th>Catégorie</th><th>Durée</th><th>Langue</th><th>date</th><th>URL</th><th>Pochette</th></tr>';

                    $requeteLister="SELECT * FROM films";
                    try {
                        $listeFilms=mysqli_query($connexion,$requeteLister);
                        while($ligne=mysqli_fetch_object($listeFilms)){
                            $rep.="<tr><td>".($ligne->id)."</td><td>".($ligne->titre)."</td><td>".($ligne->realisateur)."</td><td>".($ligne->categorie)."</td><td>".($ligne->duree)."</td><td>".($ligne->langue)."</td><td>".($ligne->date)."</td><td><a href=\"".($ligne->urlPreview)."\">Visualiser</a></td><td><img src=\"../../public/images/pochettes/".($ligne->pochette)."\" class=\"img-lister\"></td></tr>";
                        }
                    } catch (Exeption $e) {
                        echo "Problème pour lister. SVP, veuillez réessayer plus tard.";
                    } finally {
                        $rep.="</table>";
                        echo $rep;
                    }

                    mysqli_close($connexion);

                    
                ?>
            </div>
        </div>
    </div>
</body>