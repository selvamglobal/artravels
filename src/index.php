<?php
session_start();
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
    <meta name="description" content="Book Bus tickets easily online.">
    <link href="https://fonts.googleapis.com/css?family=Faster+One|Roboto:300,400" rel="stylesheet">
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/jquery.datetimepicker.css"/>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand" href="#"> <img src="assets/logo.svg" alt="ART Travels"></a>
     
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

    <div class="pimg1 text-center ">
        <div class="dark-wrapper">
            <div class="ptext">
                <div class="cover-container pb-5">
                    <div class="cover-inner container" style="max-width:600px;">
                            <h1 class="jumbotron-heading reveal-top">Book your tickets!</h1>
                        <form class="text-left reveal-top">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="board_point" class="col-form-label">From</label>
                                    <select class="custom-select form-control" name="board_point" id="board_point">
                                        <option selected>Select a City</option>
                                        <?php
							$mrows1 = Connection::sqlSelect($pdo_connection,"SELECT board_point FROM route GROUP BY board_point");
									if(count($mrows1)>0){
										foreach($mrows1 as $rows1){
											echo '<option value="'.$rows1->board_point.'" >'.$rows1->board_point.'</option>';
											  
										}
									}
							?>
                                      </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="drop_point" class="col-form-label">To</label>
                                    <select class="custom-select form-control" name="drop_point" id="drop_point">
                                        <option selected>Select a City</option>
                                      </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="travel_date" class="col-form-label">Travel Date</label>
                                    <input type="text" class="form-control"  id="travel_date" name="travel_date" placeholder="Choose Date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="return_date" class="col-form-label">Return Date(Optional) </label>
                                    <input type="text" class="form-control" id="return_date" name="return_date" placeholder="Choose Date">
                                </div>

                            </div>

                           <a href="#" class="btn btn-primary" id="btnBook">Book Ticket</a>
                        </form>
                    </div>
                </div>
            </div>
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
  <script src="assets/jquery.datetimepicker.full.js"></script>
    <script>
	$('#travel_date').datetimepicker({
	timepicker:false,
	formatDate:'d.m.Y',
	format:'d/m/Y',
	//defaultDate:'8.12.1986', // it's my birthday
	//defaultDate:'+03.01.1970', // it's my birthday
	timepickerScrollbar:false
});
$('#return_date').datetimepicker({
	timepicker:false,
	formatDate:'d.m.Y',
	format:'d/m/Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	timepickerScrollbar:false
});
	$("#board_point").change(function(){
	 var dataString = 'board_point='+ $("#board_point option:selected" ).val(); 	  
				   $.ajax({
					type: "POST",
					url: "drop_point.php",
					data:dataString,
					success: function(res) {
										
								$("#drop_point").html(res);											
					
						
											}
					  });	
	});
	$("#btnBook").click(function(){
			$var = "board_point="+$("#board_point").val()+"&drop_point="+$("#drop_point").val()+"&travel_date="+$("#travel_date").val()+"&return_date="+$("#return_date").val();
			window.location="select_bus.php?rdir="+window.btoa(unescape(encodeURIComponent($var)));
	});
	</script>
</body>

</html>