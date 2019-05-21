<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title>Squash</title>
    <script>
      $(document).ready(function(){
        $('#btnDeleteCourt').click(function(){
          var courtName = $('#selectCourt option:selected').val();
          $.ajax({
            method: 'POST',
            url: './ajax/deleteCourt.php',
            data: {'Nickname': courtName},
            dataType: 'json',
            success: function (data) {
                switch (data.ReturnCode)
                {
                    case 1:
                    break;
                    case 0:
                        alert(data.Message);
                    break;
              }
            }, // #end success
            error: function (jqXHR) {
              msg = "Une erreur est survenue. Error : "
                switch(jqXHR.status){
                  case 200 : 
                        msg = msg + jqXHR.status + " Le json retourné est invalide.";
                        break;
                case 404 : 
                        msg = msg + jqXHR.status + " La page checklogin.php est manquante.";
                    break;
              } // #end switch
            alert(msg);
            } // #end error
          });
        });
      });
    </script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/view/Admin/NavBar.php'; ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
            <div class="fadeIn first">
                <h1>Préférences</h1>
            
            <table class="table">
              <tr>
                <td colspan = "3">
                  <select id="selectCourt" name="Courts" multiple>
                  <?php
                  if(isset($courts))
                  {
                      for($i = 0; $i < count($courts); $i++)
                      {
                          echo "<option>" . $courts[$i]->Name . "</option>";
                      }
                  }
                  ?>
                  </select>
                </td>
              </tr>
              <tr>
                  <td><a>Add</a></td>
                  <td ><a>Edit</a></td>
                  <td id="btnDeleteCourt"><a>Delete</a></td>
              </tr>
              <tr>
                  <td colspan="3"><h3>Paramètres généraux<h3></td>
              </tr>
              <form method="POST" action="?action=ModifyPreference" >
                <tr>
                    <td colspan="2"> Horaire d'ouverture : </td>
                    <td> <input type="time" name="openingTime" value="<?= $preferences->BeginTime ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"> Horaire de fermeture : </td>
                    <td> <input type="time" name="closingTime" value="<?= $preferences->EndTime ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"> Nombre de réservations par personne : </td>
                    <td> <input type="number" name="nbReservationByUser" value="<?= $preferences->NbReservation ?>"></td>
                </tr>
                <tr>
                  <td></td>
                  <td colspan="2"><input type="submit"></td>
                </tr>
              </form>
            </table>
            </div>
        </div>
    </div>
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>