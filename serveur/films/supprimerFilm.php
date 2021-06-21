<html>
    <head>
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
		echo "Film ".$num." introuvable";
		mysqli_close($connexion);
		exit;
	}
	$pochette=$ligne->pochette;
	if($pochette!="avatar.jpg"){
		$rmPoc='../../public/images/pochettes/'.$pochette;
		$tabFichiers = glob('pochettes/*');
		//print_r($tabFichiers);
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
    echo "Le film ".$num." a été retiré.";
	// $msg = "Le film ".$num." a été retiré.";
	// header("Location:../../index.php?msg=$msg");
?>
<p><a href='../../public/pages/admin.php' class='btn btn-outline-warning mb-2 ms-5'>Retour à la page Admin</a></p>



</body>