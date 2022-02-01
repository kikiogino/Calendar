<?php
session_start();
ini_set("session.cookie_httponly", 1);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="calendar.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script> 
    (function(){Date.prototype.deltaDays=function(c){return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c)};Date.prototype.getSunday=function(){return this.deltaDays(-1*this.getDay())}})();
function Week(c){this.sunday=c.getSunday();this.nextWeek=function(){return new Week(this.sunday.deltaDays(7))};this.prevWeek=function(){return new Week(this.sunday.deltaDays(-7))};this.contains=function(b){return this.sunday.valueOf()===b.getSunday().valueOf()};this.getDates=function(){for(var b=[],a=0;7>a;a++)b.push(this.sunday.deltaDays(a));return b}}
function Month(c,b){this.year=c;this.month=b;this.nextMonth=function(){return new Month(c+Math.floor((b+1)/12),(b+1)%12)};this.prevMonth=function(){return new Month(c+Math.floor((b-1)/12),(b+11)%12)};this.getDateObject=function(a){return new Date(this.year,this.month,a)};this.getWeeks=function(){var a=this.getDateObject(1),b=this.nextMonth().getDateObject(0),c=[],a=new Week(a);for(c.push(a);!a.contains(b);)a=a.nextWeek(),c.push(a);return c}};
    </script>
</head>  
<body>
<br>
  <div class="float-right w-75">

      <nav class="nav" aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <button class="page-link" id = "previous_month_btn" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
                </button>
            </li>
            <li style = "font-size: 30px;" class="page-item" id="print_here"></li>
            <li class="page-item">
              <button class="page-link" id = "next_month_btn" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
                </button>
            </li>
          </ul>
          <p class="nav-link" ><button type="button"  style="display: none;" id="keys_btn" class="btn btn-secondary" data-toggle="modal" data-target="#keys">View Key</button></p>
          
  
        </nav>

        <table class="table table-bordered" id="maintable">
                <thead>
                  <tr class="table-primary" id="display_days_of_week">
                   
                    <th scope="col">Sunday</th>
                    <th scope="col">Monday</th>
                    <th scope="col">Tuesday</th>
                    <th scope="col">Wednesday</th>
                    <th scope="col">Thursday</th>
                    <th scope="col">Friday</th>
                    <th scope="col">Saturday</th>
                  </tr>
                </thead>
                <tbody id="table_body"></tbody>
              </table>

          </div>
          <br><br>
<div class="float-left w-25" id="pane">

<div id="welcome"></div>
<div style="display: none" id="message"></div>

<div id="loginuser">
    <input type="text" name="username" placeholder="Username" id="username" required/>
    <input type="password" name="password" placeholder="Password" id="password" required/>
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
    <button id="login_btn">Login</button>
    
</div>
<br>
<br>
<div id="signup">
    <input type="text" name="firstname" placeholder="First name" id="create_first_name" required/>
    <input type="text" name="lastname" placeholder="Last name" id="create_last_name" required/>
    <input type="text" name="username" placeholder="Username" id="createusername" required/>
    <input type="password" name="password" placeholder="Password" id="createpassword" required/>
    <button id="signup_btn">Signup</button>
</div>
<button style="display: none" id="logout_btn">Logout</button>
<br><br><br>

<div id="my_calendars">


<button type="button" style="display: none;" id="hi" class="btn btn-primary" data-toggle="modal" data-target="#addEventModal">Add Event</button>
<br>
<button type="button" style="display: none;" id="share_calendar" class="btn btn-success" data-toggle="modal" data-target="#shareCalendarModal">Share Entire Calendar</button>
<br><br>
  
  <h3>Theme:</h3>
<div class="form-check">
  <input class="form-check-input" type="radio" name="select_theme" id="none" value="none" checked>
  <label class="form-check-label" for="none">
    none
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="select_theme" id="red" value="red">
  <label class="form-check-label" for="red">
    red
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="select_theme" id="orange" value="orange">
  <label class="form-check-label" for="orange">
    orange
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="select_theme" id="green" value="green">
  <label class="form-check-label" for="green">
    green
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="select_theme" id="blue" value="blue">
  <label class="form-check-label" for="blue">
    blue
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="select_theme" id="purple" value="purple">
  <label class="form-check-label" for="purple">
    purple
  </label>
