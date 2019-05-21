<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css">
    <title>Squash</title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/view/Admin/NavBar.php'; ?>
    <div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
        <h1>Profil</h1>
        </div>

        <table class="table">
          <tr>
            <td> Name : <?= $user->Name ?> </td>
            <td> Firstname : <?= $user->FirstName ?> </td>
          </tr>
          <tr>
            <td> Email : <?= $user->Email ?> </td>
            <td> Phone : <?= $user->Phone ?> </td>
          </tr>
        </table>
        <!-- Login Form -->
        <?php
        if(isset($reservations))
        for($i = 0; $i < count($reservations); $i++)
        {
          $reservation = $reservations[$i];
          include $_SERVER['DOCUMENT_ROOT'].'/view/ReservationTemplate.php';
        }

        ?>

    </div>
    </div>
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>