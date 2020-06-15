<?php
     require_once "function.php";
     require_once "fonction.php";
     $db = new Database();
      //lister question
    
        $montableau=[];
        $sql= "SELECT * FROM question";
        
    $limit = $_POST['limit'];
    $offset = $_POST['offset'];
  


    $sql ="
            SELECT * 
            FROM question
            LIMIT {$limit} 
            OFFSET {$offset}
    ";
        $stmt= $db->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $montableau[]=$row;
        }
        
        $montableau = $db->listerquestion();
        // var_dump($montableau);
      $total=count($montableau);
      $reponse =array();
      $vrai=array();
      for ($i=0; $i < $total; $i++) { 
        $laquestion =$montableau[$i]['nomquestion'];
        $numeroquestion=$i+1;
        ?>
          <label for=""><?php echo $numeroquestion.'. '.$laquestion;?></label>
          <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal"
                 data-target="#myModal" id="<?php echo $montableau[$i]['numquestion'] ;?>">
                 <i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;

                 <a href="#" title="Delete" class="text-danger delBtn" id="<?php echo $montableau[$i]['numquestion'] ;?>">
                 <i class="fas fa-trash-alt fa-lg"></i></a>
         <br>
        
        <?php
        if($montableau[$i]['type']=='choixMultiple'){
          $reponse =decouper($montableau[$i]['reponse']);
          $vrai =decouper($montableau[$i]['vrais']);
          for ($j=0; $j <count($reponse) ; $j++) { 
            ?>
            <input type="checkbox" name="" id="" <?php  cocher($vrai,($j+1));?>><label for=""><?php echo $reponse[$j] ;?></label><br>
            <?php
          }
        }
        elseif($montableau[$i]['type']=='choixSimple'){
          $reponse =decouper($montableau[$i]['reponse']);
          $vrai =$montableau[$i]['vrais'];
         
          for ($j=0; $j <count($reponse) ; $j++) { 
            ?>
            <input type="radio" name="" id="" <?php  cocher2($vrai,($j+1));?>><label for=""><?php echo $reponse[$j] ;?></label><br>
            <?php
          }
        }
        else{
          ?>
          <input type="text" value="<?php echo $montableau[$i]['vrais'];?>"><br><br>
          <?php
        }
        
      } 

?>