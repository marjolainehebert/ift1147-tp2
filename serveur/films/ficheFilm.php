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
                <?php
                require_once("../bdconfig/connexion.inc.php");

                $num=$_POST['numFilm']; 

                function envoyerFormModifier($ligne){
                    global $num;
                    $rep = "<form id=\"modifierForm\" enctype=\"multipart/form-data\" name=\"modifierForm\" action=\"modifierFilm.php\" method=\"POST\" onsubmit=\"return validerFormEnregFilms();\">\n";

                    $rep.= "<h1>Fiche du film <strong>#".$num."</strong></h1>\n";
                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"numFilm\" class=\"form-label\">ID du Film</label>\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"numFilm\" name=\"numFilm\" value='".$ligne->id."' readonly>\n";
                    $rep.= "</div>\n";

                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"titreFilm\" class=\"form-label\">Titre du film</label>\n";
                    $rep.= "<div id=\"messageTitre\">Entrez le titre</div>\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"titreFilm\" name=\"titreFilm\" value='".$ligne->titre."'>\n";
                    $rep.= "</div>\n";

                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"realisateur\" class=\"form-label\">Réalisateur</label>\n";
                    $rep.= "<div id=\"messageRealis\">Entrez le nom du réalisateur</div>\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"realisateur\" name=\"realisateur\" value='".$ligne->realisateur."'>\n";
                    $rep.= "</div>\n";

                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"categFilm\" class=\"form-label\">Catégorie</label>\n";
                    $rep.= "<div id=\"categDuree\">Entrez la catégorie</div>\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"categFilm\" name=\"categFilm\" value='".$ligne->categorie."'>\n";
                    $rep.= "</div>\n";

                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"dureeFilm\" class=\"form-label\">Durée du film</label>\n";
                    $rep.= "\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"dureeFilm\" name=\"dureeFilm\" value='".$ligne->duree."'>\n";
                    $rep.= "</div>\n";

                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"langFilm\" class=\"form-label\">Langue</label>\n";
                    $rep.= "\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"langFilm\" name=\"langFilm\" value='".$ligne->langue."'>\n";
                    $rep.= "</div>\n";

                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"dateFilm\" class=\"form-label\">Année</label>\n";
                    $rep.= "<div id=\"messageDate\">Entrez l'année de la sortie du film</div>\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"dateFilm\" name=\"dateFilm\" value='".$ligne->annee."'>\n";
                    $rep.= "</div>\n";

                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"pochette\" class=\"form-label\">Pochette: </label>\n";
                    $rep.= "<input type=\"file\" id=\"pochette\" name=\"pochette\"\n";
                    $rep.= "</div>\n";

                    $rep.= "<div class=\"mb-3\">\n";
                    $rep.= "<label for=\"urlPreview\" class=\"form-label\">URL de l'extrait</label>\n";
                    $rep.= "<div id=\"messageUrl\">Entrez un URL valide débutant par http:// ou https://</div>\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"urlPreview\" name=\"urlPreview\" value='".$ligne->urlPreview."'>\n";
                    $rep.= "</div>\n";

                    $rep.= "<button type=\"submit\" class=\"btn btn-primary\">Soumettre</button>\n";
                    $rep.= "</form>\n";

                    return $rep;
                } 


                $requete="SELECT * FROM films WHERE id=?";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("i", $num);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$ligne = $result->fetch_object()){
                    mysqli_close($connexion);
                    $msg = "Le film <strong>".$num."</strong> ne se retrouve pas dans notre base de donnée. Veuillez réessayer.";
		            header("Location:../../public/pages/admin.php?msg=$msg");
                } else {
                    mysqli_close($connexion);
                    echo envoyerFormModifier($ligne);
                }
                

                    
            ?>
        </div>
    </div>
</div>