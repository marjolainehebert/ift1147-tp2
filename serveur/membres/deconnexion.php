<?php
    //session_destroy();
    //session_unset();
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    $msg="Vous avez été déconnecté avec succès";
    header("Location:/tp2/public/pages/seConnecter.php?msg=$msg");
?>