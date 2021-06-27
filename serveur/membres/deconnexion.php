<?php
    session_destroy();
    session_unset();
    $msg="Vous avez été déconnecté avec succès";
    header("Location:../../public/pages/seConnecter.php?msg=$msg");
?>