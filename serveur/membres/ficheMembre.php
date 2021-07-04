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
                                    echo "<li><a href=\"/tp2/public/pages/membre.php\">".$_SESSION['prenomSess']." ".$_SESSION['nomSess']."</a></li>";
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

                    $courriel=$_POST['courrielM']; 
                    
                    echo "<div class=\"d-flex justify-content-between align-items-baseline\">
                        <div><h3 style=\"display:inline-block;\" class=\"mt-2 mb-3\"><a href=\"/tp2/public/pages/admin.php\" class=\"dark-link\">Admin</a> > Modifier membre</h3></div>
                        <div><a href=\"/tp2/public/pages/admin.php\" class=\"btn-sm btn-warning\">Revenir en arrière</a></div>
                    </div>";

                    function envoyerFormModifierMembre($ligne){
                        global $courriel;
                        $rep = "<form id=\"modifierForm\" enctype=\"multipart/form-data\" name=\"modifierForm\" action=\"modifierMembre.php\" method=\"POST\" onsubmit=\"return validerStatut('statut');\">\n";
                        $rep.= "<div class=\"mb-3\">\n";
                        
                        $rep.= "<label for=\"courrielM\" class=\"form-label\">Courriel du membre</label>\n";
                        $rep.= "<input type=\"text\" class=\"form-control\" id=\"courrielM\" name=\"courrielM\" value='".$ligne->courriel."' readonly>\n";
                        $rep.= "</div>\n";

                        $rep.= "<div class=\"mb-3\">\n";
                        $rep.= "<label for=\"statut\" class=\"form-label\">Statut du membre</label>\n";
                        $rep.= "<div id=\"messageStatut\">Entrez la lettre A en majuscule pour activer ou la lettre I en majuscule pour désactiver</div>\n";
                        $rep.= "<input type=\"text\" class=\"form-control\" id=\"statut\" name=\"statut\" value='".$ligne->statut."'>\n";
                        $rep.= "</div>\n";

                        $rep.= "<button type=\"submit\" class=\"btn btn-warning\">Soumettre</button>\n";
                        $rep.= "</form>\n";

                        return $rep;
                    } 


                    $requete="SELECT * FROM connexion WHERE courriel=?";
                    $stmt = $connexion->prepare($requete);
                    $stmt->bind_param("s", $courriel);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if(!$ligne = $result->fetch_object()){
                        mysqli_close($connexion);
                        $msg = "Le courriel <strong>".$courriel."</strong> ne se retrouve pas dans notre base de donnée. Veuillez réessayer.";
                        header("Location:/tp2/public/pages/admin.php?msg=$msg");
                    } else {
                        mysqli_close($connexion);
                        $leRole = $ligne->role;
                        switch ($leRole) {
                            case 'A': // si le role est admin, afficher role admin
                                echo "<p>Le rôle de l'utilisateur est : <strong>Administrateur</strong>\n</p>";
                                break;
                            case 'E': // si le role est employé, afficher role employé
                                echo "<p>Le rôle de l'utilisateur est : <strong>Employé</strong>\n</p>";
                                break;
                            case 'M': // si le role est membre, afficher role membre
                                echo "<p>Le rôle de l'utilisateur est : <strong>Membre</strong>\n</p>";
                                break;
                            default: // pour tous les autres cas, faire un message d'erreur
                                echo "ERREUR: Le rôle n'est pas défini";
                        }
                        echo envoyerFormModifierMembre($ligne);
                    }
                        
                ?>
            </div>
        </div>
    </div>
</section>

</body>