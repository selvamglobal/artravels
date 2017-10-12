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
$page = 'cancel';
include_once('includes/top_nav.php');
?>
        <div class="pimg1 text-center ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5">
                        <div class="cover-inner container  reveal-top" style="max-width:600px;">
                            <h1 class="jumbotron-heading ">Cancel your ticket</h1>
                            <h6 class="text-light-blue">Enter your ticket number and your email id to cancel your ticket.</h6>
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
  <button type="submit" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#exampleModal">Cancel  ticket</button> 
  
  <!-- Confirm Modal -->

</form>
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Please confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-danger">
       Are you sure you want to cancel your ticket?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
        <button type="button" class="btn btn-primary">Yes, Cancel my ticket</button>
      </div>
    </div>
  </div>
</div>
<div class="alert alert-success" role="alert">
<i class="fa fa-thumbs-up fa-4x" aria-hidden="true"></i> <br>
  <h4 class="alert-heading">You have cancelled your ticket successfully!</h4>
  <p>You will receive a confirmation email and sms shortly. </p>
 

</div> -->
 
 
  
  
 
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