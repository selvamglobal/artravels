<?php
session_start();
$title = 'Select Your Bus - Art Travels'; $description = '';
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>
<link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
       </head>
    <body>
        <?php
        $page = 'history';
include_once('includes/top_nav_logged.php');
?>
        <div class="pimg1 text-left ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5 ">
                        <div class="cover-inner container reveal-top">
                            <h1 class="jumbotron-heading ">Booking History</h1>
                           
                                <div class="row  text-primary text-left ">
                                    <div class="col-md-12 ">
                                    <div class="table-responsive   bg-white p-5">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-upcoming-tab" data-toggle="pill" href="#pills-upcoming" role="tab" aria-controls="pills-home" aria-expanded="true">Upcoming trips</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-past-tab" data-toggle="pill" href="#pills-past" role="tab" aria-controls="pills-profile" aria-expanded="true">Past trips</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-cancelled-tab" data-toggle="pill" href="#pills-cancelled" role="tab" aria-controls="pills-home" aria-expanded="true">Cancelled trips</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-failed-tab" data-toggle="pill" href="#pills-failed" role="tab" aria-controls="pills-profile" aria-expanded="true">Failed trips</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-home-tab">
  <table class="table table-bordered ">
      <thead class="text-secondary">
          <tr class="text-secondary">
              <th>Ticket No </th>
              <th>From - To</th>
              <th>Booked On</th>
              <th>Journey Date</th>
              <th>Seat(s)</th>
              <th>Amount</th>
              <th>Actions</th>
          </tr>
      </thead>
      <tbody>
          <td>1845718</td>
          <td>Tirupur to Chennai</td>
          <td>2017-10-10 06:38:29</td>
          <td>2017-10-12</td>
          <td>5,4,7,8</td>
          <td>2793.00</td>
          <td>
          <a class="text-danger" href="#">Cancel</a> <br> <a href="#">Change boarding point</a>
          </td>
      </tbody>
  </table>
  </div>
  <div class="tab-pane fade" id="pills-past" role="tabpanel" aria-labelledby="pills-profile-tab">Past trips</div>
  <div class="tab-pane fade show" id="pills-cancelled" role="tabpanel" aria-labelledby="pills-home-tab">Cancelled trips</div>
  <div class="tab-pane fade" id="pills-failed" role="tabpanel" aria-labelledby="pills-profile-tab">Failed trips</div> 
</div>  </div>
                                </div>

                                

                               
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
 
include_once('includes/footer.php');
?>
        <script>
            function ViewSeats(route_id) {
                window.location = 'select_seat.php?id=' + route_id;
            }
        </script>
    </body>

    </html>