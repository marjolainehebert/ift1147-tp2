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
                                    echo "<li><a href=\"/tp2/serveur/membres/deconnexion.php\" class=\"btn btn-warning\">D??connexion</a></li>";
                                }else {
                                    echo "<li><a href=\"/tp2/public/pages/membre.php\">".$_SESSION['prenomSess']." ".$_SESSION['nomSess']."</a></li>";
                                    echo "<li><a href=\"/tp2/public/pages/membre.php\"><i class=\"fa fa-shopping-cart\"></i> <span id=\"nbItems\"></span></a></li>";
                                    echo "<li><a href=\"/tp2/public/pages/membre.php\">Profil</a></li>";
                                    echo "<li><a href=\"/tp2/serveur/membres/deconnexion.php\" class=\"btn btn-warning\">D??connexion</a></li>";
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
                        $categories=[];
                        $categories["Action"]="Action";
                        $categories["Com??die"]="Com??die";
                        $categories["Drame"]="Drame";
                        $categories["Science Fiction"]="Science Fiction";
                        $categories["Suspense"]="Suspense";
                        $categories["Thriller"]="Thriller";
                        try{
                            $par=$_POST['par'];
                            $valeurPar=strtolower(trim($_POST['valeurPar']));
                            switch($par){
                                case "tout" : 
                                    $requeteSort="SELECT * FROM films WHERE 1=?";
                                    $valeurPar=1;
                                    $nomFiltre="Lister tous les films";
                                break;
                                case "realisateurs" :
                                    $requeteSort="SELECT * FROM films WHERE LOWER(realisateur) LIKE CONCAT('%', ?, '%')";
                                    $nomFiltre="Lister les films du r??alisateur ".$valeurPar;
                                break;
                                case "categ" :
                                    $requeteSort="SELECT * FROM films WHERE categorie=?";
                                    $nomFiltre="Lister les films de la cat??gorie ".$valeurPar;
                                break;
                                case "titre" :
                                    $requeteSort="SELECT * FROM films WHERE LOWER(titre) LIKE CONCAT('%', ?, '%')";
                                    $nomFiltre="Lister les films contenant le titre ".$valeurPar;
                                break;
                            }

                            echo '
                            <div class="d-flex  justify-content-between align-items-baseline mb-5 pb-5">
                                <div><h3 style="display:inline-block;" class="mt-2 mb-3"><a href="/tp2/public/pages/admin.php" class="dark-link">Admin</a> > '.$nomFiltre.'</h3></div>
                                <div><a href="/tp2/public/pages/admin.php" class="btn btn-outline-warning">Revenir en arri??re</a></div>
                            </div>
                            ';
                            
                            $stmt = $connexion->prepare($requeteSort);
                            $stmt->bind_param("s", $valeurPar);
                            $stmt->execute();
                            $listeFilms = $stmt->get_result();
                            
                                
                                $rep="<div class='container'>";
                                $i=0;
                                
                                $rep.=' <div class="row">';
                                while($ligne=mysqli_fetch_object($listeFilms)){
                                    //$categ = $categories[$ligne->categ];
                                    
                                    $rep.='<div class="col-lg-3 mb-5">';
                                    $rep.='    <div class="card">';
                                    $rep.='        <img class="card-img-top" src="/tp2/public/images/pochettes/'.($ligne->pochette).'" alt="'.($ligne->titre).'">';
                                    $rep.='        <div class="montrerID">#'.($ligne->id).'</div>';
                                    $rep.='        <div class="card-body">';
                                    $rep.='            <h5><strong>'.($ligne->titre).'</strong> ('.($ligne->annee).')</h5>';
                                    $rep.='            <p class="bold">';
                                    $rep.=                 $ligne->categorie;
                                    $rep.='            </p>';
                                    $rep.='            <p class="">';
                                    $rep.='                 Prix: <strong>'.($ligne->prix).' $</strong><br>';
                                    $rep.='                 R??alisateur: <br><strong>'.($ligne->realisateur).'</strong><br>';
                                    $rep.='                 Dur??e: <strong>'.($ligne->duree).' minutes</strong> <br>';
                                    $rep.='                 Langue:<strong> '.($ligne->langue).'</strong><br>';
                                    $rep.='                 URL de la bande annonce: <br><a href="'.($ligne->urlPreview).'" class="dark-link"><strong>'.($ligne->urlPreview).'</strong></a>';
                                    $rep.='            </p>';
                                    $rep.='        </div>';
                                    $rep.='    </div>';
                                    $rep.='</div>';
                                }

                                    $rep.="</div>";//fermer le dernier row
                                $rep.="</div>";//fermer le container
                                mysqli_free_result($listeFilms);
                            }catch (Exception $e){
                                    $rep.='<div class="col-sm">';
                                        $rep.='<div class="card" style="width: 18rem;">';
                                                $rep.='<div class="card-body">';
                                                    $rep.='<h5 class="card-title">Erreur</h5>';
                                                    $rep.='<p class="card-text">Probl??me pour lister les films</p>';
                                                $rep.='</div>';
                                        $rep.='</div>';
                                    $rep.='</div>';
                            }finally {
                                mysqli_close($connexion);
                                echo $rep;
                                //header("Location:/tp2/index.php?liste=$rep");
                            }
                ?>
                </div>
            </div>
        </div>
    </section>
    
</body>