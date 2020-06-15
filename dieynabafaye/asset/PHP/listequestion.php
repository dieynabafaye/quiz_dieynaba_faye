<?php
  require_once "./function.php";
  require_once "./fonction.php";
  $db= new Database();

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Lister question</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../CSS/acceuil1.css">
  </head>
  <body>
    <div class="container col-md-9 ms-3 badge-light shadow-lg p-3 mb-5 bg-white rounded mt-2" style="height: 440px" >
      <label for="nbquestion">Nbquestion/Jeu</label>
      <input type="text" name="nbr" id="limite" class="form-control col-md-2 ms-3 d-inline">
      <input type="submit" class="btn-primary rounded" name="valider" id="jjj" value="OK">

      <div class="border border-info rounded " style="height: 320px; overflow: scroll;" id="scrollZone">
      
        <?php
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
      </div>
      
      <button type="submit" class="btn btn-info d-inline mt-2">Valider</button>
     

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modifier question</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="" method="post" id="addquestions">
      <input type="hidden" name="numquestion" id="numquestion">
          <div class="form-group">
              <label for="question">Question</label>
              <input type="text" name="question" id="question" class="form-control-lg col-md-10 d-inline">
          </div>
          <div class="form-group">
              <label for="nbpoint">Nbpoint</label>
              <input type="text" name="nbr" id="nbrep" class="form-control-lg col-md-2 ms-3 d-inline" pattern="^(1|2|3|4|5|6|7|8|9)[0-9]*$">
          </div>
          <div class="form-group">
              <label for="nbpoint">Type de question</label>
              <select class="form-control col-md-5 ms-3 d-inline" name="type" id="typ">
                  <option value="Selectionnez votre choix">Selectionnez votre choix</option>
                  <option value="choixMultiple">choixmultiple</option>
                  <option value="choixSimple">choix simple</option>
                  <option value="choixText">choix texte</option>
              </select>
              <button type="button" class="btn btn-info d-inline mt-6" onclick="genere()">+</button>
          </div>
              <div class="active" style="height: 200px; overflow: scroll;">
                  <div class="hautgener" id="hautgener">
                      <div class="divgener" id="row_0">
                        
                      </div>
                  </div>
                </div>
                <input type="submit" id="btnval" name="btnval" class="btn btn-info d-inline mt-6">
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
        
    </div>
  </div>
</div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../JS/question.js"> </script>
    <script>
      // limite par jeu
    $("#limite").change(function () {
      
        var limite = $("#limite").val();
        
           $.ajax({
               url: "./listerq.php",
               type: "POST",
               data: {
                   limite: limite
               },
               success:function(response){
               console.log(response);
               }
           });
       });
    </script>
  </body>
  
</html>
