<?php
session_start();
if(!isset($_GET['id'])){
	header("Location: http://www.arttravels.in");
exit;	
}
$id = explode("&",base64_decode($_GET['id'])); //3&2017-10-04&maxseat&fare&rdate
$request_url = $_SERVER['HTTP_REFERER'];
if(count($id)<4 || !strpos($request_url,"arttravels")){
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
 <div class="row">
 <script> 
 $(document).ready(function(){
	var fruits = [];
	var amount = <?php echo $id[3];?>;
	$(".seat").click(function(){
	 var total_class = $('.green').length;
	 var book_seat = $(this).attr("data-book"); 
	 var current_book = $(this).attr("data-current"); 
	 if(current_book == 1 ){	
	 var seat_no = $(this).attr("data-number");
		$(this).removeClass('green');	
		$(this).removeAttr('data-current');		
		fruits.splice( fruits.indexOf(seat_no), 1 );
		$(".book_seats").val(fruits);	
		$(".amount").val( fruits.length * amount );
		$("#base_fare").html(parseFloat(fruits.length * amount).toFixed(2));
		$("#gst").html(parseFloat(parseFloat(fruits.length * amount)*parseFloat($("#gstval").val())/100).toFixed(2));
		$("#total_fare").html(parseFloat(parseFloat(fruits.length * amount)+parseFloat($("#gst").html())).toFixed(2));
		$("#seattbl_"+seat_no).remove();
		return true;
	 }	  
	else if(book_seat == 1){	
		alert("Already booked");
		return false;
	}	
	else if(total_class < 5){ 	
		var seat_no = $(this).attr("data-number");
        fruits.push(seat_no);
		$(".book_seats").val(fruits);
		$(".amount").val( fruits.length * amount );
		$(this).attr('data-current', '1');
		$(this).addClass('green');	
		$("#base_fare").html(parseFloat(fruits.length * amount).toFixed(2));
		$("#gst").html(parseFloat(parseFloat(fruits.length * amount)*parseFloat($("#gstval").val())/100).toFixed(2));
		$("#total_fare").html(parseFloat(parseFloat(fruits.length * amount)+parseFloat($("#gst").html())).toFixed(2));
		$("#seat_info").append('<table class="table" id="seattbl_'+seat_no+'"><tr><td style="width:80px;">'+seat_no+'</td><td style="width:230px;"><input type="text" name="name[]"  placeholder="Name" /></td><td><select name="gender[]"><option value="1">Male</option><option value="2">Female</option></select></td></tr></table>');
		return true;
	}
	else if(total_class >= 5){ 
		alert("Maximum 5 seats only")
		return false;
	}	
	});
});
</script>
<style>
.bus{float:left;min-height:150px;padding:0  0 10px 10px ;margin-left:30px; }
.seat{background:#CCC;float:left;margin:10px 10px 0 0;cursor:pointer;padding:4;}
.cancel_book{background:#CCC;}
.green{background:green;}
.red{background:red;}
#base_fare, #gst, #total_fare{text-align:right}
</style> 
 <div class="bus">
		<?php
		$mrows = Connection::sqlSelect($pdo_connection,"SELECT bd.seat_no, bd.tot_seats FROM route r INNER JOIN booking_details bd ON r.id = bd.route_id WHERE bd.travel_date='".$id[1]."' AND r.id=".$id[0]);
		//echo "SELECT bd.seat_no, bd.tot_seats, b.max_seats FROM route r INNER JOIN bus b ON r.bus_id = b.bus_id LEFT OUTER JOIN booking_details bd ON r.id = bd.route_id WHERE bd.travel_date='".$id[1]."' AND r.id=".$id[0];
		$booked_seat=array();
		$max_seats = $id[2];
		
		if(count($mrows)>0){
										foreach($mrows as $rows){
											$sno = explode(",",$rows->seat_no);
											for($i=0;$i<count($sno);$i++){
												$booked_seat[] = $sno[$i];
											}											
											
										}
		}
		$lower = array("3","6","9","12","15","18");
		$upper = array("21","24","27","30","33","36");
		 for($seat= 1; $seat <=$max_seats ;$seat++) { 
			if(in_array($seat,$booked_seat)){ $booked="red"; $book_seat="data-book='1'"; }
			else { $booked=""; $book_seat="";}
			if($seat<=18){
				if($seat==1){
					echo '<div style="float:left;border:1px solid #CCC;width:180px;padding:20px;margin-bottom:20px;padding-top:50px;background:url(images/lower.png) center top no-repeat;">';	
				}
				if(in_array($seat,$lower)){ $lpad="width:50px;"; }
				else{$lpad="width:40px;";}
				echo '<div style="'.$lpad.'  float:right;">';
				echo "<div class='seat $booked' data-number='$seat' $book_seat style='width:30px;'><img src='images/seat_pos.png' width='20' height='42' title=".$seat."></div>";
				echo '</div>';
				if($seat==18){
					echo '</div>';	
				}
			}
			else{
				if($seat==19){
					echo '<div style="float:left;border:1px solid #CCC;width:180px;padding:20px;padding-top:50px;background:url(images/upper.png) center top no-repeat;">';		
				}
				if(in_array($seat,$upper)){ $lpad="width:50px;"; }
				else{$lpad="width:40px;";}
				echo '<div style="'.$lpad.'  float:right;">';
				echo "<div class='seat $booked' data-number='$seat' $book_seat style='width:30px;'><img src='images/seat_pos.png' width='20' height='42' title=".$seat."></div>";
				echo '</div>';
				if($seat==$max_seats){
					echo '</div>';	
				}
			}
			
			
		 } ?>
	</div>
	
     
     <div class="col-md-6"></div>
 </div>
 <form name="frmBooking" id="frmBooking" enctype="multipart/form-data">
<div class="container">
	<div class="row">
    	<div class="col-lg-6">
        <table class="table table-sm">
         <?php
		 $gst = 0;$route_id=0;
		$tdate = explode("-",$id[1]);
								$mrows = Connection::sqlSelect($pdo_connection,"SELECT r.*, b.bus_name, b.bus_type FROM bus b INNER JOIN route r ON b.id=r.bus_id WHERE r.id=".$id[0]);
								if(count($mrows)>0){
										foreach($mrows as $rows){
											echo '
											<tr><th colspan="2">BOOKING SUMMARY</th></tr>
                <tr>
                	<td>From</td><th>'.$rows->board_point.'</th>
                </tr>
                <tr>
                	<td>To.</td><th>'.$rows->drop_point.'</th>
                </tr>
                <tr>
                	<td>Date</td><th>'.$tdate[2]."/".$tdate[1]."/".$tdate[0].' '.$rows->board_time.'</th>
                </tr>
                <tr>
                	<td>Bus Type</td><th>'.$rows->bus_name.' - '.$rows->bus_type.' - '.$id[2].'</th>
                </tr>
											';
											$gst = $rows->gst;
											$route_id = $rows->id;
										}
								}
								?>
            	
                <tr>
                	<td colspan="2">
                    	<select name="board_point_id">
                        	<option> - Boarding Point - </option>
                            <?php
								$mrows = Connection::sqlSelect($pdo_connection,"SELECT bp.* FROM board_points bp INNER JOIN bus b ON bp.bus_id=b.id INNER JOIN route r ON b.id=r.bus_id WHERE r.id=".$id[0]);
								if(count($mrows)>0){
										foreach($mrows as $rows){
											echo '<option value="'.$rows->id.'">'.$rows->pickup_point.' ('.$rows->pickup_time.')</option>';
										}
								}
											
							?>
                        </select>
                   
                    	<select name="drop_point_id">
                        	<option> - Drop Point - </option>
                            <?php
								$mrows = Connection::sqlSelect($pdo_connection,"SELECT bp.* FROM drop_points bp INNER JOIN bus b ON bp.bus_id=b.id INNER JOIN route r ON b.id=r.bus_id WHERE r.id=".$id[0]);
								if(count($mrows)>0){
										foreach($mrows as $rows){
											echo '<option value="'.$rows->id.'">'.$rows->stop_point.' ('.$rows->drop_time.')</option>';
										}
								}
											
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="2	"><div class="form-group">
                                                            <label class="col-lg-4 control-label">Mobile No.</label>
                                                            <div class="col-lg-8"><input type="text" name="mobile" class="form-control"  value="" id="mobile" autocomplete="off"></div>
                                                        </div>
                                                         <div class="form-group">
                                                            <label class="col-lg-4 control-label">Email ID</label>
                                                            <div class="col-lg-8"><input type="text" name="email" class="form-control"  value="" id="email" autocomplete="off"></div>
                                                        </div></td>
                </tr>
            </table>
            <table class="table table-sm">
            	<tr>
                	<th style="width:80px;">Seat No.</th><th style="width:230px;">Name</th><th>Gender</th>
                </tr>
                <tr>
                	<td colspan="3"><div id="seat_info">

</div></td>
                </tr>
                <tr>
                	<th colspan="2"><span class="pull-right">Base Fare <i  class="fa fa-inr">&nbsp;</i></span></th><td id="base_fare"></td>
                </tr>
                <tr>
                	<th colspan="2"><span class="pull-right">GST (<?php echo $gst ;?>%)<input type="hidden" name="gst" id="gstval" value="<?php echo $gst ;?>"> <i  class="fa fa-inr">&nbsp;</i></span></th><td id="gst"></td>
                </tr>
                <tr>
                	<th colspan="2"><span class="pull-right">Total Fare <i class="fa fa-inr">&nbsp;</i></span></th><td id="total_fare"></td>
                </tr>
                <tr><td colspan="3"><a href="<?php echo $request_url;?>" class="btn btn-primary">Back</a> 
                <button type="button" id="confirm" class="btn btn-success pull-right">Confirm</button></td></tr>
            </table>
        </div>
    </div>
</div>
<input type="hidden" name="seats" class="book_seats">
<input type="hidden" name="amount" class="amount"> 
<?php
$para = base64_encode($route_id."&".$gst."&".$id[1]."&".$id[4]);
?>
</form>
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