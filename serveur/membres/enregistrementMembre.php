<link rel="stylesheet" href="/tp2/public/utilitaires/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/utilitaires/css/style.css" type="text/css">
    <link rel="stylesheet" href="/tp2/public/css/styles.css" type="text/css">
    <script src="/tp2/public/javascript/fonctions.js"></script>
    <script src="/tp2/public/javascript/panier.js"></script>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
                session_start();
                require_once("../bdconfig/connexion.inc.php");
                // attribuer des valeurs aux variables
                $prenom=$_POST['prenom']; 
                $nom=$_POST['nom']; 
                $courriel=$_POST['courriel'];
                $sexe=$_POST['sexe'];
                $naissance=$_POST['naissance'];
                $motDePasse=$_POST['motDePasse'];
                $statut='A';
                $role='M';

                
                $reqMembres="SELECT * FROM membres";
                $reqConnexion="SELECT * FROM connexion";

                try { 
                    $listeMembres=mysqli_query($connexion,$reqMembres);
                    $listeConnexion=mysqli_query($connexion,$reqConnexion);

                    while($ligneMembre=mysqli_fetch_object($listeMembres)){
                        if ($ligneMembre->courriel == $courriel) {// V??rifier si le courriel se retrouve d??j?? dans la base de donn??e
                            mysqli_close($connexion);
                            $msg = "Le courriel ".$courriel.", est d??j?? utilis??. Veuillez vous connecter.";
                            header("Location:/tp2/index.php?msg=$msg");
                            exit;
                        }
                    }

                    $reqMembres="INSERT INTO membres values(?,?,?,?,?)";
                    $statMembre=$connexion->prepare($reqMembres);
                    $statMembre->bind_param("sssss", $prenom,$nom,$courriel,$sexe,$naissance);
                    $statMembre->execute();

                    $reqConnexion="INSERT INTO connexion values(?,?,?,?)";
                    $statConnex=$connexion->prepare($reqConnexion);
                    $statConnex->bind_param("ssss", $courriel,$motDePasse,$statut,$role);
                    $statConnex->execute();

                    mysqli_close($connexion);
                    $_SESSION['courrielSess']=$courriel;
                    $msg = "Bienvenue ".$prenom.", vous av??z bien ??t?? enregistr??.";
                    header("Location:/tp2/public/pages/membre.php?msg=$msg");
                    
                } catch (Exeption $e) {
                    $msg = "Probl??me pour s'enregistrer. Veuillez r??essayer plus tard.";
                    header("Location:/tp2/index.php?msg=$msg");
                    mysqli_close($connexion);
                } finally {
                    $rep.="</table>";
                    echo $rep;
                }

    
?>