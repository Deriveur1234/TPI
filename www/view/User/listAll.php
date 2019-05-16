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

    <link rel="stylesheet" href="http://cdn.dhtmlx.com/edge/dhtmlx.css" 
    type="text/css"> 
<script src="http://cdn.dhtmlx.com/edge/dhtmlx.js" 
    type="text/javascript"></script>


    
    <script>

  var cal = null;
  var mod = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  var myCalendar = null;

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    mod = document.getElementById("myModal");
    span = document.getElementsByClassName("close")[0];
    myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.show();
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
      defaultDate: '<?= date("o-m-t") ?>',
      minTime: "<?= $BeginTime ?>:00:00", 
      maxTime: "<?= $EndTime + 1 ?>:00:00", 
      slotDuration: "01:00:00", // Ne pas changer, c'est bon
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      dateClick: CalendarDateOnClicked
    });

    $("#btnReservation").click(btnReservationOnClicked);


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
    myCalendar.setDate(info.dateStr);
    var time = info.date.getHours();
    $("#selectTime").val(time);
    myCalendar.show();
    mod.style.display = "block";
    //alert('Clicked on: ' + info.dateStr);
    //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
    //alert('Current view: ' + info.view.type);
    // change the day's background color just for fun
    //info.dayEl.style.backgroundColor = 'red';
  
}

function btnReservationOnClicked()
{
   var Id = 1;
   var date = 
   mod.style.display = "none";
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
          <div id="box" style="position:relative;height:250px;"></div>
          <select class="form-control" id="selectCourts">
            <?php
            if(isset($courts))
            {
              for($i = 0; $i < count($courts); $i++)
              {
                echo "<option value=\"" . $courts[$i]->Id . "\">" . $courts[$i]->Name . "</option>";
              }
            }
            ?>
          </select>

          <select class="form-control" id="selectTime">
            <?php
              if(isset($BeginTime) && isset($EndTime))
              {
                for($i = $BeginTime; $i <= $EndTime; $i++)
                {
                  echo "<option value=\"" . $i . "\">" . $i . "h</option>";
                }
              }
            ?>
          </select>
        </div>
          
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnReservation">Reservation</button>
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