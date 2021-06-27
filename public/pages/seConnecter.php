<?php
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
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StreamTopia</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../utilitaires/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../utilitaires/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../utilitaires/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="../utilitaires/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../utilitaires/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../utilitaires/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../utilitaires/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../utilitaires/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../utilitaires/css/style.css" type="text/css">
    <link rel="stylesheet" href="../css/styles.css" type="text/css">
    <script src="../javascript/fonctions.js"></script>
    <!-- Javascript -->

</head>

<body onLoad="initialiser(<?php echo "'".$msg."'" ?>);">
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
                            <img src="../images/streamtopia.png" alt="StreamTopia">
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
    

    <!-- Contenus-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 pb-4 text-center">
                <h1 class="mt-5 mb-5">Se connecter</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5 col-sm-12">
                <form class="formulaires" id="connexionFromMembre" name="connexionFrom" action="../../serveur/membres/connexionMembre.php" method="POST" onsubmit="return validerConnexion(this);">
                    <label for="courrielMembre"><b>Courriel</b></label><br>
                    <div id="messageCourrielMembre">Entrez une adresse courriel valide dans le format votrenom@domaine.com</div>
                    <input type="text" placeholder="Entrez votre adresse courriel" name="courrielMembre" id="courrielMembre" />
        
                    <label for="motDePasseMembre"><b>Mot de passe</b></label><br>
                    <div id="messageMdpMembreVide">Entrez un mot de passe</div>
                    <div id="messageMdpMembreErrone">Le mot de passe doit contenir entre 8 et 10 caractères. Les caractères acceptés sont les lettres minuscules et majuscules, les chiffres, les tirets et les caractères de soulignement.</div>
                    <input type="password" placeholder="Entrez le mot de passe" name="motDePasseMembre" id="motDePasseMembre">
                    
                    <div class="modal-footer px-0">
                        <a href="../../index.php" class="btn btn-light">Annuler</a>
                        <button type="submit" class="btn btn-warning">Se connecter</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    
    <!-- Contenus End -->

    <!-- Toast -->
    <div class="toast-container" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <div id="toastAcc" class="toast posToast" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="../images/streamtopia.png" width="24" height="auto" class="rounded me-2" alt="message">
                <strong class="me-auto">Messages</strong>
                <small class="text-muted"></small>
                <button type="button" class="btn-close btn-sm btn-warning" data-bs-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="textToast" class="toast-body">
                
            </div>
        </div>
    </div>



    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-left">
                        
                        <div class="logo">
                            <img src="../images/streamtopia.png" alt="StreamTopia">
                            <a href="../../index.php">
                                StreamTopia
                            </a>
                        </div>
                        <ul>
                            <li>1234 rue Nom de la rue, Montréal, Qc H1H 1H1</li>
                            <li>Téléphone: 1 (800) 555-1234</li>
                            <li>Courriel: support@StreamTopia.com</li>
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
    <script src="../utilitaires/js/jquery-3.3.1.min.js"></script>
    <script src="../utilitaires/js/bootstrap.min.js"></script>
    <script src="../utilitaires/js/jquery-ui.min.js"></script>
    <script src="../utilitaires/js/jquery.countdown.min.js"></script>
    <script src="../utilitaires/js/jquery.nice-select.min.js"></script>
    <script src="../utilitaires/js/jquery.zoom.min.js"></script>
    <script src="../utilitaires/js/jquery.dd.min.js"></script>
    <script src="../utilitaires/js/jquery.slicknav.js"></script>
    <script src="../utilitaires/js/owl.carousel.min.js"></script>
    <script src="../utilitaires/js/main.js"></script>
</body>

</html>