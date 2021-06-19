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
                if(!$fic=fopen("../donnees/films.txt","r")){ 
                    echo "Problème pour ouvrir le fichier films.txt"; 
                    exit; 
                }

                $ligne=fgets($fic);
                $trouve=false;
                while(!feof($fic) && !$trouve){
                    $tab=explode(";",$ligne);
                    if($numFilm===$tab[0]){
                        $trouve=true;
                    }
                    else{
                        $ligne=fgets($fic);
                    }
                        
                }
                fclose($fic); 
                
                if($trouve){
                    echo "<form id=\"modifierForm\" enctype=\"multipart/form-data\" name=\"modifierForm\" action=\"modifier.php\" method=\"POST\">\n";

                    echo "<h1>Fiche du film <strong>#".$numFilm."</strong></h1>\n";
                    echo "<div class=\"mb-3\">\n";
                    echo "<label for=\"numFilm\" class=\"form-label\">ID du Film</label>\n";
                    echo "<input type=\"text\" class=\"form-control\" id=\"numFilm\" name=\"numFilm\" value='".$tab[0]."' readonly>\n";
                    echo "</div>\n";
                    echo "<div class=\"mb-3\">\n";
                    echo "<label for=\"titreFilm\" class=\"form-label\">Titre du film</label>\n";
                    echo "<input type=\"text\" class=\"form-control\" id=\"titreFilm\" name=\"titreFilm\" value='".$tab[1]."'>\n";
                    echo "</div>\n";
                    echo "<div class=\"mb-3\">\n";
                    echo "<label for=\"dureeFilm\" class=\"form-label\">Durée du film</label>\n";
                    echo "<input type=\"text\" class=\"form-control\" id=\"dureeFilm\" name=\"dureeFilm\" value='".$tab[2]."'>\n";
                    echo "</div>\n";
                    echo "<div class=\"mb-3\">\n";
                    echo "<label for=\"pochette\" class=\"form-label\">Pochette: </label>\n";
                    echo "<input type=\"file\" id=\"pochette\" name=\"pochette\"";
                    echo "</div>\n";
                    echo "<button type=\"submit\" class=\"btn btn-primary\">Soumettre</button>\n";
                    echo "</form>";
                } 
                else{
                    echo "Le film ".$numFilm." ne se trouve pas dans notre base de donnée.";
                }
                    
            ?>
        </div>
    </div>
</div>