</div>

<div class="modal fade" id="shareCalendarModal" tabindex="-1" role="dialog" aria-labelledby="shareLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="shareLabel">Share Calendar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST">
                <h4>With whom would you like to share this calendar?
                  <br>
              </h4>
              
              <input type="text" placeholder="Enter name" name="share_calendar_username" id="share_calendar_username" required>
              <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
              <div class="modal-footer">
        <button class="btn btn-primary" id="submit_share_calendar_btn">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
              </form>
        </div>
       
      </div>
    </div>
  </div>


</div>


<p id="print_name"></p>

</div>
  <!-- Modal -->
  <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST">
                <p>Event Title: <input type="text" name="event_title" id="add_title" required></p>
                Date: <input type="date" name="date" id="add_date" required><br/>
                Time: <input type="time" name="time" id="add_time" required>
                Location: <input type="text" name="location" id="add_location" required>
                Description: <input type="text" name="description" id="add_description" required>
                <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="add_event_btn">Save changes</button>
        </div>
                </form>

              </div>
        
      </div>
    </div>
  </div>

  
  <!-- Modal -->
  <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <!-- in "View event" replace with event name -->
          <h5 class="modal-title" id="viewModalLabel">View Event</h5>
            
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <h1 id="view_title">Title</h1>
            <h3 id="view_date">Date</h3>
            <h3 id="view_time">Time</h3>
            <h3 id="view_location">Locatio </h3>
            <br>
            <p id="view_description">Description</p>
        </div>
        <div class="modal-footer">
        <button class='btn btn-warning' id='share_btn' data-toggle='modal' data-dismiss='modal' data-target='#shareEventModal'>Share Event</button>
        <button class='btn btn-success' id='edit_btn' data-toggle='modal' data-dismiss='modal' data-target='#changeEventModal'>Edit Event</button>
    <button class='btn btn-danger' id='delete_event_btn' data-dismiss="modal" >Delete Event</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="changeEventModal" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST">
                <p>Event Title: <input type="text" name="edit_date" id="edit_title" required></p>
                Date: <input type="date" name="edit_date" id="edit_date" required><br/>
                Time: <input type="time" name="time" id="edit_time" required>
                Location: <input type="text" name="location" id="edit_location" required>
                Description: <input type="text" name="description" id="edit_description" required>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="change_event_btn">Save changes</button>
          </div>
          </form>
              
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="shareEventModal" tabindex="-1" role="dialog" aria-labelledby="shareEventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="shareEventLabel">Share Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST">
                <h4>With whom would you like to share this event?
                  <br>
                  
              </h4>
              <p>These events stay even if you delete them. Ideal for sharing panels or concerts.</p>
             
              <input type="text" placeholder="Enter name" name="share_username" id="share_username" required>
              <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
              
              <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="submit_share_btn">Save changes</button>
        </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>


<div class="modal fade" id="keys" tabindex="-1" role="dialog" aria-labelledby="keys_header" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="keys_header">Key</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">  <p class="btn btn-primary"></p>Your events</li>
    <li class="list-group-item"><p  class="btn btn-success"></p>Individual events shared by others</li>
    <li class="list-group-item"><p  class="btn btn-danger"></p>Entire calendars shared by others</li>
  </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    <!-- //bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="login.js"></script>
    <script src="loggedIn.js"></script>
    <script src="calendar.js"></script>
    <script src="signup.js"></script>
    <script src="logout.js"></script>
    <script src="createevent.js"></script>
    <script src="load_event.js"></script>
    <script src="edit_event.js"></script>
    <script src="view_event.js"></script>
    <script src="delete_event.js"></script>
    <script src="share_event.js"></script>
    <script src="share_calendar.js"></script>
   
  
  
  
  </body>

</html>