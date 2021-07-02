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
                    $courriel=$_POST['courrielM']; 
                    $prenom=$_POST['prenom'];
                    $nom=$_POST['nom'];
                    $sexe=$_POST['sexe'];
                    $naissance=$_POST['naissance'];

                    $motDePasse=$_POST['motDePasse'];

                    $reqMembres="SELECT * FROM membres";
                    $listeMembres=mysqli_query($connexion,$reqMembres);
                try{
                    if (!$motDePasse==""){
                        $requete="UPDATE connexion SET motDePasse=? WHERE courriel=?";
                        $stmt = $connexion->prepare($requete);
                        $stmt->bind_param("ss",$motDePasse,$courriel);
                        $stmt->execute();
                    } 
                    $requeteM="UPDATE membres SET prenom=?,nom=?,sexe=?,naissance=?  WHERE courriel=?";
                    $stmtM = $connexion->prepare($requeteM);
                    $stmtM->bind_param("sssss",$prenom,$nom,$sexe,$naissance,$courriel);
                    $stmtM->execute();
                    $msg = "<strong>".$prenom."</strong>, votre profil a été modifié.";
                    header("Location:/tp2/public/pages/membre.php?msg=$msg");
                } catch (Exeption $e) {
                    echo "Problème pour modifier. SVP, veuillez réessayer plus tard.";
                } finally {
                    mysqli_close($connexion);   
                }
            
                    
                ?>
            </div>

        </div>
    </div>
</body>