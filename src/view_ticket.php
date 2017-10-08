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
                            <h1 class="jumbotron-heading ">Print / Send / Download your ticket</h1>
                            <h6 class="text-light-blue">Enter your ticket number and your email id.</h6>
                            <form class="text-left mt-5 mb-5">
  <div class="form-group">
    <label for="exampleInputEmail1">Ticket number<sup>*</sup></label>
    <input type="number" class="form-control is-invalid" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter ticket number">
    <small id="emailHelp" class="form-text text-danger">Please enter valid ticket number</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email<sup>*</sup></label>
    <input type="email" class="form-control is-valid" id="exampleInputPassword1" placeholder="Enter your email">
  </div>
  <button type="submit" class="btn btn-lg btn-success">Print  ticket</button> 
 <br> <br>
  <button type="submit" class="btn btn-lg btn-success">Send to SMS/email</button> <br> <br>
  <button type="submit" class="btn btn-lg btn-success">Download pdf</button>
</form>

 
 
  
  
 
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