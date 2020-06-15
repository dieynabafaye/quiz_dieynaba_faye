<?php
require_once './function.php';
$db = new Database();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Lister joueur</title>
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
  <style>
    #preview img{
    height: 150px;
    width: 150px;
    border-radius: 100px;
}
  </style>
    </head>
  <body>
  <div class="row"style="margin-top: 25px;">
        <div class="col-lg-12">
            <div class="table-responsive" id="showuser">
                <h3 class="text-center text-success" style="margin-top:150px">Loading&nbsp;&nbsp;<i class="fas fa-sync-alt fa-spin text-success"></i></h3>

            </div>
        </div>

    </div>
   
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
             <form method="post" action="" class="form" id="form-update">
                    <h2>S'inscrire</h2>
                    <p class=" border-bottom border-secondary">Pour proposez des quizz</p>
                      <input type="hidden" name="update" value="update">
                        <div class="input">
                            <div class="row">
                              <div class="col-6">

                                    <div class="form-group mb-1">
                                    <input type="text" name="id" id="id" >
                                        <label for="prenom">Prenom</label>
                                        <input type="text" name="prenom" class="form-control form-control-ms-3 col-md-9" id="prenom" placeholder="Prenom">
                                        <small id="error1" style="color: red;"></small>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label for="nom">Nom</label>
                                        <input type="text" name="nom" class="form-control form-control-ms-3 col-md-9" id="nom" placeholder="nom">
                                        <small id="error2" style="color: red;"></small>
                                    </div>
                              </div>
                              <div class="col-6">
                              <div class="avatar" style="height: 150px; width: 150px; border-radius: 100px;">
                                  <span id="preview"></span>
                              </div>
                              </div>
                            </div>
                            <div class="form-group mb-1">
                                <label for="login">Login</label>
                                <input type="text" name="login" class="form-control form-control-ms-3 col-md-9" id="login" placeholder="Login">
                                <small id="error3" style="color: red;"></small>
                            </div>
                            <div class="form-group mb-1">
                                <label for="pwd">Password</label>
                                <input type="password" name="pwd" class="form-control form-control-ms-3 col-md-9" id="pwd" placeholder="Password">
                                <small id="error4" style="color: red;"></small>
                            </div>
                            <div class="form-group mb-1">
                                <label for="pwd2">Confirmation</label>
                                <input type="text" hidden value='joueur' name='role'>
                                <input type="password" name="pwd2" class="form-control form-control-ms-3 col-md-9" id="pwd2" placeholder="Confirm password">
                                <small id="error5" style="color: red;"></small>
                            </div>
                    </div>
                    <div class="form-group mb-1">
                        <label>Avatar</label>
                        <input type="file" name="files" value="Choisir un fichier" onchange="handleFiles(files)">
                    </div>
                    <input type="submit" name="envoie" id="updateuser" class="btn btn-primary col-md-4"/>
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../JS/fonction.js"> </script>
    <script>
      $(document).ready(function(){
        $("#updateuser").click(function(e){
            
            e.preventDefault();
            
            var form = $('#form-update')[0];
            var fd = new FormData(form);
            var bool=false;
            if($('#prenom').val()==""){
                    $('#error1').text('Veuillez saisir un prenom!')
                   bool= true
                }else{
                    $('#error1').text('')
                }
                if($('#nom').val()==""){
                    $('#error2').text('Veuillez saisir un nom!')
                    bool= true
                }else{
                    $('#error2').text('')
                }
                 if($('#login').val()==""){
            $('#error3').text('Veuillez saisir un login!')
            bool= true
        }else{
            $('#error3').text('')
        }
        if($('#pwd').val()=="" ||$('#pwd2').val()!=$('#pwd').val() ){
            $('#error4').text('Veuillez saisir un mot de passe!')
            bool= true
        }else{
            $('#error4').text('')
        }
        if($('#pwd2').val()==""){
            $('#error5').text('Veuillez saisir un mot de passe identique au précédent!')
            bool= true
        }else{
            $('#error5').text('')
        }
                if(bool==false){
            $.ajax({
                url: '../PHP/updatejoueur.php',  
                type: 'POST',
                data: fd,
                enctype: "multipart/form-data",
                cache: false,
                timeOut: 600000,
                contentType: false,
                processData: false,
                success: function(response){
                   console.log(response);
                     data =JSON.parse(response);
                    if(data.error=="vrai"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ce login existe déjà!'
                        })
                    }
                    else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Bravo...',
                            text: 'Modification Validé!'
                        })
                        $("#myModal").modal('hide');
                    }
                },
            });
        }else{
            alert('Veuillez Saisir tous les champs!')
        }
    
        });


        // edit user
            // update user
        $("body").on("click", ".editBtn", function (e) {
            //console.log("working");
            e.preventDefault();
            edituser_id = $(this).attr('id');
            $.ajax({
                url: "./action.php",
                type: "POST",
                data: {
                    edituser_id: edituser_id
                },
                success: function (response) {
                  
                    data = JSON.parse(response);
                    $("#id").val(data[0].numuser);
                    $("#prenom").val(data[0].prenom);
                    $("#nom").val(data[0].nom);
                    $("#login").val(data[0].login);
                }
            });
        });
      });
    </script>
  </body>
</html>