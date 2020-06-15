<?php
    //limite par jeu
  if (isset($_POST['limite'])) {
    $id = $_POST['limite'];
    $limite = file_get_contents('../json/questionparjeu.json');
    $limite = json_decode($limite, true);
    if (!empty($limite)) {
        $limite[0] = $id;
        $limite = json_encode($limite);
        file_put_contents("../json/questionparjeu.json", $limite);
    } else {
        $limite[] = $id;
        $limite = json_encode($limite);
        file_put_contents("../json/questionparjeu.json", $limite);
    }
    echo $id;
  }
?>