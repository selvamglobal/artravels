<?php
session_start();
$title="ART Travels";
$description = "Online bus tickets from tiruppur to chennai, coimbatore to chennai, pollachi to chennai";
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/jquery.datetimepicker.css" />
    </head>
    <body>
<?php
$page = 'signin';
include_once('includes/top_nav.php');
?>
        <div class="pimg1 text-center ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5">
                        <div class="cover-inner container  reveal-top" style="max-width:600px;">
                            <h1 class="jumbotron-heading ">Sign in</h1>
                            <h6 class="text-light-blue"> You can manage your ticket easily by signing into your account! </h6>
                            <form class="text-left mt-5 mb-5">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control is-invalid" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-danger">Please enter valid email</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control is-valid" id="exampleInputPassword1" placeholder="Password">
  </div>
 
  <button type="submit" class="btn btn-lg btn-success">Sign in</button>
</form>

 
 
  <p class="text-left"> <a  class="text-danger" href="forgot_password.php"> Forgot your password?</a> </p>
   <p class="text-left">  <a href="sign_up.php" class="text-white"> New user? Create your account!</a> </p>
  
  
 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
 include_once('includes/footer.php');
?>
        
    </body>
    </html>