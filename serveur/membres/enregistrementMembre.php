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

<?php
    require_once("../bdconfig/connexion.inc.php");

    $prenom=$_POST['prenom']; 
    $nom=$_POST['nom']; 
    $courriel=$_POST['courriel'];
    $sexe=$_POST['sexe'];
    $naissance=$_POST['naissance'];
    $motDePasse=$_POST['motDePasse'];
    $statut='A';
    $role='M';

    $requete="INSERT INTO films values(0,?,?,?,?,?,?,?,?)";
    $statement=$connexion->prepare($requete);
    $statement->bind_param("sssisiss", $titreFilm,$realisFilm,$categFilm,$dureeFilm,$langFilm,$dateFilm,$pochette,$urlPreview);
    $statement->execute();


    mysqli_close($connexion);
    $msg = "Le film <strong>".$titreFilm."</strong> a été bien enregistré.";
	header("Location:../../public/pages/admin.php?msg=$msg");
?>