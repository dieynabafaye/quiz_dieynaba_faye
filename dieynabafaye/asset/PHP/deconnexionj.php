<?php
    session_start();
    unset($_SESSION['joueur']);//détruit la variable session
    header('location:connexion.php');//rediriger vers la page de connexion

?>