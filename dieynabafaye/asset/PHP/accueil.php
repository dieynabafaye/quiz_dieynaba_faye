<?php
    session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Acceuil</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../CSS/acceuil1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body class="sb-nav-fixed">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-light header">
                <div id="logo"><img src="../IMG/logo-QuizzSA.png" alt=""></div>
                <h1 class="text-center font-weight-bold">Le plaisir de jouer</h1>
            </div>
        </div>
        <div class="bg-light mt-2" style="height: 680px;">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
                        <a class="navbar-brand" href="">Accueil</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown">
                                    <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Contenu
                                    </a> -->
                                </li>
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <a href="deconnexiona.php"><input class="btn btn-success" type="button" value="Deconnexion" onclick="if(!confirm('Voulez-vous vous déconnecter?'))return false;"></a> <!--affiche boutton deconnexion-->
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group mt-2 mb-0">
                        <a class="btn btn-primary btn-block rounded-pill" href="accueil.php?page=listeQuestion">Lister Questions</a>
                    </div>
                    <div class="form-group mt-2 mb-0">
                        <a class="btn btn-success btn-block rounded-pill" href="accueil.php?page=creerQuestion">Créer Questions</a>
                    </div>
                    <div class="form-group mt-2 mb-0">
                        <a class="btn btn-danger btn-block rounded-pill" href="accueil.php?page=listeJoueur">Lister Joueur</a>
                    </div>
                    <div class="form-group mt-2 mb-0">
                        <a class="btn btn-warning btn-block rounded-pill" href="accueil.php?page=creerAdmin">Créer Admin</a>
                    </div>
                </div>
                <div class="col-9 mt-2 border-left border-secondary">
                <?php
                    if(!isset($_GET['page'])){
                        $page = './accueil.php';
                    }
                    else{
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'listeQuestion':
                                include('./listequestion.php');
                                break;
                            case 'creerAdmin':
                                include('./creeradmin.php');
                                break;
                            case 'listeJoueur':
                                include('./listejoueur.php');
                                break;
                            case 'creerQuestion':
                                include('./creerquestion.php');
                                break;
                            default:
                                'Erreur de chargement';
                                break;
                        }
                    }
                ?>
                </div>
            </div>
         </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="../JS/fonction.js"> </script>
  </body>
</html>