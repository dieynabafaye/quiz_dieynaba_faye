<?php  
 session_start();
 require_once "function.php";
 $db = new Database();
  if(isset($_POST['editq_id'])){
    $idquestion = $_POST['editq_id'];
    $result =$db->viewquestion( $idquestion);
    echo json_encode($result);
    
}
if(isset($_POST["action"])&& $_POST["action"]=="updatequestion"){
    unset($_POST["action"]);
    
    $montab = $_POST;
    //print_r($montab);
    $id =$montab['numquestion'];
    $question = $montab['question'];
    $nbre = $montab["nbr"];
    $type = $montab['type'];
     $reponse ="";
     $reponsevrai = "";
     if($montab['type']=='choixMultiple'){
        for ($i =1; $i<=count($montab['rep']) ; $i ++) { 
            $reponse.='-'.$montab['rep'][$i];
        }
        for ($i =0; $i < count($montab['vrais']) ; $i ++) { 
         $reponsevrai.='-'.$montab['vrais'][$i];
     }
     }elseif ($montab['type']=='choixSimple') {
         for ($i =1; $i<=count($montab['rep']) ; $i ++) { 
             $reponse.='-'.$montab['rep'][$i];
         }
         
          $reponsevrai=$montab['vrais'][0];
      
     }else{
         $reponsevrai = $montab['rep'];
         $reponse = $montab['rep'];
     }
    
 $result =$db->updatequestion($id,$question,$nbre,$type,$reponse,$reponsevrai);
 echo json_encode(array('result'=>$result));
}
?>