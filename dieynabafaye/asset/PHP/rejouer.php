<?php
session_start();



$_SESSION['monscore']=0;
$_SESSION['trouver']=[];
$_SESSION['data']=[];
$_SESSION['total'] =[];
header('location:./interfacejoueur.php?page=0');
?>