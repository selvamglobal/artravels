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
        $page = 'password';
include_once('includes/top_nav_logged.php');
?>
        <div class="pimg1 text-left ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5 ">
                        <div class="cover-inner container reveal-top">
                            <h1 class="jumbotron-heading ">Change password</h1>
                           
                                <div class="row  text-primary text-left ">
                                    <div class="col-md-12 p-4 bg-white">
                                    <form>
                                    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">New password</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm assword</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
      </div>
    </div>
  
  <button type="submit" class="btn btn-primary">Update my password</button>
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