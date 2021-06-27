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
                            <li><a href="#" data-toggle="modal" data-target="#connexion">Connexion</a></li>
                            <li><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#enregistrer">Devenir Membre</button></li>
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

                    if (!$motDePasse==""){
                        $requete="UPDATE connexion SET motDePasse=? WHERE courriel=?";
                        $stmt = $connexion->prepare($requete);
                        $stmt->bind_param("s",$courriel);
                        $stmt->execute();
                    } 
                    mysqli_close($connexion);
                    echo $courriel."<br>";
                    echo $prenom."<br>";
                    echo $nom."<br>";
                    echo $sexe."<br>";
                    echo $naissance."<br>";
                    echo $motDePasse."<br>";
                    // $msg = "Le membre <strong>".$courriel."</strong> a été modifié.";
                    // header("Location:../../public/pages/admin.php?msg=$msg");
                ?>
            </div>

        </div>
    </div>
</body>