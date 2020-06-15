<?php
    session_start();
    require_once "function.php";
    $db = new Database();
/******************************************************************* */
// view all users
// view all users
if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = "";
    $result =$db->affichejoueur();
    if (count($result) > 0) {
        $output .= ' <table class="table table-striped table-sm table-bordered">
                    <thead>
                        <!-- entete de la table -->
                        <tr class="text-center">
                            
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>score</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- corps de la table -->
                    <tbody>';
        for ($i=0; $i <count($result) ; $i++) {
            $output .= '<tr text-center text-secondary>
                    <td>' . $result[$i]['prenom'] . '</td>
                    <td>' .$result[$i]['nom']. '</td>
                    <td>' .$result[$i]['score']. '</td>
                    <td>
                   

                     <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal"
                     data-target="#myModal" id="' . $result[$i]['numuser']. '">
                     <i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;

                     <a href="#" title="Delete" class="text-danger delBtn" id="' . $result[$i]['numuser']. '">
                     <i class="fas fa-trash-alt fa-lg"></i></a> </td>
                     </tr>';
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3  class="text-center text-secondary mt-5>:( No any user present in the database</h3>';
    }
}

    /****************************************************** */
   
    // if(isset($_POST['action']) && $_POST['action'] =="logger"){
    //     $username = $_POST['login'];
    //     $password = md5($_POST['pwd']);
    //     $resultat = $db->connexion($username,$password);
    //    echo json_encode(array('error'=>$resultat));
    // }

    // if(isset($_POST['username']) && isset($_POST['password'])){
    //     $username = $_POST['username'];
    //     $password = md5($_POST['password']);
    //     $resultat = $db->connexion($username,$password);
    //    echo json_encode(array('error'=>$resultat));
    // }

    if(isset($_POST['pwd'])){
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
        
        $result = $db->inscription($prenom,$nom,$login,$password,$role,$image);
        echo json_encode(array('error'=>$result));
    }

    
    // delete question
    if(isset($_POST['delq_id'])){
        $id = $_POST['delq_id'];
       $result = $db-> deletequestion($id);
       echo json_encode(array('error'=>$result));
    }
    //delete joueur
    
     if(isset($_POST['del_id'])){
        $id = $_POST['del_id'];
    $result = $db-> deletejoueur($id);
   echo json_encode(array('error'=>$result));      
    }
    // edit joueur

    if(isset($_POST['edituser_id'])){
        $id = $_POST['edituser_id'];
    $result = $db->detailuser($id);
   echo json_encode($result);      
    }
  
?>