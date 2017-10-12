<?php
session_start();
if(!isset($_GET['id'])){
	header("Location: http://www.arttravels.in");
exit;	
}
$id = explode("&",base64_decode($_GET['id'])); //3&2017-10-04&maxseat&fare&rdate&$avail_seats_from&$avail_seats_to
$request_url = $_SERVER['HTTP_REFERER'];
if(count($id)<4 || !strpos($request_url,"arttravels")){
	header("Location: http://www.arttravels.in");
exit;
}
$title="ART Travels";
$description = "Online bus tickets from tiruppur to chennai, coimbatore to chennai, pollachi to chennai";
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>
    <script src="js/jquery.min.js"></script>
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php
include_once('includes/top_nav.php');
?>
        <div class="pimg1 text-center ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5">
                        <div class="cover-inner container  reveal-top">
                            <h1 class="jumbotron-heading ">Select your seat!</h1>
                            <h6 class="text-light-yellow"> Select your comfortable seat</h6>
                            <br>
                            <h4>
                                <?php
		 $gst = 0;$route_id=0;
		$tdate = explode("-",$id[1]);
								$mrows = Connection::sqlSelect($pdo_connection,"SELECT r.*, b.bus_name, b.bus_type FROM bus b INNER JOIN route r ON b.id=r.bus_id WHERE r.id=".$id[0]);
								if(count($mrows)>0){
										foreach($mrows as $rows){
											echo 'From '.$rows->board_point.' To '.$rows->drop_point.' Date '.$tdate[2]."/".$tdate[1]."/".$tdate[0].' Time '.$rows->board_time.' Bus Type '.$rows->bus_name.' - '.$rows->bus_type.' - '.$id[2];
											$gst = $rows->gst;
											$route_id = $rows->id;
										}
								}
								?>
                            </h4>
                            <div class="row bg-white text-primary">

                                <!-- Left Column-->
                                <div class="col-md-6 text-center p-3 pt-5">
                                    <script>
                                        $(document).ready(function () {
                                            var fruits = [];
                                            var amount = <?php echo $id[3];?>;
                                            $(".seat").click(function () {
                                                var total_class = $('.green').length;
                                                var book_seat = $(this).attr("data-book");
                                                var current_book = $(this).attr("data-current");
                                                if (current_book == 1) {
                                                    var seat_no = $(this).attr("data-number");
                                                    $(this).removeClass('green');
                                                    $(this).removeAttr('data-current');
                                                    fruits.splice(fruits.indexOf(seat_no), 1);
                                                    $(".book_seats").val(fruits);
                                                    $(".amount").val(fruits.length * amount);
                                                    $("#base_fare").html(parseFloat(fruits.length *
                                                        amount).toFixed(2));
                                                    $("#gst").html(parseFloat(parseFloat(fruits.length *
                                                        amount) * parseFloat($(
                                                        "#gstval").val()) / 100).toFixed(2));
                                                   var total_fare = parseFloat(parseFloat(fruits.length * 
                                                            amount) +   parseFloat($("#gst").html()))
                                                    $("#total_fare").html(Math.round(total_fare));
                                                    $("#seattbl_" + seat_no).remove();
                                                    return true;
                                                } else if (book_seat == 1) {
                                                    alert("Already booked");
                                                    return false;
                                                } else if (total_class < 5) {
                                                    var seat_no = $(this).attr("data-number");
                                                    fruits.push(seat_no);
                                                    $(".book_seats").val(fruits);
                                                    $(".amount").val(fruits.length * amount);
                                                    $(this).attr('data-current', '1');
                                                    $(this).addClass('green');
                                                    $("#base_fare").html(parseFloat(fruits.length *
                                                        amount).toFixed(2));
                                                    $("#gst").html(parseFloat(parseFloat(fruits.length *
                                                        amount) * parseFloat($(
                                                        "#gstval").val()) / 100).toFixed(2));
														var total_fare = parseFloat(parseFloat(fruits.length * 
                                                            amount) +   parseFloat($("#gst").html()))
                                                    $("#total_fare").html(Math.round(total_fare));
                                                    $("#seat_info").append(
                                                        '<table class="table" id="seattbl_' +
                                                        seat_no +
                                                        '"><tr><td style="width:80px;">' + seat_no +
                                                        '</td><td style="width:230px;"><input type="text" name="name[]"  placeholder="Name" class="form-control" /></td><td><select name="gender[]" class="form-control" ><option value="1">Male</option><option value="2">Female</option></select></td></tr></table>'
                                                    );
                                                    return true;
                                                } else if (total_class >= 5) {
                                                    alert("Maximum 5 seats only")
                                                    return false;
                                                }
                                            });
                                        });
                                    </script>
                                    <style>
                                        .bus {
                                             width:380px;
                                            min-height: 150px;
                                            padding: 0 0 10px 10px;
                                            margin:0 auto;
                                        }
