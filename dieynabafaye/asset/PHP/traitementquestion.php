<?php

$pdo = new PDO('mysql:dbname=myquiz;host=localhost','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);


$montab = $_POST;
$question = $montab['question'];
$nbre = $montab["nbr"];
$type = $montab['type'];
 $reponse ="";
 $reponsevrai = "";
 if($montab['type']=='choixMultiple'){
    for ($i =1; $i<=count($montab['rep']) ; $i ++) { 
        $reponse.='-'.$montab['rep'][$i];
    }
    for ($i =0; $i < count($montab['vrais']) ; $i ++){ 
     $reponsevrai.='-'.$montab['vrais'][$i];
 }
 }elseif ($montab['type']=='choixSimple') {
     for ($i =1; $i<=count($montab['rep']) ; $i ++){ 
         $reponse.='-'.$montab['rep'][$i];
     }
     
      $reponsevrai=$montab['vrais'][0];
  
 }else{
     $reponsevrai=$montab['rep'];
     $reponse=$montab['rep'];
 }
 $req=$pdo->prepare('INSERT INTO question SET nomquestion=?,nbpoint=?,type=?,reponse=?,vrai=?');
 $req->execute([$question,$nbre,$type,$reponse,$reponsevrai]);

?>