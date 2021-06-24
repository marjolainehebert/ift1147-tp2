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
                    $statut=$_POST['statut'];

                    $reqMembres="SELECT * FROM membres";
                    $listeMembres=mysqli_query($connexion,$reqMembres);

                    $requete="UPDATE connexion SET statut=? WHERE courriel=?";
                    $stmt = $connexion->prepare($requete);
                    $stmt->bind_param("ss",$statut,$courriel);
                    $stmt->execute();
                    mysqli_close($connexion);
                    $msg = "Le membre <strong>".$courriel."</strong> a été modifié.";
                    header("Location:../../public/pages/admin.php?msg=$msg");
                ?>
            </div>
            <p><a href='../../public/pages/admin.php' class='btn btn-outline-warning mb-2 ms-5'>Retour à la page Admin</a></p>

        </div>
    </div>
</body>