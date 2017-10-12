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
                        <div class="cover-inner container reveal-top">
                            <h1 class="jumbotron-heading">Contact us</h1>
                            <h6 class="text-light-blue">We are always at your service.</h6>
                            <div class="card text-primary ">
  <div class="card-body">
  <div class="text-center ">
        
            <div class="ptext">
                <div class="cover-container pb-5 pt-5">
                    <div class="cover-inner container  " >
                            
                    <div class="row contact-details">
                <div class="col-lg-6 text-center   text-primary reveal-left">
                <h1>Photo gallery</h1>
                <?php
include_once('includes/gallery.php');
?>
                     
                </div>
                <div class="col-lg-6 text-center  text-primary  mb-4 reveal-right">
                <h1 >Contact details</h1>
                <img class="logo-invert mb-2" src="assets/logo-invert.svg" alt="ART Travels">
                <?php
                include_once('includes/contacts.php');
                ?>
                </div>
            </div>
                    </div>
                </div>
            </div>
        
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
        
    </body>
    </html>