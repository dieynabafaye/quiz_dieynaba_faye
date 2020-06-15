<?php
  session_start();
  require_once "function.php";
  $db = new Database();
    // update jpueur
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $login = $_POST['login'];
        $role = $_POST['role'];
        $password = md5($_POST['pwd']);
        $target_dir = "../IMG/avatar/";
        $target_file = $target_dir . basename($_FILES["files"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["files"]["tmp_name"]);
        if ($check !== false) {
    
            $uploadOk = 1;
        } else {
            $msg = "le fichier n'est pas un image.";
            $uploadOk = 0;
        }
        if ($_FILES["files"]["size"] > 500000) {
            $msg = "Désoler votre fichiers est trop grand.";
            $uploadOk = 0;
        }
    
        if ($imageFileType != "jpg" && $imageFileType != "png") {
            $msg = "Désoler seul les formats jpg et png sont autorisés";
            $uploadOk = 0;
        }
    
        if ($uploadOk == 0) {
            $msg = "Désolé votre fichiers n'a pas été télécharger.";
        } else {
    
            if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
    
                $photo = basename($_FILES["files"]["name"]);
                $image = $photo;
            } else {
                $msg = "Désolé des erreurs on arreter le telechargement de votre fichier.";
            }
        }
        // print_r($_POST);
        
       $result =$db->updateuser($id,$prenom, $nom, $role, $login, $password,$image);
        echo json_encode(array('error'=>$result));
        // if($result){
        //     echo "bonjour";
        // }
    }
    
?>