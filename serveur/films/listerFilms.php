<script src="../js/jquery.js"></script>
<link rel="stylesheet" href="../css/bootstrap-5.0.0-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/styles.css">
<script src="../ss/bootstrap-5.0.0-dist/js/bootstrap.min.js"></script>
<script src="../js/films.js"></script>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h1 style="display:inline-block;">Listes tous les films</h1>
        <a href="../../public/pages/admin.php" class="btn btn-outline-warning mb-2 ms-5">Revenir en arrière</a>
            <?php
                require_once("../bdconfig/connexion.inc.php");

                $rep='';
                $rep.='<table class="table table-striped">';
                $ligne=fgets($fic);
                while (!feof($fic)) {
                    $tab=explode(";",$ligne);
                    $rep.="<div class=\"card col-xs-12 col-sm-6 col-md-4 col-le-3\">
                        <img src=\"../images/pochettes/".$tab[3]."\" class=\"card-img-top\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">#".$tab[0]." ".$tab[1]."</h5>
                            <p class=\"card-text\">Durée : ".$tab[2]."</p>
                            <a href=\"#\" class=\"btn btn-info\">Louer le film</a>
                        </div>
                    </div>";
                    $ligne=fgets($fic);
                }
                $rep.="</table>";
                fclose($fic);
                echo $rep;

                
            ?>
        </div>
    </div>
</div>
