<!DOCTYPE php>
<html lang="fr">
<meta charset="UTF-8">

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
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php
                    require_once("../bdconfig/connexion.inc.php");
                    $num=$_POST['numFilm']; 
                    $titre=$_POST['titreFilm'];
                    $realis=$_POST['realisateur'];
                    $categ=$_POST['categFilm'];
                    $duree=$_POST['dureeFilm'];
                    $langue=$_POST['langFilm'];
                    $annee=$_POST['dateFilm'];
                    $urlPreview=$_POST['urlPreview'];
                    $prix=$_POST['prix'];
                    $dossier="../../public/images/pochettes/";

                    $requete="SELECT pochette FROM films WHERE id=?";
                    $stmt = $connexion->prepare($requete);
                    $stmt->bind_param("i", $num);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $ligne = $result->fetch_object();
                    $pochette=$ligne->pochette;
                    
                    
                    if($_FILES['pochette']['tmp_name']!==""){
                        //enlever ancienne pochette
                        if($pochette!="avatar.jpg"){
                            $rmPoc='../../public/images/pochettes/'.$pochette;
                            $tabFichiers = glob('../../public/images/pochettes/*');
                            // parcourir les fichier
                            foreach($tabFichiers as $fichier){
                              if(is_file($fichier) && $fichier==trim($rmPoc)) {
                                // enlever le fichier
                                echo $rmPoc;
                                unlink($fichier);
                                break;
                              }
                            }
                        }
                        $nomPochette=sha1($titre.time());
                        //Upload de la photo
                        $tmp = $_FILES['pochette']['tmp_name'];
                        $fichier= $_FILES['pochette']['name'];
                        $extension=strrchr($fichier,'.');
                        $pochette=$nomPochette.$extension;
                        @move_uploaded_file($tmp,$dossier.$nomPochette.$extension);
                        // Enlever le fichier temporaire charg??
                        @unlink($tmp); //effacer le fichier temporaire
                    }

                    $requete="UPDATE films SET titre=?,realisateur=?,categorie=?,duree=?,langue=?,annee=?,pochette=?,urlPreview=?,prix=? WHERE id=?";
                    $stmt = $connexion->prepare($requete);
                    $stmt->bind_param("sssisisssi",$titre,$realis,$categ,$duree,$langue,$annee,$pochette,$urlPreview,$prix,$num);
                    $stmt->execute();
                    mysqli_close($connexion);
                    $msg = "Le film <strong>".$num."</strong> a ??t?? modifi??.";
                    header("Location:/tp2/public/pages/admin.php?msg=$msg");
                ?>
            </div>

        </div>
    </div>
</body>