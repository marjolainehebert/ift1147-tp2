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
                        if ($ligneMembre->courriel == $courriel) {// Vérifier si le courriel se retrouve déjà dans la base de donnée
                            mysqli_close($connexion);
                            header("Location:../../public/pages/dejaEnregistre.php");
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
                    header("Location: ../../public/pages/enregistrementSucces.php");
                    
                } catch (Exeption $e) {
                    $msg = "Problème pour s'enregistrer. Veuillez réessayer plus tard.";
                    header("Location:../../index.php?msg=$msg");
                } finally {
                    $rep.="</table>";
                    echo $rep;
                }

    
?>