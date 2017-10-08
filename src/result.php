<?php
session_start();
if(!isset($_GET['bi'])){
	header("Location: http://www.arttravels.in");
exit;	
}
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>ART Travels</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
    <link href="https://fonts.googleapis.com/css?family=Faster+One|Roboto:300,400" rel="stylesheet">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.js"></script> <!-- seat -->
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="#">ART Travels</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Book Ticket <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Print Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cancel Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Change Boarding Pass</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sign In / Sign Up</a>
                </li>

            </ul>
        </div>
    </nav>
 
<div class="container">
	<div class="row">
    	<div class="col-lg-12"><div class="alert alert-success">Booking ID: <?php echo $_GET['bi']; ?></div></div>
    </div>
</div>
    <section id="contact" class="contact features-2">
        <div class="container text-center">
            <h2 class="text-primary reveal-top">Contact Us</h2><br>
            <div class="divider"></div>
            <div class="row contact-details">
                <div class="col-lg-6 text-center reveal-left">
                    <img class="mb-5 img-fluid" src="assets/home.jpeg">
                </div>
                <div class="col-lg-6 text-left text-lg-left mb-4 reveal-right">
                    <p class="lead mt-0 mb-2">Please feel free to contact us!</p>
                    <h4 class="pt-4">Email</h4>
                    <p>info@arttravels.in</p>
                    <h4 class="pt-2">Mobile</h4>
                    <p>&#43;91 &nbsp; 1234567890 </p>
                    <p>&#43;91 &nbsp; 1234567890 </p>
                    <h4 class="pt-2">Address</h4>
                    <p>Office Address Goes here! </p>
                    <h4 class="pt-2">Follow us on Social Medai</h4>
                    <ul class="social text-left">
                        <li><a target="_blank" href="#" title="Facebook" class="fa fa-facebook text-info"></a></li>
                        <li><a target="_blank" href="#" title="Youtube" class="fa fa-youtube text-info"></a></li>
                        <li><a target="_blank" href="#" title="Google+" class="fa fa-google text-info "></a></li>
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer-3 bg-light">
            <div class="container-fluid bg-dark">
                     <div class="col text-white text-center pt-2 pb-2">Home About us Terms and Conditions Privacy Policy FAQ Why KPN? Gallery Contact us</div>
                </div>

        <div class="container-fluid">
            <div class="divider"></div>
        </div>
        <div class="container">
           
            <div class="row">
                <div class="col-md-6 text-center text-md-left mt-2  pt-2">
                    <p>Copy Rights All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right mt-2 pt-2">
                    <p> Site Designed and developed by <a target="_blank" href="http://selvam.co.in">selvam</a> </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        window.sr = ScrollReveal();
        sr.reveal('.reveal-top', {
            duration: 2000, distance: '100px',
            origin: 'top'
        });
        sr.reveal('.reveal-bottom', {
            duration: 2000, distance: '100px',
            origin: 'bottom'
        });
        sr.reveal('.reveal-left', {
            duration: 2000, distance: '100px',
            origin: 'left'

        });
        sr.reveal('.reveal-right', {
            duration: 2000, distance: '100px',
            origin: 'right'
        });
    </script>

    <script>
        $(function () {
            // Smooth Scrolling
            $('a[href*="#"]:not([href="#"])').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
		$("#confirm").click(function(){
			$("#frmBooking").attr("method","post");
			$("#frmBooking").attr("action","confirm_booking.php?action=<?php echo $para;?>");
			$("#frmBooking").submit();
			
		});
    </script>
    
</body>

</html>