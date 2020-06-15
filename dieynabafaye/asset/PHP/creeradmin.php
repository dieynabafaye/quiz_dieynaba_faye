<!doctype html>
<html lang="en">
  <head>
    <title>Creer admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../CSS/accueil1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container col-md-8 ms-3 badge-light shadow-lg p-3 mb-5 bg-white rounded mt-2">
        <div class="row ml-2">
            <div class="col-7">
                <form method="post" action="" class="form" id="form-inscription">
                    <h2>S'inscrire</h2>
                    <p class=" border-bottom border-secondary">Pour proposez des quizz</p>
                        <div class="input">
                            <div class="form-group mb-1">
                                <label for="prenom">Prenom</label>
                                <input type="text" name="prenom" class="form-control form-control-ms-3 col-md-8" id="prenom" placeholder="Prenom">
                                <small id="error1" style="color: red;"></small>
                            </div>
                            <div class="form-group mb-1">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" class="form-control form-control-ms-3 col-md-8" id="nom" placeholder="nom">
                                <small id="error2" style="color: red;"></small>
                            </div>
                            <div class="form-group mb-1">
                                <label for="login">Login</label>
                                <input type="text" name="login" class="form-control form-control-ms-3 col-md-8" id="login" placeholder="Login">
                                <small id="error3" style="color: red;"></small>
                            </div>
                            <div class="form-group mb-1">
                                <label for="pwd">Password</label>
                                <input type="password" name="pwd" class="form-control form-control-ms-3 col-md-8" id="pwd" placeholder="Password">
                                <small id="error4" style="color: red;"></small>
                            </div>
                            <div class="form-group mb-1">
                                <label for="pwd2">Confirmation</label>
                                <input type="text" hidden value='admin' name='role'>
                                <input type="password" name="pwd2" class="form-control form-control-ms-3 col-md-8" id="pwd2" placeholder="Confirm password">
                                <small id="error5" style="color: red;"></small>
                            </div>
                    </div>
                    <div class="form-group mb-1">
                        <label>Avatar</label>
                        <input type="file" name="files" value="Choisir un fichier" onchange="handleFiles(files)">
                    </div>
                    <button type="submit" name="envoie" id="inscrire" class="btn btn-primary col-md-8">Créer compte</button>
                </form>
            </div>
            <div class="col-4">
                <div class=" mt-5 avatar">
                    <span id="preview"></span>
                </div>
                <h4 class="ml-4">Avatar Admin</h4>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../JS/fonction.js"> </script>
    
  </body>
</html>