<html>
    <head>
	<meta charset="UTF-8">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="../utilitaires/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="../utilitaires/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../utilitaires/css/themify-icons.css" type="text/css">
        <link rel="stylesheet" href="../utilitaires/css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="../utilitaires/css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="../utilitaires/css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="../utilitaires/css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="../utilitaires/css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="../utilitaires/css/style.css" type="text/css">
        <link rel="stylesheet" href="../css/styles.css" type="text/css">
        <script src="../javascript/fonctions.js"></script>
        <script src="../javascript/panier.js"></script>
        <!-- Javascript -->
    </head>

<body>

<?php
	require_once("../bdconfig/connexion.inc.php");
	$num=$_POST['numFilm'];	
	$requete="SELECT * FROM films WHERE id=?";
	$statement=$connexion->prepare($requete);
	$statement->bind_param("i", $num);
	$statement->execute();
	$result = $statement->get_result();
	if(!$ligne = $result->fetch_object()){
		mysqli_close($connexion);
		$msg = "Le film <strong>".$num."</strong> ne se retrouve pas dans notre base de donnée. Veuillez réessayer.";
		header("Location:../../public/pages/admin.php?msg=$msg");
		exit;
	}
	$pochette=$ligne->pochette;
	if($pochette!="avatar.jpg"){
		$rmPoc='../../public/images/pochettes/'.$pochette;
		$tabFichiers = glob('pochettes/*');
		// parcourir les fichier
		foreach($tabFichiers as $fichier){
		  if(is_file($fichier) && $fichier==trim($rmPoc)) {
			// enlever le fichier
			unlink($fichier);
			break;
		  }
		}
	}
	$requete="DELETE FROM films WHERE id=?";
	$statement = $connexion->prepare($requete);
	$statement->bind_param("i", $num);
	$statement->execute();
	mysqli_close($connexion);
	$msg = "Le film <strong>".$num."</strong> a été retiré.";
	header("Location:../../public/pages/admin.php?msg=$msg");
?>



</body>