<?php

    

// attribuer des valeurs aux variables
    $prenom=$_POST['prenom']; 
    $nom=$_POST['nom']; 
    $courriel=$_POST['courriel'];
    $sexe=$_POST['sexe'];
    $naissance=$_POST['naissance'];
    $motDePasse=$_POST['motDePasse'];
    $statut='A';
    $role='M';

    // Vérifier si le courriel se retrouve déjà dans la base de donnée
    while (!feof($connex) && !$trouverCourriel) {
        $tab=explode(";",$ligne);
        if ($tab[0] === $courriel) {
            $trouverCourriel=true;
        }
        else {
            $ligne=fgets($connex);
        }
    }

    if ($trouverCourriel){ // si on trouve le courriel
        // redirection vers la page erreur
        header("Location: ../public/pages/dejaEnregistre.php");
        exit;
    } else { // sinon procéder à l'enregistrement dans le fichier texte
        // écrire dans le fichier d'enregistrement membres
        $ligneEnreg=$prenom.";".$nom.";".$courriel.";".$sexe.";".$naissance.";\n";
        fputs($enreg,$ligneEnreg);
        fclose($enreg);
        
        // Écrire dans le fichier connexion
        $ligneConnex=$courriel.";".$motDePasse.";".$statut.";".$role.";\n";
        fputs($connex,$ligneConnex);
        fclose($connex);

        // redirection vers la page succès
        header("Location: ../public/pages/enregistrementSucces.php");
        exit;
    }


    
?>


<!-- <?php
	require_once("../bdconfig/connexion.inc.php");
	$titre=$_POST['titre'];
	$categ=$_POST['categ'];
	$duree=$_POST['duree'];
	$res=$_POST['res'];
	$dossier="../ressources/pochettes/";
	$nomPochette=sha1($titre.time());
	$pochette="avatar.jpg";
	if($_FILES['pochette']['tmp_name']!==""){
		//Upload de la photo
		$tmp = $_FILES['pochette']['tmp_name'];
		$fichier= $_FILES['pochette']['name'];
		$extension=strrchr($fichier,'.');
		@move_uploaded_file($tmp,$dossier.$nomPochette.$extension);
		// Enlever le fichier temporaire chargé
		@unlink($tmp); //effacer le fichier temporaire
		$pochette=$nomPochette.$extension;
	}
	$requete="INSERT INTO films values(0,?,?,?,?,?)";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("ssiss", $titre,$categ, $duree,$res,$pochette);
	$stmt->execute();
	$id=$connexion->insert_id;

	mysqli_close($connexion);
	$msg = "Le film ".$id." a été bien enregistré.";
	header("Location:../../index.php?msg=$msg");
?> -->