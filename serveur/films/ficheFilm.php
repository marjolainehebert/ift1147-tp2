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
                    
                <?php
                require_once("../bdconfig/connexion.inc.php");

                $num=$_POST['numFilm']; 

                echo "<div class=\"d-flex justify-content-between align-items-baseline\">
                        <div><h3 style=\"display:inline-block;\" class=\"mt-2 mb-3\"><a href=\"/tp2/public/pages/admin.php\" class=\"dark-link\">Admin</a> > Modifier le film <strong>#".$num."</strong></h3></div>
                        <div><a href=\"/tp2/public/pages/admin.php\" class=\"btn btn-outline-warning\">Revenir en arrière</a></div>
                    </div>";

                function envoyerFormModifier($ligne){
                    global $num;
                    $rep = "<form id=\"modifierForm\" enctype=\"multipart/form-data\" name=\"modifierForm\" action=\"/tp2/serveur/films/modifierFilm.php\" method=\"POST\" onsubmit=\"return validerFormEnregFilms();\">\n";

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

                    $rep.= "<div class=\"row mb-3\">\n";
                    $rep.= "<div class=\"mb-3 pb-5 col-sm\">\n";
                    $rep.= "<label for=\"urlPreview\" class=\"form-label\">URL de l'extrait</label>\n";
                    $rep.= "<div id=\"messageUrl\">Entrez un URL valide débutant par http:// ou https://</div>\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"urlPreview\" name=\"urlPreview\" value='".$ligne->urlPreview."'>\n";
                    $rep.= "</div>\n";
                    $rep.= "<div class=\"mb-3 pb-5 col-sm\">\n";
                    $rep.= "<label for=\"prix\" class=\"form-label\">Prix en dollars canadiens</label>\n";
                    $rep.= "<div id=\"messagePrix\">entrez un nombre avec 2 décimales</div>\n";
                    $rep.= "<input type=\"text\" class=\"form-control\" id=\"prix\" name=\"prix\" value='".$ligne->prix."'>\n";
                    $rep.= "</div>\n";
                    $rep.= "</div>\n";

                    $rep.= "<button type=\"submit\" class=\"btn btn-warning\">Soumettre</button>\n";
                    $rep.= "</form>\n";

                    return $rep;
                } 


                $requete="SELECT * FROM films WHERE id=?";
                $stmt=$connexion->prepare($requete);
                $stmt->bind_param("i", $num);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$ligne = $result->fetch_object()){
                    mysqli_close($connexion);
                    $msg = "Le film <strong>".$num."</strong> ne se retrouve pas dans notre base de donnée. Veuillez réessayer.";
		            header("Location:/tp2/public/pages/admin.php?msg=$msg");
                } else {
                    mysqli_close($connexion);
                    echo envoyerFormModifier($ligne);
                }
                

                    
            ?>
            </div>
        </div>
    </div>
</section>

</body>