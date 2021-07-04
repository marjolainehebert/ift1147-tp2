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

<body onLoad="envoyerLister(<?php echo "'".$liste."'" ?>);">
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
                            <a href="index.php">
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

    <!-- Hero Section Begin -->
    <section class="hero-section pt-0">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="/tp2/public/images/background.jpg">
                <div class="container">
                    <div class="row justify-content-around align-middle">
                        <div class="align-middle col-8">
                            <h4 class="jaune bold caps pb-4">En vedette</h4>
                            <span>
                                Science-Fiction, Action, Aventure, Thriller<br>
                                <i class="fa fa-clock-o" aria-hidden="true"></i> 1h 49m
                            </span>
                            <h1 class="text-light">Chaos Walking</h1>
                            <p class="text-light">Dans un futur proche, les femmes ont disparu. Le monde de Todd Hewitt n’est habité que par des hommes, tous soumis au Bruit, une mystérieuse force qui révèle leurs pensées et permet à chacun de connaître celles des autres. Lorsqu’une jeune femme, Viola, atterrit en catastrophe sur cette planète, elle s’y retrouve en grand danger… </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    

    <!-- Contenus-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 pb-4 text-center"><h1 class="mt-5 mb-5">Nos films</h1></div>
        </div>
        <div class="row col-md-12">
            
            <?php
                require_once("serveur/bdconfig/connexion.inc.php");

                
                $rep='<div class="row">';
                
                $requeteLister="SELECT * FROM films ORDER BY titre";
                
                try {
                    $listeFilms=mysqli_query($connexion,$requeteLister);
                    while($ligne=mysqli_fetch_object($listeFilms)){
                        $rep.='<div class="col-lg-3 mb-5">';
                        $rep.='    <div class="card">';
                        $rep.='        <img class="card-img-top" src="/tp2/public/images/pochettes/'.($ligne->pochette).'" alt="'.($ligne->titre).'">';
                        $rep.='        <div class="montrerID">#'.($ligne->id).'</div>';
                        $rep.='        <div class="card-body">';
                        $rep.='            <h5 class="card-title"><strong>'.($ligne->titre).'</strong> ('.($ligne->annee).')</h5>';
                        $rep.='            <p class="card-text">';
                        $rep.=                 ($ligne->categorie);
                        $rep.='            </p>';
                        $rep.='            <p class="prix">';
                        $rep.=                 ($ligne->prix).' $';
                        $rep.='            </p>';
                        $rep.='            <p class="card-text">';
                        $rep.='                 <i class="fa fa-id-card-o" aria-hidden="true"></i> '.($ligne->realisateur).'<br>';
                        $rep.='                 <i class="fa fa-clock-o" aria-hidden="true"></i> '.($ligne->duree).' minutes<br>';
                        $rep.='                 Langue: '.($ligne->langue);
                        $rep.='             </p>';
                        $rep.='             <div class="block flex-wrap mb-3">';
                        $rep.='                 <button class="btn btn-outline-warning"
                                                    data-src="'.($ligne->urlPreview).'" 
                                                    data-title="'.($ligne->titre).'" 
                                                    onClick="
                                                        $(\'#lienDuFilm\').attr(\'src\', $(this).data(\'src\')); 
                                                        $(\'#titreDuFilm\').text($(this).data(\'title\')); 
                                                        $(\'#bandeAnnonceModal\').modal(\'show\');
                                                        ">
                                                    Bande Annonce
                                                </button>';
                        $rep.='             </div>';

                        $rep.='             <div class="block flex-wrap">
                                                <button class="btn btn-warning ajouterAuPanier"
                                                    data-title="'.($ligne->titre).'"  
                                                    data-lefilm="'.($ligne->id).'"
                                                    data-pochette="'.($ligne->pochette).'" 
                                                    data-prix="'.($ligne->prix).'" 
                                                    onClick="
                                                        ajoutPanier(this);
                                                        $(\'#titreDuFilmAjout\').text($(this).data(\'title\')); 
                                                        $(\'#ajout\').modal(\'show\');">
                                                    
                                                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Ajouter
                                                </button>
                                            </div>';
                        $rep.='        </div>';
                        $rep.='    </div>';
                        $rep.='</div>';
                    }
                } catch (Exeption $e) {
                    echo "Problème pour lister. SVP, veuillez réessayer plus tard.";
                } finally {
                    $rep.="</div>";
                    echo $rep;
                }
                mysqli_close($connexion);    
            ?>
            
        </div>
    </div>
    
    <!-- Contenus End -->
    
    <!-- Modals -->
    <!-- Modal preview -->
    <div class="modal fade" id="bandeAnnonceModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bande Annonce du Film <span id="titreDuFilm" class="bold"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <iframe  id="lienDuFilm" width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ajout" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout de film</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Le film <span id="titreDuFilmAjout" class="bold"></span> a été ajouté</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Ajouter d'autres films</button>
                    <a class="btn btn-warning" href="/tp2/public/pages/membre.php">voir le panier</a>
                </div>
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
                <form class="formulaires" id="enregForm" name="enregForm" action="serveur/membres/enregistrementMembre.php" method="POST" onsubmit="return validerFormEnreg(this);">
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
                    <form class="formulaires" id="connexionFrom" name="connexionFrom" action="serveur/membres/connexionMembre.php" method="POST" onsubmit="return validerConnexion(this);">
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

    <!-- Toast -->
    <div class="toast-container" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                    <div id="toastAcc" class="toast posToast" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="/tp2/public/images/streamtopia.png" width="24" height="auto" class="rounded me-2" alt="message">
                            <strong class="me-auto">Messages</strong>
                            <small class="text-muted"></small>
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
                            <img src="/tp2/public/images/streamtopia.png" alt="StreamTopia">
                            <a href="index.php">
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


        $('.ajouterAuPanier').click(function (event) {
            event.preventDefault();
            var ligne = $(this).data('ligne');
            $.ajax({
                method: "POST",
                cache: false,
                data: { ligne: ligne }
            });
        });
    </script>
    



    <!-- Js Plugins -->
    <script src="/tp2/public/utilitaires/js/jquery-3.3.1.min.js"></script>
    <script src="/tp2/public/utilitaires/js/bootstrap.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery-ui.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery.countdown.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery.nice-select.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery.zoom.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery.dd.min.js"></script>
    <script src="/tp2/public/utilitaires/js/jquery.slicknav.js"></script>
    <script src="/tp2/public/utilitaires/js/owl.carousel.min.js"></script>
    <script src="/tp2/public/utilitaires/js/main.js"></script>
</body>

</html>