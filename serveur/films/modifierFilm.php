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
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php
                    require_once("../bdconfig/connexion.inc.php");

                    $numFilm=$_POST['numFilm'];
                    $requeteModif="SELECT * FROM films WHERE id=?";
                    $statementModif = $connexion->prepare($requeteModif);
                    $statementModif->bind_param("i", $numFilm);
                    $statementModif->execute();
                    $resultat = $statementModif->get_result();

                    if(!$ligne = $resultat->fetch_object()) { 
                        echo "Le film <strong>#".$numFilm."</strong> ne se trouve pas dans la base de donnée"; 
                        exit; 
                    }

                    if (!$ficTmp=fopen("../donnees/films.tmp","w")){
                        echo "Problème pour créer le fichier films.tmp"; 
                        exit; 
                    }

                    $ligne=fgets($fic);
                    $trouve=false;

                    while(!feof($fic)){
                        $tab=explode(";",$ligne);
                        if($numFilm!==$tab[0]) {
                            fputs($ficTmp,$ligne);
                        }
                        else{
                            if($_FILES['pochette']['tmp_name']!==""){ //si l'utilisateur a envoyé une nouvelle pochette
                                // enlever l'ancienne
                                if($tab[3]!="avatar.jpg"){
                                    $rmPoc='../images/pochettes/'.$tab[3];
                                    $tabFichiers = glob('../images/pochettes/*');
                                    //print_r($tabFichiers); // sert à afficher une table php

                                    // parcourir le fichier
                                    foreach($tabFichiers as $fichier) {
                                        if(is_file($fichier) && $fichier == trim($rmPoc)) { // trim nettoie le nom en enlevant les espaces et les \n :O OMG
                                            //enlève le fichier
                                            unlink($fichier);
                                            break;
                                        }
                                    }
                                }

                                $nomPochette=sha1($titreFilm.time());
                                //upload de la photo
                                $tmp = $_FILES['pochette']['tmp_name'];
                                $fichier = $_FILES['pochette']['name'];
                                $extension=strrchr($fichier,'.'); 
                                @move_uploaded_file($tmp,$dossier.$nomPochette.$extension); // arrobas veut dire fait le mais ne me retourne pas de message
                                // prend le fichier tmp et met le dans dossier sous le nom pochette avec l'extension, il se trouve maintenant dans le fichier pochette
                                @unlink($tmp); // Enlever le fichier temporaire
                                $pochette = $nomPochette.$extension;
                                $nouvelleLigne=$numFilm.";".$titreFilm.";".$dureeFilm.";".$pochette."\n";
                            }
                            else {
                                
                                $nouvelleLigne=$numFilm.";".$titreFilm.";".$dureeFilm.";".trim($tab[3]).";"."\n";
                            }
                            fputs($ficTmp,$nouvelleLigne);
                            $trouve=true;
                        }
                        $ligne=fgets($fic);
                    }
                    echo "<h1 style='display:inline-block;'>Modification de film</h1>
                        <a href='../index.html' class='btn btn-outline-primary mb-2 ms-5'>Revenir en arrière</a>
                        <br><br>";
                    if($trouve){
                        echo "Le film <strong>#".$numFilm." - ".$titreFilm."</strong> a été modifié";
                        fclose($fic);
                        fclose($ficTmp);
                        unlink("../donnees/films.txt");
                        rename("../donnees/films.tmp","../donnees/films.txt");
                    }
                    else{
                        echo "Le film ".$numFilm." ne se trouve pas dans notre base de donnée.";
                    }
                ;?>
            </div>
        </div>
    </div>
</body>