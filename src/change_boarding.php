<?php
session_start();
$title="ART Travels";
$description = "Online bus tickets from tiruppur to chennai, coimbatore to chennai, pollachi to chennai";
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>   <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
                            <h1 class="jumbotron-heading ">Change your boarding point</h1>
                            <h6 class="text-light-blue">Enter your ticket number and your email id to change your boarding point.</h6>
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
  <button type="submit" class="btn btn-lg btn-primary">Change boarding point</button> 

</form>
<div class="card text-primary text-left">
  <div class="card-body">
   <p class="pl-2"> Your ticket number: 123456789 <br>
   Your current boarding point: 123456789 <br>
   Your Name: Ramesh Selvam <br>
   Your email: fdfd@gmail.com <br> </p>
 
   <div class="form-group col-md-6">
                                        <label for="drop_point" class="col-form-label">Select new boarding point</label>
                                        <select class="form-control" name="drop_point" id="drop_point">
                                        <option selected>Select a boarding point</option>
                                      </select>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-success">Change boarding point</button> 
  </div>
</div><br>
<div class="alert alert-success" role="alert">
<i class="fa fa-thumbs-up fa-4x" aria-hidden="true"></i> <br>
  <h4 class="alert-heading">You have changed your boarding point successfully!</h4>
  <p>You will receive a confirmation email and sms shortly. </p>
 

</div>
 
 
  
  
 
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