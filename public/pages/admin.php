<?php
    session_start();

    if(!isset($_SESSION['courrielSess'])){
        header("Location:/tp2/public/pages/seConnecter.php");
    }

    if (!($_SESSION['roleSess']=='A')){
        $msg="Connectez vous en tant qu'administrateur";
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
                    <h5><strong>Gestion films</strong></h5>
                    <div class="block flex-wrap mt-3 mb-5">
                        <button class="btn btn-outline-success mb-3" onclick="montrer('enregFilm');">Enregistrer</button>
                        <button class="btn btn-outline-warning mb-3" onclick="montrer('listerFilms')">Lister</button>
                        <button class="btn btn-outline-info mb-3" onclick="montrer('modifierFilm');">Modifier</button>
                        <?php
                            if ($_SESSION['roleSess']=='A'){
                                echo '<button class="btn btn-outline-danger mb-3" onclick="montrer(\'supprimerFilm\');">Supprimer</button>';
                            } else {
                                echo '<button class="btn btn-light mb-3" onclick="montrer(\'accesRefuse\');">Supprimer</button>';
                            }
                            
                        ?>
                        
                    </div>

                    <h5><strong>Gestion membres</strong></h5>
                    <div class="block flex-wrap mt-3 mb-5">
                        <button class="btn btn-outline-warning mb-3" onclick="envoyerListerMembres()">Lister</button>
                        <button class="btn btn-outline-info mb-3" onclick="montrer('modifierMembre');">Modifier</button>
                        
                    </div>
                </div>

                

                <div class="col-12 col-md-9 col-xl-10 bgcolor pt-2 pb-2">
                    <h2 class="text-center"><?php echo $_SESSION['prenomSess'];?></h2>
                    <h3 class="text-center mb-5 pb-4">bienvenue dans l'espace administrateur</h3>

                    <div class="" id="enregFilm">
                        <h3 class="mb-2">Enregistrer un film</h3>
                        <hr>
                        <form id="enregFilmForm" enctype="multipart/form-data" name="enregFilmForm" action="/tp2/serveur/films/enregistrerFilm.php" method="POST" onsubmit="return validerFormEnregFilms();">
                            <div class="mb-3">
                                <label for="titreFilm" class="form-label">Titre du film</label>
                                <div id="messageTitre">Entrez le titre</div>
                                <input type="text" class="form-control" id="titreFilm" name="titreFilm">
                            </div>

                            <div class="mb-3">
                                <label for="realisateur" class="form-label">Réalisateur</label>
                                <div id="messageRealis">Entrez le nom du réalisateur</div>
                                <input type="text" class="form-control" id="realisateur" name="realisateur">
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm">
                                    <label for="dureeFilm" class="form-label">Durée du film (minutes)</label>
                                    <div id="messageDuree">Entrez la durée en minutes (entre 1 et 999)</div>
                                    <input type="text" class="form-control" id="dureeFilm" name="dureeFilm">
                                </div>

                                <div class="col-sm">
                                    <label for="dateFilm" class="form-label">Année de sortie</label>
                                    <div id="messageDate">Entrez l'année de la sortie du film (supérieur à 1800)</div>
                                    <input type="text" class="form-control" id="dateFilm" name="dateFilm">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm">
                                    <label for="categFilm" class="form-label">Catégorie</label>
                                    <div id="messageCateg">Choisissez la catégorie</div>
                                    <select id="categFilm" name="categFilm" class="form-control" data-placeholder="Choisir la catégorie...">
                                        <option value="Action">Action</option>
                                        <option value="Comédie">Comédie</option>
                                        <option value="Drame">Drame</option>
                                        <option value="Science Fiction">Science Fiction</option>
                                        <option value="Suspense">Suspense</option>
                                        <option value="Thriller">Thriller</option>
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label for="langueFilm" class="form-label">Langue du film</label>
                                    <div id="messageLangue">Entrez le langue</div>
                                    <select type="text" class="form-control" id="langueFilm" name="langueFilm" data-placeholder="Choisir la langue...">
                                        <option value="FR">Français</option>
                                        <option value="EN">English</option>
                                        <option value="AF">Afrikaans</option>
                                        <option value="SQ">Albanian</option>
                                        <option value="AR">Arabic</option>
                                        <option value="HY">Armenian</option>
                                        <option value="EU">Basque</option>
                                        <option value="BN">Bengali</option>
                                        <option value="BG">Bulgarian</option>
                                        <option value="CA">Catalan</option>
                                        <option value="KM">Cambodian</option>
                                        <option value="ZH">Chinese (Mandarin)</option>
                                        <option value="HR">Croatian</option>
                                        <option value="CS">Czech</option>
                                        <option value="DA">Danish</option>
                                        <option value="NL">Dutch</option>
                                        <option value="ET">Estonian</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finnish</option>
                                        <option value="KA">Georgian</option>
                                        <option value="DE">German</option>
                                        <option value="EL">Greek</option>
                                        <option value="GU">Gujarati</option>
                                        <option value="HE">Hebrew</option>
                                        <option value="HI">Hindi</option>
                                        <option value="HU">Hungarian</option>
                                        <option value="IS">Icelandic</option>
                                        <option value="ID">Indonesian</option>
                                        <option value="GA">Irish</option>
                                        <option value="IT">Italian</option>
                                        <option value="JA">Japanese</option>
                                        <option value="JW">Javanese</option>
                                        <option value="KO">Korean</option>
                                        <option value="LA">Latin</option>
                                        <option value="LV">Latvian</option>
                                        <option value="LT">Lithuanian</option>
                                        <option value="MK">Macedonian</option>
                                        <option value="MS">Malay</option>
                                        <option value="ML">Malayalam</option>
                                        <option value="MT">Maltese</option>
                                        <option value="MI">Maori</option>
                                        <option value="MR">Marathi</option>
                                        <option value="MN">Mongolian</option>
                                        <option value="NE">Nepali</option>
                                        <option value="NO">Norwegian</option>
                                        <option value="FA">Persian</option>
                                        <option value="PL">Polish</option>
                                        <option value="PT">Portuguese</option>
                                        <option value="PA">Punjabi</option>
                                        <option value="QU">Quechua</option>
                                        <option value="RO">Romanian</option>
                                        <option value="RU">Russian</option>
                                        <option value="SM">Samoan</option>
                                        <option value="SR">Serbian</option>
                                        <option value="SK">Slovak</option>
                                        <option value="SL">Slovenian</option>
                                        <option value="ES">Spanish</option>
                                        <option value="SW">Swahili</option>
                                        <option value="SV">Swedish </option>
                                        <option value="TA">Tamil</option>
                                        <option value="TT">Tatar</option>
                                        <option value="TE">Telugu</option>
                                        <option value="TH">Thai</option>
                                        <option value="BO">Tibetan</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TR">Turkish</option>
                                        <option value="UK">Ukrainian</option>
                                        <option value="UR">Urdu</option>
                                        <option value="UZ">Uzbek</option>
                                        <option value="VI">Vietnamese</option>
                                        <option value="CY">Welsh</option>
                                        <option value="XH">Xhosa</option>
                                        </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="pochette" class="form-label">Ajouter une image de la pochette</label>
                                <input type="file" class="form-control" id="pochette" name="pochette">
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm">
                                    <label for="urlPreview" class="form-label">URL de la bande annonce</label>
                                    <div id="messageUrl">SVP entrez un URL provenant de Youtube</div>
                                    <input type="text" class="form-control" id="urlPreview" name="urlPreview">
                                </div>

                                <div class="col-sm">
                                    <label for="prix" class="form-label">Prix en dollars (CAD) </label>
                                    <div id="messagePrix">SVP entrez un montant contenant un point et 2 décimales.</div>
                                    <input type="text" class="form-control" id="prix" name="prix">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning">Soumettre</button>
                        </form>
                    </div>

                    <!-- -- Lister films -- -->
                    <div class="" id="listerFilms">
                        <h3 class="mb-2">Lister les films</h3>
                        <hr>
                        <form id="formLister" action="/tp2/serveur/films/listerFilms.php" method="POST">
                            <div class="row mb-5">
                                <div class="col-sm">
                                    <h4 class="pb-3">Tous les films</h4>
                                    <button type="submit" class="btn-sm btn-outline-warning" onsubmit="envoyerLister('','');">Lister tout</button>
                                </div>

                                <div class="col-sm">
                                    <h4 class="pb-3">Dans la catégorie</h4>
                                    <select class="form-control" onChange="envoyerLister('categ',this.options[this.selectedIndex].value)">
                                        <option value="">Choisir ...</option>
                                        <option value="Action">Action</option>
                                        <option value="Comédie">Comédie</option>
                                        <option value="Drame">Drame</option>
                                        <option value="Science Fiction">Science Fiction</option>
                                        <option value="Suspense">Suspense</option>
                                        <option value="Thriller">Thriller</option>
                                    </select>
                                </div>
                            </div>
                                
                            <div class="row mb-5">
                            
                                <div class="col-sm">
                                    <h4 class="pb-3">Recherche par titre</h4>
                                    <input class="form-control" type="search" id="rctitre" placeholder="Titre" aria-label="Recherche">
                                    <button class="btn-sm btn-outline-primary mt-3" onClick="envoyerLister('titre',document.getElementById('rctitre').value)">Recherche</button>
                                </div>

                                <div class="col-sm">
                                    <h4 class="pb-3">Les films du réalisateur</h4>
                                    <input class="form-control" type="search" id="rcres" placeholder="Réalisateur" aria-label="Recherche">
                                    <button class="btn-sm btn-outline-success mt-3" onClick="envoyerLister('realisateurs',document.getElementById('rcres').value)">Recherche</button>
                                </div>
                            </div>
                            
                            
                            <input type="hidden" id="par" name="par" value="tout">
                            <input type="hidden" id="valeurPar" name="valeurPar" value="">
                            
                        </form>
                    </div>

                    <!-- -- Modifier films -- -->
                    <div class="" id="modifierFilm">
                        <h3>Modifier un film</h3>
                        <hr>
                        <form id="modifierForm" name="modifierForm" action="/tp2/serveur/films/ficheFilm.php" method="POST">
                            <div class="mb-3">
                                <label for="numFilmM" class="form-label">ID du Film</label>
                                <div id="messageModifier">Entrez un nombre entre 1 et 9999</div>
                                <input type="text" class="form-control" id="numFilmM" name="numFilm">
                            </div>
                            <button type="submit" class="btn btn-warning">Soumettre</button>
                        </form>
                    </div>

                    <!-- -- enlever -- -->
                    <div class="" id="supprimerFilm">
                        <h3>Supprimer un film</h3>
                        <hr>
                        <form id="supprimerForm" name="supprimerForm" action="/tp2/serveur/films/supprimerFilm.php" method="POST" onsubmit="return validerNombre('numFilmS');">
                            <div class="mb-3">
                                <label for="numFilmS" class="form-label">ID du Film</label>
                                <div id="messageSupprimer">Entrez un nombre entre 1 et 9999</div>
                                <input type="text" class="form-control" id="numFilmS" name="numFilm">
                            </div>
                            <button type="submit" class="btn btn-warning">Soumettre</button>
                        </form>
                    </div>

                    <!-- -- Modifier films -- -->
                    <div class="" id="accesRefuse">
                        <h3>Supprimer un film</h3>
                        <hr>
                        <div class="alert alert-danger" role="alert">
                            <strong>REFUSÉ</strong>: Vous devez être administrateur pour supprimer un film.
                        </div>
                    </div>

                    <!-- -- Lister Membres -- -->
                    <div class="" id="listerMembres">
                        <form id="formListerMembres" action="/tp2/serveur/membres/listerMembres.php" method="POST">
                        </form>
                    </div>

                    <!-- -- Modifier membre -- -->
                    <div class="" id="modifierMembre">
                        <h3>Modifier le statut d'un membre</h3>
                        <hr>
                        <form id="modifierMembreForm" name="modifierMembreForm" action="/tp2/serveur/membres/ficheMembre.php" method="POST"  onsubmit="return validerCourrielMembre(this);">
                            <div class="mb-3">
                            <label for="courrielM"><b>Courriel</b></label><br>
                            <div id="messageCourrielM">Entrez une adresse courriel valide dans le format votrenom@domaine.com</div>
                            <input type="text" class="form-control" placeholder="Entrez votre adresse courriel" title="Entrez votre adresse courriel" name="courrielM" id="courrielM"/>
                            </div>
                            <button type="submit" class="btn btn-warning">Soumettre</button>
                        </form>
                    </div>

                </div>

                <div class="col-md-12">
                    <p class="text-right"><a href="/tp2/index.php" class="btn btn-outline-warning mt-5">Retour à la page d'accueil</a></p>
                </div>

                <!-- Toast -->
                <div class="toast-container" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                    <div id="toast" class="toast posToast" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="/tp2/public/images/streamtopia.png" width="24" height="auto" class="rounded me-2" alt="message">
                            <strong class="me-auto">Messages</strong>
                            <small class="text-muted"></small>
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