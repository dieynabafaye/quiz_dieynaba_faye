<!doctype html>
<html lang="en">
  <head>
    <title>Créer question</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../CSS/acceuil1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="container col-md-10 ms-3 badge-light shadow-lg p-3 mb-5 bg-white rounded mt-2">
        <form action="" method="post" id="addquestion">
          <div class="form-group">
              <label for="question">Question</label>
              <input type="text" name="question" id="question" class="form-control-lg col-md-10 d-inline">
          </div>
          <div class="form-group">
              <label for="nbpoint">Nbpoint</label>
              <input type="number" name="nbr" id="nbr" class="form-control-lg col-md-2 ms-3 d-inline">
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
              <div class="active">
                  <div class="hautgener" id="hautgener">
                      <div class="divgener" id="row_0">
                        
                      </div>
                  </div>
                </div>
                <input type="submit" id="btnval" name="btnval" class="btn btn-info d-inline mt-6">
        </form>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="../JS/question.js"> </script>
  </body>
</html>