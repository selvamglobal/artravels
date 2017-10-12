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
        $page = 'profile';
include_once('includes/top_nav_logged.php');
?>
        <div class="pimg1 text-left ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5 ">
                        <div class="cover-inner container reveal-top">
                            <h1 class="jumbotron-heading ">My Profile</h1>
                           
                                <div class="row  text-primary text-left ">
                                    <div class="col-md-12 p-4 bg-white">
                                    <form>
                                    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" class="col-form-label">First name</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4" class="col-form-label">Last name</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" class="col-form-label">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4" class="col-form-label">Mobile</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputState" class="col-form-label">Gender</label>
      <select id="inputState" class="form-control">Choose</select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputCity" class="col-form-label">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress" class="col-form-label">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  

 
  <button type="submit" class="btn btn-primary">Update my profile</button>
</form>
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