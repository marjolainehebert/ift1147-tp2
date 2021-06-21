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

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
                require_once("../bdconfig/connexion.inc.php");

                $titreFilm=$_POST['titreFilm']; 
				$realisFilm=$_POST['realisateur']; 
				$categFilm=$_POST['categFilm']; 
                $dureeFilm=$_POST['dureeFilm'];
				$langFilm=$_POST['langueFilm']; 
                $dateFilm=$_POST['dateFilm'];
				$urlPreview=$_POST['urlPreview'];
                $dossier="../../public/images/pochettes/";
                $nomPochette=sha1($titreFilm.time());
                $pochette="avatar.jpg";

                define("OUVRIRFICHIER","../donnees/films.txt"); 
                if(!$fic=fopen(OUVRIRFICHIER,"a+")) { 
                    echo "Problème pour ouvrir le fichier"; 
                    exit; 
                }

                if($_FILES['pochette']['tmp_name']!==""){ // s'il est différent de vide ça veut dire qu'on vient d'uploader un fichier
                    //télécharger l'image
                    $tmp = $_FILES['pochette']['tmp_name']; // on va récupérer le nom temporaire
                    $fichier = $_FILES['pochette']['name']; // on va récupérer le nom
                    $taille = $_FILES['pochette']['size']; // on va récupérer la taille
                    $extension=strrchr($fichier,'.'); // commence a chercher un caractère à partir de la droite, ici on cherche le point
                    @move_uploaded_file($tmp,$dossier.$nomPochette.$extension); // arrobas veut dire fait le mais ne me retourne pas de message
                    // prend le fichier tmp et met le dans dossier sous le nom pochette avec l'extension, il se trouve maintenant dans le fichier pochette
                    @unlink($tmp); // Enlever le fichier temporaire
                    $pochette = $nomPochette.$extension;
                }
                
                $requete="INSERT INTO films values(0,?,?,?,?,?,?,?,?)";
                $statement=$connexion->prepare($requete);
                $statement->bind_param("sssisiss", $titreFilm,$realisFilm,$categFilm,$dureeFilm,$langFilm,$dateFilm,$pochette,$urlPreview);
                $statement->execute();
                echo "Le film <strong>".$connexion->insert_id."</strong> a bien été enregistré.";


                mysqli_close($connexion);
            ?>

            <p><a href='../../public/pages/admin.php' class='btn btn-outline-warning mb-2 ms-5'>Retour à la page Admin</a></p>
        </div>
    </div>
</div>