.bus p{color:#FFF;line-height:16px;font-size:12px;}
                                        .seat {
                                            background: #C7C7C7;
                                            float: left;
                                            margin: 10px 10px 0 0;
                                            cursor: pointer;
                                            padding: 4;
                                        }

                                        .cancel_book {
                                            background: #CCC;
                                        }

                                        .green {
                                            background: green;
                                        }

                                        .red {
                                            background: red;
                                        }
.pink{background:#F0F}
                                        #base_fare,
                                        #gst,
                                        #total_fare {
                                            text-align: right
                                        }
                                    </style>
                                    <div class="bus">
                                        <?php
		//$mrows = Connection::sqlSelect($pdo_connection,"SELECT bd.seat_no, bd.tot_seats FROM route r INNER JOIN booking_details bd ON r.id = bd.route_id  WHERE bd.travel_date='".$id[1]."' AND r.id=".$id[0]);
		$mrows = Connection::sqlSelect($pdo_connection,"SELECT bs.seat_no, bs.gender FROM route r INNER JOIN booking_details bd ON r.id = bd.route_id INNER JOIN booking_seats bs ON bd.booking_id = bs.booking_id WHERE bd.travel_date='".$id[1]."' AND r.id=".$id[0]);
	
		$booked_seat=array();
		$max_seats = $id[2];
		$gender = array();
		if(count($mrows)>0){
										foreach($mrows as $rows){
											//$sno = explode(",",$rows->seat_no);
//											for($i=0;$i<count($sno);$i++){
//												$booked_seat[] = $sno[$i];
//											}											
											$booked_seat[] = $rows->seat_no;
											$gender[$rows->seat_no] = $rows->gender;
										}
		}
		for($s=1;$s<$id[5];$s++){
			$booked_seat[] = $s;
			$gender[$s] = 1;
		}
		for($s=($id[6]+1);$s<=$max_seats;$s++){
			$booked_seat[] = $s;
			$gender[$s] = 1;
		}
		$lower = array("3","6","9","12","15","18");
		$upper = array("21","24","27","30","33","36");
		$seat_nos = array("","1","2","3","7","8","9","13","14","15","19","20","21","25","26","27","31","32","33",
		"6","5","4","12","11","10","18","17","16","24","23","22","30","29","28","36","35","34","","","","","","","");
		
		 for($seat= 1; $seat <=$max_seats ;$seat++) { 
		 $selected_seats = $seat_nos[$seat];
			if(in_array($selected_seats,$booked_seat)){ 
			
				if($gender[$selected_seats]=="2"){ 
				
					$booked="pink"; $book_seat="data-book='1'"; 
				}
				else{
					
				$booked="red"; $book_seat="data-book='1'"; 
				}
			}
			else { $booked=""; $book_seat="";}
			
			if($seat<=18){
				if($seat==1){
					echo '<div style="float:left;border:1px solid #CCC;width:180px;padding:20px;margin-bottom:20px;padding-top:50px;background:url(images/lower.png) center top no-repeat;">';	
				}
				if(in_array($seat,$lower)){ $lpad="width:50px;"; }
				else{$lpad="width:40px;";}
				echo '<div style="'.$lpad.'  float:right;">';
				echo "<div class='seat $booked' data-number='$seat_nos[$seat]' $book_seat style='width:30px;'><img src='images/seat_pos.png' width='20' height='42' title=".$seat_nos[$seat]."><p>L <br>".$seat_nos[$seat]."</p></div>";
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
				echo "<div class='seat $booked' data-number='$seat_nos[$seat]' $book_seat style='width:30px; float:left;'><img src='images/seat_pos.png' width='20' height='42' title=".$seat_nos[$seat]."><p>U <br>".$seat_nos[$seat]."</p></div>";
				echo '</div>';
				if($seat==$max_seats){
					echo '</div>';	
				}
			}
			
			
		 } ?>
                                    </div> 
                                    <img src="assets/bed_available.jpg">
                                    </div>
                                    <!-- right Column-->
                                    <div class="col-md-6 text-left pr-5 pt-5 pb-5">
                                        <form name="frmBooking" id="frmBooking" enctype="multipart/form-data">

                                        <div class="form-group">
                                        <label for="exampleFormControlSelect1">Select your boarding point<sup>*</sup></label>
                                                        <select class="form-control" name="board_point_id" id="board_point_id">
                        	<option value=""> - Boarding Point - </option>
                            <?php
								$mrows = Connection::sqlSelect($pdo_connection,"SELECT bp.* FROM board_points bp INNER JOIN bus b ON bp.bus_id=b.id INNER JOIN route r ON b.id=r.bus_id WHERE r.id=".$id[0]);
								if(count($mrows)>0){
										foreach($mrows as $rows){
											echo '<option value="'.$rows->id.'">'.$rows->pickup_point.' ('.$rows->pickup_time.')</option>';
										}
								}
											
							?>
                        </select> 
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlSelect1">Select your dropping point</label>  <select class="form-control" name="drop_point_id" id="drop_point_id">
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
                                                 </div>
                                              
                                                        <div class="form-group">
                                                            <label class=" control-label">Mobile No.<sup>*</sup></label>
                                                            <input type="text" name="mobile" class="form-control" value=""
                                                                    id="mobile" autocomplete="off"> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="  control-label">Email ID<sup>*</sup></label>
                                                     <input type="text" name="email" class="form-control" value=""
                                                                    id="email" autocomplete="off"> 
                                                        </div>
                                  
                                            <table class="table table-sm">
                                                <tr>
                                                    <th style="width:80px;">Seat No.</th>
                                                    <th style="width:230px;">Name</th>
                                                    <th>Gender</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div id="seat_info">
                                                        </div>
                                                    </td>
                                                </tr>
                                              </table>
                                         
                                         <!--Price-->
                                         <div class="card text-primary text-left">
  <div class="card-body">
   <p m-0 p-0 > Base fare: <span id="base_fare"> </span> </p>
   <p m-0 p-0> GST (<?php echo $gst ;?>%)<input type="hidden" name="gst" id="gstval" value="<?php echo $gst ;?>"> <i  class="fa fa-inr">&nbsp;</i> :<span id="gst"> </span></p>
  <p m-0 p-0>
   Total Fare: <span id="total_fare"> </span> <br>
 </p>
 
   
</div> </div>
<div class="col-md-12 pt-4 pb-0"> <a href="<?php echo $request_url;?>" class="btn btn-primary">Back</a>
                                                        <button type="button" id="confirm" class="btn btn-success pull-right">Confirm</button> </div>  
                                        
                                               

                                            <input type="hidden" name="seats" class="book_seats">
                                            <input type="hidden" name="amount" class="amount">
                                            <?php
$para = base64_encode($route_id."&".$gst."&".$id[1]."&".$id[4]);
?>
                                        </form>
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
            <script>
			function IsEmail(email) {
		  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  return regex.test(email);
	}
	function text_validate(ids){
		var str = $(ids).val();
		var NumberRegex = /^[0-9]*$/;
		if(str.length == 10){
			if(NumberRegex.test(str)){
				return true;
			}
			else{
				return false;	
			}
		}
		else{
			return false;	
		}
			
			
	}
                $("#confirm").click(function () {
					if($("#board_point_id").val().length==0){
					alert('Choose Boarding Point');	
					return false;
					}
					if($("#drop_point_id").val().length==0){
					alert('Choose Dropping Point');	
					return false;
					}
					if(!IsEmail($("#email").val())){
						alert('Enter Valid Email ID');	
					return false;
					}
					if(text_validate("#mobile")==false){
						alert('Enter Valid Mobile Number');	
					return false;
					}
                    $("#frmBooking").attr("method", "post");
                    $("#frmBooking").attr("action", "confirm_booking.php?action=<?php echo $para;?>");
                    $("#frmBooking").submit();
					

                });
            </script>

    </body>

    </html>