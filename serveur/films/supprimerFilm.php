<?php
    $numFilm=$_POST['numFilm'];
    
    if(!$fic=fopen("../donnees/films.txt","r")) { 
        echo "Problème pour ouvrir le fichier films.txt"; 
        exit; 
    }

    if (!$ficTmp=fopen("../donnees/films.tmp","w")){
        echo "Problème pour créer le fichier films.tmp"; 
        exit; 
    }

    $ligne=fgets($fic);
    while(!feof($fic)) {
        $tab=explode(";",$ligne);
        if($numFilm!==$tab[0]) {
            fputs($ficTmp,$ligne);
        }
        else {
            if(trim($tab[3])!="avatar.jpg"){
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
        }
        $ligne=fgets($fic);
    }
    fclose($fic);
    fclose($ficTmp);
    unlink("../donnees/films.txt"); 
    rename("../donnees/films.tmp","../donnees/films.txt");
    echo "<h1 style='display:inline-block;'>Supression de film</h1>
                    <a href='../index.html' class='btn btn-outline-primary mb-2 ms-5'>Revenir en arrière</a>
                    <br><br>";
    echo "Le film <strong>".$numFilm."</strong> à été retiré.";

?>
<br><br><a href="../index.html">Revenir en arrière</a>