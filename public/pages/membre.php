<?php
    session_start();

    if(!isset($_SESSION['courrielSess'])){
        header("Location:/tp2/public/pages/seConnecter.php");
    }

    if (isset($_GET['msg'])){
	    $msg=$_GET['msg'];
    }
    else {
	   $msg="";
    }
    if (isset($_GET['liste'])){
	$liste= $_GET['liste'];
    }
    else {
	   $liste="";
    }

?>

<!DOCTYPE php>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
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
        <!-- Javascript -->
    </head>

<body onLoad="initialiser(<?php echo "'".$msg."'" ?>); afficherPanier(); listerPanier();">
<!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

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
        <div class="container my-5">
            <div class="row">
                <div class="col-12 col-md-3 col-xl-2 ">

                    <h5><strong>Gestion locations</strong></h5>
                    <div class="block flex-wrap mt-3 mb-5">
                        <a class="btn btn-outline-info mb-3" href="/tp2/index.php">Ajouter des films</a>
                        <button class="btn btn-outline-success mb-3" onclick="afficherPanier() listerPanier()">Panier</button>
                        <button class="btn btn-outline-warning mb-3" onClick="payer();">Payer</button>
                        <button class="btn btn-outline-danger mb-3" onClick="return confirmSubmit();">Vider Panier</button>
                    </div>

                    <h5><strong>Votre profil</strong></h5>
                    <div class="block flex-wrap mt-3 mb-5">
                        <button class="btn btn-outline-info mb-3" onclick="montrerM('afficherProfilPM');">Afficher</button>
                        <a class="btn btn-outline-success mb-3" href="/tp2/serveur/membres/ficheProfil.php">Modifier</a>
                    </div>
                </div>

                

                <div class="col-12 col-md-9 col-xl-10 bgcolor pt-2 pb-2">
                    <h2 class="text-center"><?php echo $_SESSION['prenomSess'];?></h2>
                    <h3 class="text-center mb-5 pb-4">Bienvenue dans votre espace membre</h3>

                    <!-- -- Lister Locations -- -->
                    <div id="listerLocationsPM">
                        <div>
                            <h4 class="pb-5">Contenu de votre panier</h4>
                            <span id="votrePanier"></span>
                        </div>
                        
                        <div>
                            <hr>
                            <h4 class="pb-5">Vos locations en cours</h4>
                            <div id="panierServeur"></div>
                        </div>

                    </div>

                    <!-- -- Lister Locations -- -->
                    <div id="afficherProfilPM">
                        <h4>Votre profil</h4>
                        <hr>
                        <?php
                            $profil='<table class="table table-striped">';
                            $profil.='<tr><th>Prénom</th><th>Nom</th><th>Courriel</th><th>Sexe</th><th>Naissance</th></tr>';
                            $profil.='<tr>';
                            $profil.='<td>'.$_SESSION['prenomSess'].'</td>';
                            $profil.='<td>'.$_SESSION['nomSess'].'</td>';
                            $profil.='<td>'.$_SESSION['courrielSess'].'</td>';
                            $profil.='<td>'.$_SESSION['sexeSess'].'</td>';
                            $profil.='<td>'.$_SESSION['naissanceSess'].'</td>';
                            $profil.='</tr>';
                            $profil.='</table>';

                            echo $profil;
                        ?>
                    </div>



                    <!-- -- Lister Locations -- -->
                    <div id="genererFacturePM">
                        <h4>Facture</h4>
                        <hr>
                        <p>Votre facture est payée. Merci!</p>
                    </div>

                    

                </div>

                <div class="col-md-12">
                    <p class="text-right"><a href="/tp2/index.php" class="btn btn-warning mt-5">Retour à la page d'accueil</a></p>
                </div>

                <!-- Toast -->
                <div class="toast-container" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                    <div id="toast" class="toast posToast" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="/tp2/public/images/streamtopia.png" width="24" height="auto" class="rounded me-2" alt="message">
                            <strong class="me-auto">Messages</strong>
                        </div>
                        <div id="textToast" class="toast-body">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-left">
                        
                        <div class="logo">
                            <img src="/tp2/public/images/streamtopia.png" alt="StreamTopia">
                            <a href="/tp2/index.php">
                                StreamTopia
                            </a>
                        </div>
                        <ul>
                            <li>1234 rue Nom de la rue, Montréal, Qc H1H 1H1</li>
                            <li>Téléphone: 1 (800) 555-1234</li>
                            <li>Courriel: hello.colorlib@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">À propos</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Scripts -->
    <script>
        // on the footer of redirect page
        if (window.location.hash == "#openm") {
            $("#myModal").modal("show");
        }
    </script>
    



    <!-- Js Plugins -->
    <script src="/tp2/public/utilitaires/js/jquery-3.3.1.min.js"></script>
    <script src="/tp2/public/utilitaires/js/bootstrap.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery-ui.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery.countdown.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery.nice-select.min.js"></script>
    <!-- <script src="/tp2/public/utilitaires/js/jquery.zoom.min.js"></script> -->
    <script src="/tp2/public/utilitaires/js/jquery.dd.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery.slicknav.js"></script>
    <script src="/tp2/public/utilitaires/js/owl.carousel.min.js"></script>
    <script src="/tp2/public/utilitaires/js/main.js"></script>

	</body>
</html>