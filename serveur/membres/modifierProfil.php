<!DOCTYPE php>
<html lang="fr">

<head>
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
                                if(!isset($_SESSION['courrielSess'])){
                                    echo "<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#connexion\">Connexion</a></li>";
                                    echo "<li><button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#enregistrer\">Devenir Membre</button></li>";
                                }else {
                                    echo "<li><a href=\"javascript:montrerM('afficherProfilPM');\">".$_SESSION['prenomSess']." ".$_SESSION['nomSess']."</a></li>";
                                    echo "<li><a href=\"\"><i class=\"fa fa-shopping-cart\"></i> <span id=\"nbItems\"></span></a></li>";
                                    echo "<li><a href=\"javascript:montrerM('afficherProfilPM');\">Profil</a></li>";
                                    echo "<li><a href=\"deconnexion.php\" class=\"btn btn-warning\">Déconnexion</a></li>";
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
                    header("Location:../../public/pages/membre.php?msg=$msg");
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