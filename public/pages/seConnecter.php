<?php
   session_start();

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
    <script src="../javascript/panier.js"></script>
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
            </div>
            <div id="textToast" class="toast-body">
                
            </div>
        </div>
    </div>

<!-- modal s'enregistrer -->
<div class="modal fade" id="enregistrer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enregistrement Membre</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="formulaires" id="enregForm" name="enregForm" action="../../serveur/membres/enregistrementMembre.php" method="POST" onsubmit="return validerFormEnreg(this);">
                    <label for="prenom"><b>Prénom</b></label><br>
                    <div id="messagePrenom">Entrez votre prénom</div>
                    <input type="text" placeholder="Enter votre prénom" title="Enter votre prénom" name="prenom" id="prenom" />
                    
                    <label for="nom"><b>Nom</b></label><br>
                    <div id="messageNom">Entrez votre nom</div>
                    <input type="text" placeholder="Enter votre nom" title="Enter votre nom" name="nom" id="nom" />
                    
                    <label for="email"><b>Courriel</b></label><br>
                    <div id="messageCourriel">Entrez une adresse courriel valide dans le format votrenom@domaine.com</div>
                    <input type="text" placeholder="Entrez votre adresse courriel" title="Entrez votre adresse courriel" name="courriel" id="courriel"/>
                    
                    <label for="motDePasse"><b>Mot de passe</b></label>
                    <div id="messageMdpVide">Entrez un mot de passe</div>
                    <div id="messageMdpErrone">Le mot de passe doit contenir entre 8 et 10 caractères. Les caractères acceptés sont les lettres minuscules et majuscules, les chiffres, les tirets et les caractères de soulignement.</div>
                    <input type="password" placeholder="Entrez le mot de passe" title="Entrez le mot de passe" name="motDePasse" id="motDePasse" />
                    
                    <label for="repeterMDP"><b>Répétez le mot de passe</b></label><br>
                    <div id="messageConfMdpVide">Entrez la confirmation du mot de passe</div>
                    <div id="messageConfMdpErrone">Les mots de passe entrés sont différents, veuillez réessayer</div>
                    <input type="password" placeholder="Répétez le mot de passe" title="Répétez le mot de passe" name="repeterMDP" id="repeterMDP" />

                    <div class="col-50 bordureForm" >
                        <div>
                            <label for="sexe"><strong>Sexe*:</strong></label><br>
                            <p class="genre">
                                <input class="radio" type="radio" name="sexe" id="sexeFeminin" value="feminin" checked required/>
                                <label for="sexeFeminin">Féminin</label>
                            </p>
                            <p class="genre">
                                <input class="radio" type="radio" name="sexe" id="sexeMasculin" value="masculin"> 
                                <label for="sexeMasculin">Masculin</label>
                            </p>
                        </div>

                        <div>
                            <label for="naissance"><strong>Date de naissance*:</strong></label>
                            <div id="messageNaissance">Entrez votre date de naissance</div>
                            <input type="date" name="naissance" id="naissance"/>
                        </div>
                    </div>
                    <div class="pb-1"><small>* Pour des fins statistique uniquement.</small></div>

                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-warning">S'enregistrer</button>
                    </div>
                </form>
                <div id="messageErreur"></div>
                Vous avez déjà un compte? <a href="#" class="dark-link" onclick="connexionModal();">Cliquez-ici</a> pour vous connecter.
                
            </div>
        </div>
        </div>
    </div>

    <!-- modal connexion -->
    <div class="modal fade" id="connexion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form class="formulaires" id="connexionFrom" name="connexionFrom" action="../../serveur/membres/connexionMembre.php" method="POST" onsubmit="return validerConnexion(this);">
                        <label for="courrielMembre"><b>Courriel</b></label><br>
                        <div id="messageCourrielMembre">Entrez une adresse courriel valide dans le format votrenom@domaine.com</div>
                        <input type="text" placeholder="Entrez votre adresse courriel" name="courrielMembre" id="courrielMembre" />
                        
                        <label for="motDePasseMembre"><b>Mot de passe</b></label><br>
                        <div id="messageMdpMembreVide">Entrez un mot de passe</div>
                        <div id="messageMdpMembreErrone">Le mot de passe doit contenir entre 8 et 10 caractères. Les caractères acceptés sont les lettres minuscules et majuscules, les chiffres, les tirets et les caractères de soulignement.</div>
                        <input type="password" placeholder="Entrez le mot de passe" name="motDePasseMembre" id="motDePasseMembre">
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-warning">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    Vous n'avez pas un compte? <a href="#" class="dark-link" onclick="enregistrementModal();">Cliquez-ici</a> pour vous enregistrer.

                </div>
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