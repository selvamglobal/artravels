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
include_once('includes/top_nav.php');
?>
        <div class="pimg1 text-center ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5">
                        <div class="cover-inner container  reveal-top" style="max-width:600px;">
                            <h1 class="jumbotron-heading ">Forgot your password?</h1>
                            <h6 class="text-light-blue"> Enter your password, we will send password reset link if it matches our records. </h6>
                            <form class="text-left mt-5 mb-5">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control is-invalid" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-danger">Please enter valid email</small>
  </div>
 
 
  <button type="submit" class="btn btn-lg btn-success"> Send password reset link </button>
</form>

 
 
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