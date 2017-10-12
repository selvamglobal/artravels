<?php
session_start();
if(!isset($_GET['bi'])){
	header("Location: http://www.arttravels.in");
exit;	
}
$title= "ART Travels";
$description = "Online bus tickets from tiruppur to chennai, coimbatore to chennai, pollachi to chennai";
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>
</head>
<body>
<?php
include_once('includes/top_nav.php');
?>
  <div class="pimg1 text-left ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5">
                        <div class="cover-inner container text-center reveal-top">
                            <h1 class="jumbotron-heading ">Success!</h1>
                            <div class="table-responsive bg-light-blue">
                            <div class="alert alert-success" role="alert">
<i class="fa fa-thumbs-up fa-4x" aria-hidden="true"></i> <br>
  <h4 class="alert-heading">You have booked your ticket  successfully!</h4>
  <h5 class="text-primary"> Your ticket ID is <?php echo $_GET['bi']; ?> </h5>
  <p class="text-primary">You will receive a confirmation email and sms shortly. </p>
 

</div>
                            </div>
     </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
<?php
include_once('includes/features.php');
include_once('includes/footer.php');
?>

    <script>
		$("#confirm").click(function(){
			$("#frmBooking").attr("method","post");
			$("#frmBooking").attr("action","confirm_booking.php?action=<?php echo $para;?>");
			$("#frmBooking").submit();
			
		});
    </script>
    
</body>

</html>