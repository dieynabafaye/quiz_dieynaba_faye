<?php 
session_start();
require_once './function.php';
include './fonction.php';
$db = new Database();
$_SESSION['dejatrouver'] = $db->rdejatrouver($_SESSION['numuser']);
$mescore = $db->meilleurscore();
$monmeilleur = $db->monmeilleurscore($_SESSION['numuser']);

    $_SESSION['jeu'] = $db->listerquestion();
  
$_SESSION['total'] =  ajouer2($_SESSION['dejatrouver'], $_SESSION['jeu']);

$limite = file_get_contents('../json/questionparjeu.json');
$limite = json_decode($limite, true);
if ($limite[0] < count($_SESSION['total'])) {
    $limite = $limite[0];
} else {
    $limite = count($_SESSION['total']);
} 
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Page joueur</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../CSS/inscription.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            /* width: 265px; */
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            width: 50%;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 200%;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);

        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>
  <body>
  <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-light header">
                <div id="logo"><img src="../IMG/logo-QuizzSA.png" alt=""></div>
                <h1 class="text-center font-weight-bold">Le plaisir de jouer</h1>
            </div>
        </div>
        <div class="bg-light mt-2" style="height: 530px;">
            <div class="row">
                <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
                        <a class="navbar-brand" href="">Page Joueur</a>
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
                                <a href="deconnexionj.php"><input class="btn btn-success" type="button" value="Deconnexion" onclick="if(!confirm('Voulez-vous vous déconnecter?'))return false;"></a> <!--affiche boutton deconnexion-->
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="form-group mt-2 mb-0 bg-info rounded text-center" >
                        <label for="" class="h2 p-3 d-block">Question:  <?php if (!empty($_SESSION['total'])){
                            echo $_GET['page'] + 1; } else {echo '0'; } ?>/<?php echo $limite; ?></label>
                          
                    </div>
                    <div class="form-group mt-2 mb-0">
                    <!------------------------------------------------>
                    <form action="./correction.php" method="post" style="height: 370px;" id="verifdata">
                        <div class="form-control" style="height: 270px;">
                        <?php if (!empty($_SESSION['total'])) {   ?>
                                <input type="hidden" name="numero" value="<?php echo $_GET['page']; ?>">
                                <input type="hidden" name="numquestion" value="<?php echo $_SESSION['total'][$_GET['page']]['numquestion']; ?>">
                                <label for="" class="h4"><?php echo $_SESSION['total'][$_GET['page']]['nomquestion']; ?></label>
                                <input type="hidden" name="question" value="<?php echo $_SESSION['total'][$_GET['page']]['nomquestion']; ?>">
                                <input type="hidden" name="type" value="<?php echo $_SESSION['total'][$_GET['page']]['type']; ?>">
                            <?php }  ?>
                            <?php
                            if (!empty($_SESSION['total'])) {
                                if ($_SESSION['total'][$_GET['page']]['type'] == "choixMultiple") { // grand if 1
                                    $reponse = $_SESSION['total'][$_GET['page']]['reponse'];
                                    $part = substr($reponse, 1);
                                    $rep = explode('-', $part);
                                    $tabquestion = $rep;

                                    if (count($tabquestion) > 1) {
                                        for ($i = 0; $i < count($tabquestion); $i++) {
                                            $answer = $tabquestion[$i];
                                        ?>
                                        <div class="form-inline">
                                            <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                            <input type="checkbox" name="vrais[]" value="<?php echo $i + 1; ?>" size="20" id="" <?php if (!empty($_SESSION['bon'])) {
                                                check($i + 1, $_SESSION['bon']);
                                            } ?> style="height: 60px;">
                                                <label for="" style="margin-left:8px; font-size: 20px"><?php echo $answer; ?></label>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        $answer = $reponse;
                                        //var_dump($answer);
                                        ?>
                                        <div class="form-inline">
                                            <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                            <input type="checkbox" name="vrais[]" size="20" id="" value="<?php echo 1; ?>" <?php if (!empty($_SESSION['bon'])) {
                                                check(1, $_SESSION['bon']);
                                            } ?>>
                                            <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                        </div>
                                        <?php
                                    }
                                } // fin grand if 1
                                elseif ($_SESSION['total'][$_GET['page']]['type'] == "choixSimple") { // grand elseif

                                    $reponse = $_SESSION['total'][$_GET['page']]['reponse'];
                                    $rep = substr($reponse, 1);
                                    $tabquestion = explode('-', $rep);

                                    if (count($tabquestion) > 1) {
                                        for ($i = 0; $i < count($tabquestion); $i++) {
                                            $answer = $tabquestion[$i];
                                        ?>
                                            <div class="form-inline">
                                                <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                <input type="radio" name="vrais" size="20" id="" value="<?php echo $i + 1; ?>" <?php if (!empty($_SESSION['bon'])) {
                                                    check2($i + 1, $_SESSION['bon']);
                                                } ?>>
                                                <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        $answer = $tabquestion;
                                        ?>
                                        <div class="form-inline">
                                            <input type="hidden" name="reponse[]" value="<?php echo $i; ?>">
                                            <input type="radio" name="vrais" size="20" id="" <?php if (!empty($_SESSION['bon'])) {
                                                check2($i + 1, $_SESSION['bon']);
                                            } ?>>
                                            <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                        </div>
                                    <?php
                                    }
                                } //fin grand elseif
                                else { // debut grand else
                                    ?>
                                    <div class="form-inline">
                                        <input type="text" class="form-control col-md-6" name="vrais" value="<?php if (!empty($_SESSION['bon'])) {
                                            echo $_SESSION['bon'];
                                        } ?>">
                                    </div>
                                    <?php
                                }
                            } // fin du si il n'y a pas de questions a joueur
                            else {
                                echo "le jeu est terminer";
                            }
                            ?>

                        </div>
                        <div class="form-row col-xs-12">
                            <div class="col-md-12">
                                <?php if ($_GET['page'] > 0) {  ?>
                                    <input class="btn btn-info col-xs-12 mt-3 ml-3" type="submit" name="precedent" id="precedent" value="Précédent">
                                <?php  } ?>

                                <?php if ($_GET['page'] < $limite - 1) { ?>
                                    <input class="btn btn-info col-xs-6 mt-3 ml-3" style="float: inline-end;" id="suivant" name="suivant" type="submit" value="Suivant">
                                <?php } else {  ?>
                                    <input class="btn btn-info col-xs-6 mt-3 ml-3" style="float: inline-end;" id="suivant" name="suivant" type="submit" value="Terminer">
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                    <!---------------------------------------------------------->

                 </div>
                   
                </div>
                <div class="col-5 mt-2 border-left border-secondary">
                <div class="dropdown " style="float:left;">
                        <button class="dropbtn">Les 5 meilleurs scores</button>
                        <div class="dropdown-content col-md-12" style="left:0;">
                            <table class="table table-striped table-sm table-bordered">
                                <?php    
                                for ($i = 0; $i < count($mescore); $i++) :
                                ?>
                                    <tr style="width:50%;height: 35px;">
                                        <td><?php echo $mescore[$i]['prenom']; ?></td>
                                        <td><?php echo $mescore[$i]['nom']; ?></td>

                                        <td><?php echo $mescore[$i]['score'] . ' pts'; ?>
                                        </td>
                                    </tr>

                                <?php
                                endfor;
                                ?>
                            </table>
                        </div>
                    </div>

                    <div class="dropdown " style="float:right;">
                        <button class="dropbtn">Mon meilleur score</button>
                        <div class="dropdown-content">
                            <table class="table table-striped table-sm table-bordered">
                                <?php

                                ?>
                                <tr style="width:50%;height: 35px;">
                                    <td><?php echo $monmeilleur[0]['prenom']; ?></td>
                                    <td><?php echo $monmeilleur[0]['nom']; ?></td>

                                    <td><?php echo $monmeilleur[0]['score'] . ' pts'; ?>
                                    </td>
                                </tr>

                                <?php

                                ?>
                            </table>
                        </div>
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
  </body>
</html>