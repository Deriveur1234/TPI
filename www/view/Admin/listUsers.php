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
        $('input[type="checkbox"]').click(function(){
          var nickname = $(this).val();
          var checked = $(this).prop("checked");
          $.ajax({
            method: 'POST',
            url: './ajax/changeConfirmation.php',
            data: {'Nickname': nickname , 'isConfirmed': Number(checked)},
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
    <table class="table">
    <tr>
        <th scope="col">Nickname</th>
        <th scope="col">Name + First name</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th> 
        <th scope="col">Confirmé</th>
        <th scope="col"></th>
    </tr>
    <?php
    if(isset($users))
    {
        for($i = 0; $i < count($users); $i++)
        {
            $user = $users[$i];
            include $_SERVER['DOCUMENT_ROOT'].'/view/Admin/OneListUser.php';
        }
    }
    ?>
    </table>
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>