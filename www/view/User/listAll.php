<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
    <title>Squash</title>

    <link href='./FullCalendar/core/main.css' rel='stylesheet' />
    <link href='./FullCalendar/daygrid/main.css' rel='stylesheet' />
    <link href='./FullCalendar/timegrid/main.css' rel='stylesheet' />
    <link href='./FullCalendar/list/main.css' rel='stylesheet' />
    <script src='./FullCalendar/core/main.js'></script>
    <script src='./FullCalendar/interaction/main.js'></script>
    <script src='./FullCalendar/daygrid/main.js'></script>
    <script src='./FullCalendar/timegrid/main.js'></script>
    <script src='./FullCalendar/list/main.js'></script>
    <script src='./FullCalendar/interaction/main.js'></script>

    <link rel="stylesheet" href="./Datepicker/css/datepicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="./Datepicker/css/layout.css" />
	  <script type="text/javascript" src="./Datepicker/js/jquery.js"></script>
	  <script type="text/javascript" src="./Datepicker/js/datepicker.js"></script>
    <script type="text/javascript" src="./Datepicker/js/eye.js"></script>
    <script type="text/javascript" src="./Datepicker/js/utils.js"></script>
    <script type="text/javascript" src="./Datepicker/js/layout.js?ver=1.0.2"></script>

    <link rel="stylesheet" href="css/css.css">
    <script>

  var cal = null;
  var mod = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    mod = document.getElementById("myModal");
    span = document.getElementsByClassName("close")[0];
    cal = new FullCalendar.Calendar(calendarEl, {
      plugins: [  'timeGrid', 'interaction' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridWeek'
      },
      titleFormat: {
        year: 'numeric', month: 'numeric', day: 'numeric'
      }, 
      defaultDate: '2019-05-15', // Aller chercher la date du jour en PHP
      minTime: "09:00:00", // Aller chercher depuis la base de données
      maxTime: "22:00:00", // Aller chercher depuis la base de données
      slotDuration: "01:00:00", // Ne pas changer, c'est bon
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      dateClick: CalendarDateOnClicked
    });

    //$('.datepicker').datepicker();

    span.onclick = function() {
      mod.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == mod) {
        mod.style.display = "none";
      }
    }
    cal.render();
  });


function CalendarDateOnClicked(info)
{

    var event={id:1 , title: 'Test event', start:  info.dateStr};
    var el = $("#calendar");
    cal.addEvent(event);
    mod.style.display = "block";
    //alert('Clicked on: ' + info.dateStr);
    //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
    //alert('Current view: ' + info.view.type);
    // change the day's background color just for fun
    //info.dayEl.style.backgroundColor = 'red';
  
}

</script>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/view/User/NavBar.php'; ?>
    
    <div id='calendar'></div>
    <div id="myModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="date" class="datepicker"></p>
          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>