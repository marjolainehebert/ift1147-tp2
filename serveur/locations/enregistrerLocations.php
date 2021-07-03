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
                $courriel = $_SESSION['courrielSess'];
                $panier = json_decode($_POST['panier']);

                
                $requete="SELECT * FROM locationEtPaiements";

                try { 
                    $liste=mysqli_query($connexion,$requete);

                    $requete="INSERT INTO locationEtPaiements values(?,?)";
                    $stmt=$connexion->prepare($requete);
                    $stmt->bind_param("ss", $courriel,$panier);
                    $stmt->execute();

                    mysqli_close($connexion);
                    $msg = "Votre commande a bien été enregistrée.";
                    header("Location:/tp2/public/pages/membre.php?msg=$msg");
                    
                } catch (Exeption $e) {
                    $msg = "Problème pour se connecter. Veuillez réessayer plus tard.";
                    header("Location:/tp2/public/pages/membre.php?msg=$msg");
                    mysqli_close($connexion);
                } finally {
                    $rep.="</table>";
                    echo $rep;
                }

    
?>