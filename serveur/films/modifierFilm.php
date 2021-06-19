<script src="../js/jquery.js"></script>
<link rel="stylesheet" href="../css/bootstrap-5.0.0-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/styles.css">
<script src="c../ss/bootstrap-5.0.0-dist/js/bootstrap.min.js"></script>
<script src="../js/films.js"></script>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
                $numFilm=$_POST['numFilm'];
                $titreFilm=$_POST['titreFilm'];
                $dureeFilm=$_POST['dureeFilm'];
                $dossier="../images/pochettes/";
                if(!$fic=fopen("../donnees/films.txt","r")) { 
                    echo "Problème pour ouvrir le fichier films.txt"; 
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