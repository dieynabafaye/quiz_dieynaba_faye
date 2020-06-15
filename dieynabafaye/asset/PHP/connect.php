<?php
require_once './function.php';
$db = new Database();
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $resultat = $db->connexion($username,$password);
   echo json_encode(array('error'=>$resultat));
}
 ?>