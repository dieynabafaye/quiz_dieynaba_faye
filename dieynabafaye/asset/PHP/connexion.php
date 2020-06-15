<?php
    session_start();
   
    
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Page connexion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="header">
        <div id="logo"><img src="../IMG/logo-QuizzSA.png" alt=""></div>
        <div class="titre"><h1>Le plaisir de joueur</h1></div>
    </div>
    <div class="container col-md-4 ms-3 badge-light shadow-lg p-3 mb-5 bg-white rounded mt-5">
        <form action=""id="form-login" method="post">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control form-control-ms-3 col-md-12" id="login" autocomplete="false" placeholder="Login">
                <small id="error1" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="pwd" class="form-control form-control-ms-3 col-md-12" id="pwd" autocomplete="false" placeholder="Password">
                <small id="error2" style="color: red;"></small>
            </div>
            <button type="submit" name="envoie" id="envoie" class="form-control form-control-mb-3 btn btn-primary col-md-12">Submit</button>
            <a href="../PHP/inscription.php"><p>S'inscrire pour jouer?</p></a>
        </form>
    </div>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    
    <script>
       $(document).ready(function () {
    
    $("#form-login").submit(function(e){
        e.preventDefault();
        if($('#login').val()==""){
                $('#error1').text('Veuillez saisir un login!')
               
            }
            if($('#pwd').val()==""){
                $('#error2').text('Veuillez saisir un mot de passe!')
            }else{
        $.ajax({
            url:'connect.php',
            type:"POST",
            data:{
                username:$('#login').val(),
                password:$('#pwd').val()
            },
            success:function(response){
                
                data =JSON.parse(response);
                if(data.error =="admin"){
                    window.location.href='./accueil.php';
                }else if(data.error == "joueur"){
                    window.location.href ="./interfacejoueur.php?page=0";
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Login ou mot de passe incorrecte!'
                    })
                }
            }
        });
    }
        
    });
        });
   </script>
  </body>
</html>
