<?php
    session_start();

    if(!isset($_SESSION['courrielSess'])){
        header("Location:../../public/pages/seConnecter.php");
    }
?>

<!DOCTYPE php>
<html lang="fr">

<head>
    <meta charset="UTF-8">
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
    <script src="../../public/javascript/panier.js"></script>
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

                    $courriel=$_SESSION['courrielSess']; 
                    
                    echo "<div class=\"d-flex justify-content-between align-items-baseline\">
                        <div><h3 style=\"display:inline-block;\" class=\"mt-2 mb-3\"><a href=\"../../public/pages/membre.php\" class=\"dark-link\">Espace membre</a> > Modifier le profil de ".$_SESSION['prenomSess']." ".$_SESSION['nomSess']."</h3></div>
                        <div><a href=\"../../public/pages/membre.php\" class=\"btn-sm btn-warning\">Revenir en arrière</a></div>
                    </div>";

                    function envoyerFormModifierMembre($ligne){
                        global $courriel;
                        $rep = "<form id=\"modifierForm\" enctype=\"multipart/form-data\" name=\"modifierForm\" action=\"modifierProfil.php\" method=\"POST\" onsubmit=\"return validerProfil(this);\">\n";
                        $rep.= "<div class=\"mb-3\">\n";
                        
                        $rep.= "    <label for=\"courrielM\" class=\"form-label pt-4 mb-0\">Adresse courriel <span class='note'>(Ne peut être modifier que par l'administrateur)</span></label>\n";
                        $rep.= "    <input type=\"text\" class=\"form-control\" id=\"courrielM\" name=\"courrielM\" value='".$ligne->courriel."' readonly>\n";

                        $rep.= "    <label for=\"prenom\" class=\"form-label pt-4 mb-0\">Prénom</label><br>\n";
                        $rep.= "    <div id=\"messagePrenomPM\">Entrez votre prénom</div>\n";
                        $rep.= "    <input type=\"text\" class=\"form-control\" placeholder=\"Enter votre prénom\" title=\"Enter votre prénom\" name=\"prenom\" id=\"prenom\" value='".$ligne->prenom."'/>\n";
                        
                        $rep.= "    <label for=\"nom\" class=\"form-label pt-4 mb-0\">Nom</label><br>\n";
                        $rep.= "    <div id=\"messageNomPM\">Entrez votre nom</div>\n";
                        $rep.= "    <input type=\"text\" class=\"form-control\" placeholder=\"Enter votre nom\" title=\"Enter votre nom\" name=\"nom\" id=\"nom\" value='".$ligne->nom."'/>\n";
                        
                        $rep.= "    <label for=\"motDePasse\" class=\"form-label pt-4 mb-0\">Mot de passe <span class='note'>(laissez le champs vide si vous ne souhaitez pas changer le mot de passe)</span></label>\n";
                        $rep.= "    <div id=\"messageMdpVidePM\">Entrez un mot de passe</div>\n";
                        $rep.= "    <div id=\"messageMdpErronePM\">Le mot de passe doit contenir entre 8 et 10 caractères. Les caractères acceptés sont les lettres minuscules et majuscules, les chiffres, les tirets et les caractères de soulignement.</div>\n";
                        $rep.= "    <input type=\"password\" class=\"form-control\" placeholder=\"Entrez le nouveau mot de passe\" title=\"Entrez le nouveau mot de passe\" name=\"motDePasse\" id=\"motDePasse\"  />\n";
                        
                        $rep.= "    <label for=\"repeterMDP\" class=\"form-label pt-4 mb-0\">Répétez le mot de passe</label><br>\n";
                        $rep.= "    <div id=\"messageConfMdpVidePM\">Entrez la confirmation du mot de passe</div>\n";
                        $rep.= "    <div id=\"messageConfMdpErronePM\">Les mots de passe entrés sont différents, veuillez réessayer</div>\n";
                        $rep.= "    <input type=\"password\" class=\"form-control\" placeholder=\"Répétez le mot de passe\" title=\"Répétez le mot de passe\" name=\"repeterMDP\" id=\"repeterMDP\" />\n";

                        $rep.= "    <div class=\"col-50 bordureForm\" >\n";
                        $rep.= "       <div>\n";
                        $rep.= "           <label for=\"sexe\" class=\"form-label pt-4 mb-0\">Sexe*:</label><br>\n";
                        $rep.= "           <p class=\"genre\">\n";
                        $rep.= "              <input class=\"radio\" type=\"radio\" name=\"sexe\" id=\"sexeFeminin\" value=\"feminin\" ";
                                                    if($ligne->sexe=='feminin') { 
                                                        $rep.= ' checked="checked"'; 
                                                    } 
                                                    $rep.= "/>\n";
                        $rep.= "               <label for=\"sexeFeminin\">Féminin</label>\n";
                        $rep.= "          </p>\n";
                        $rep.= "           <p class=\"genre\">\n";
                        $rep.= "               <input class=\"radio\" type=\"radio\" name=\"sexe\" id=\"sexeMasculin\" value=\"masculin\" ";
                                                    if($ligne->sexe=='masculin') { 
                                                        $rep.= ' checked="checked"'; 
                                                    } 
                                                    $rep.= "/>\n";
                        $rep.= "             <label for=\"sexeMasculin\">Masculin</label>\n";
                        $rep.= "         </p>\n";
                        $rep.= "      </div>\n";

                        $rep.= "     <div>\n";
                        $rep.= "         <label for=\"naissance\" class=\"form-label pt-4 mb-0\">Date de naissance:</label>\n";
                        $rep.= "          <div id=\"messageNaissancePM\">Entrez votre date de naissance</div>\n";
                        $rep.= "         <input type=\"date\" class=\"form-control\" name=\"naissance\" id=\"naissance\" value='".$ligne->naissance."'/>\n";
                        $rep.= "       </div>\n";
                        $rep.= "    </div>\n";
                        $rep.= "</div>\n";

                        $rep.= "<button type=\"submit\" class=\"btn btn-warning\">Soumettre</button>\n";
                        $rep.= "</form>\n";

                        return $rep;
                    } 

                    try {

                        $requete="SELECT * FROM membres WHERE courriel=?";
                        $stmt = $connexion->prepare($requete);
                        $stmt->bind_param("s", $courriel);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if(!$ligne = $result->fetch_object()){
                            mysqli_close($connexion);
                            $msg = "Le courriel <strong>".$courriel."</strong> ne se retrouve pas dans notre base de donnée. Veuillez réessayer.";
                            header("Location:../../public/pages/membre.php?msg=$msg");
                        } else {
                            mysqli_close($connexion);
                            echo envoyerFormModifierMembre($ligne);
                        }
                    } catch (Exeption $e) {
                        echo "Problème pour lister. SVP, veuillez réessayer plus tard.";
                    } finally {
                        mysqli_close($connexion);
                    }
                    
                        
                ?>
            </div>
        </div>
    </div>
</section>

</body>