<script src="../js/jquery.js"></script>
<link rel="stylesheet" href="../css/bootstrap-5.0.0-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/styles.css">
<script src="c../ss/bootstrap-5.0.0-dist/js/bootstrap.min.js"></script>
<script src="../js/films.js"></script>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
                $titreFilm=$_POST['titreFilm']; 
				$realisFilm=$_POST['realisateur']; 
				$categFilm=$_POST['categFilm']; 
                $dureeFilm=$_POST['dureeFilm'];
				$langFilm=$_POST['langueFilm']; 
                $dateFilm=$_POST['dateFilm'];
				$url=$_POST['urlPreview'];
                $dossier="../images/pochettes/";
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

                $ligne=$titreFilm.";".$realisFilm.";".$categFilm.";".$dureeFilm.";".$langFilm.";".$dateFilm.";".$pochette.";".$url.";"."\n";
                fputs($fic,$ligne);
                fclose($fic);
                echo "<h1 style='display:inline-block;'>Enregistrement de film</h1>
                    <a href='../index.html' class='btn btn-outline-primary mb-2 ms-5'>Revenir en arrière</a>
                    <br><br>";
                echo "Le film <strong>".$titreFilm."</strong> a bien été enregistré.";
            ?>
        </div>
    </div>
</div>