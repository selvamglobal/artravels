<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(!isset($_GET['action'])){
	header("Location: http://www.arttravels.in");
exit;	
}
$id = explode("&",base64_decode($_GET['action'])); //$route_id."&".$gst."&".$id[1]."&".$id[4]
if(count($id)<2){
	header("Location: http://www.arttravels.in");
exit;
}
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
$request_url = $_SERVER['HTTP_REFERER'];
$booking_id = rand(10000,9999999);
$art_user_id=0;
if(isset($_SESSION['art_user_id'])){
	$art_user_id = $_SESSION['art_user_id'];
}
$total_fare = number_format((float)(floatval($_POST['amount'])*floatval($id[1]))/100, 2, '.', '');
$total_fare +=floatval($_POST['amount']); 
$seats = explode(",",$_POST['seats']);
?>
<body>
<div style="width:350px; margin:0 auto; padding:10%"><img src="images/ajaxloader.gif"></div>
    <?php
								$mrows = Connection::sqlSelect($pdo_connection,"INSERT INTO booking_details(booking_id, board_point_id, drop_point_id, route_id, user_id, seat_no, tot_seats, mobile, email, base_fare, gst, total_fare, discount_coupon, discount_amount, net, booking_date, travel_date, return_date, payment_status) VALUES('".$booking_id."', ".$_POST['board_point_id'].",  ".$_POST['drop_point_id'].", ".$id[0].", ".$art_user_id.", '".$_POST['seats']."', ".count($_POST['name']).", '".addslashes($_POST['mobile'])."', '".addslashes($_POST['email'])."', ".$_POST['amount'].", ".$id[1].", ".$total_fare.", '', 0, ".$total_fare.", '".date("Y-m-d H:i:s")."', '".$id['2']."', '".$id['3']."', 'Success')");
								$complete = false;
										for($i=0;$i<count($_POST['name']);$i++) {
											if($_POST["name"][$i]<>""){
												$bsrows = Connection::sqlSelect($pdo_connection,"INSERT INTO booking_seats(booking_id, seat_no, passenger_name, gender) VALUES('".$booking_id."', '".trim($seats[$i])."', '".addslashes($_POST["name"][$i])."', '".$_POST['gender'][$i]."')");
												$complete = true;
											}
											
										}
if($complete){
require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
$msg = '';
//Don't run this unless we're handling a form submission

  //  date_default_timezone_set('Etc/UTC');
 
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    $mail->isSMTP();
        $mail->Host = "smtp.sendgrid.net";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = "apikey";
        $mail->Password = "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";
     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    // $mail->Port = 465;
    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('arun@arttravels.in', 'ART Tour & Travels');
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addAddress($_POST['email'], 'John Doe');
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'ART Travels';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
echo '<div class="col-lg-12">
                <div class="col-lg-12">
                   ';
									$seats_booked ='';
									$vacant_seats = ''; $available_seats = '';
									$l = array("1","2","3","7","8","9","13","14","15","19","20","21","25","26","27","31");
									$u = array("32","33","6","5","4","12","11","10","18","17","16","24","23","22","30","29","28","36","35","34");
									$mrows = Connection::sqlSelect($pdo_connection,"SELECT bd.*, r.board_point, r.board_time, r.drop_point, r.drop_time, r.fare, r.gst, b.bus_name, b.bus_reg_no, b.bus_type, b.max_seats, b.avail_seats_from, b.avail_seats_to, bp.pickup_point, bp.pickup_time, dp.stop_point , dp.drop_time, bs.seat_no, bs.passenger_name, CASE bs.gender WHEN 1 THEN 'M' WHEN 2 THEN 'F' END AS 'gender' FROM booking_details bd INNER JOIN route r ON bd.route_id=r.id INNER JOIN bus b ON r.bus_id=b.id INNER JOIN board_points bp ON bd.board_point_id= bp.id INNER JOIN drop_points dp ON dp.id=bd.drop_point_id INNER JOIN booking_seats bs ON bd.booking_id=bs.booking_id WHERE bd.booking_id='".$booking_id."'");
									if(count($mrows)>0){
										$i=0;$booking_id = 0;$j=0;$head = 0;
										foreach($mrows as $rows){
											if($head==0){
												echo' <h4 class="page-header">'.$rows->bus_name.' ('.$rows->bus_reg_no.')'.' '.$rows->bus_type.'(<em>Travel Date</em>:'.$rows->travel_date.')
                   </a>
                    </h4>
                    <p id="Seat_Booked"></p>
                    <p id="Vacant_Seats"></p>
                    </div> <div class="col-lg-12">
                    <table class="table table-bordered " >
                                    <thead>
                                        <tr>
                           <th class="hidden">ID</th>
                           				   
                           <th>Pickup Point</th> 
                           <th>Drop Point</th>
                           <th>Source - Destination</th>
                           <th>Booking ID</th> 
                          				   
                          
                           					   
                           <th>Fare</th>	
                           <th>No.of. Seats</th>
                           <th>Contact No.</th>
                           <th>Passenger Info.</th>	
                        </tr>
                                    </thead>
                                    <tbody>';
						for($x= $rows->avail_seats_from;$x<= $rows->avail_seats_to;$x++){//10 - 25
							  
									   $available_seats .=$x.', ';
						   }
						   $vs = explode(",",rtrim(trim($available_seats),","));
											$head ++;	
											}
											if($booking_id <> $rows->booking_id){//0 <> 1000 || 1000 <>`1001
												
													$booking_id = $rows->booking_id;//1000=1000
													if($i<>0){
														echo '</td></tr>';	
													}
												echo '
                                            <tr>
                           <td class="hidden">'.$rows->id.'</td>
                            <td class="center">'. $rows->pickup_point.'<br>'.$rows->pickup_time.'</td>      
                                              
                           <td class="center">'.$rows->stop_point.'<br>'.$rows->drop_time.'</td>   
                           <td class="center">'.$rows->board_point.'-'.$rows->drop_point.'</td> 
                           <td>'.$rows->booking_id.'</td>
                          
                          
                          		   
                          
                             
                             <td class="center">'.$rows->net.'</td>      
                           <td class="center">'.$rows->tot_seats.'</td> 
                                      <td class="center">'.$rows->mobile.'</td>     
                                        <td>';
						   $i++;
						   $seat_no = $rows->seat_no;
						   echo $rows->passenger_name.' ('.$rows->gender.') - ';
						   
						   if(in_array($seat_no,$l)){ 
						   	echo 'L '.$seat_no;
							$seats_booked .= 'L '.$seat_no.', ';
								
						   }
						   else{
							   echo 'U '.$seat_no;
							   $seats_booked .= 'U '.$seat_no.', ';
						   }
						   
							   $key = array_search($seat_no, $vs);
								if (false !== $key) {
									unset($vs[$key]);
								}
						   
						  		 echo '<br>'; 
											}
											else{
												
												
						   $seat_no = $rows->seat_no;
						   echo $rows->passenger_name.' ('.$rows->gender.') - ';
						   if(in_array($seat_no,$l)){ 
						   	echo 'L '.$seat_no;
							$seats_booked .= 'L '.$seat_no.', ';
						   }
						   else{
							   echo 'U '.$seat_no;
							   $seats_booked .= 'U '.$seat_no.', ';
						   }
						   $key = array_search($seat_no, $vs);
								if (false !== $key) {
									unset($vs[$key]);
								}
											}
						   ?>
                          
                                               
                          
                       
                                            <?php
										}//end for
									}//end if
									
                                    echo '    
                                        </td> </tr>
                                    </tbody>
                                </table>
                                
                                </div>
                </div>';
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
   
    //SMS Server
    $mobileNo=$_POST['mobile'];
   // $message = urlencode($_POST['message']);
    $message = "Your account created - by ART Travels";
    $authKey = "178345AJsFi1TeNMok59d9234f";
    $senderId = "ARTTRV";
    $route = "4";
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNo,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route,
        'country'=>'0'
    );
    $url="https://control.msg91.com/api/sendhttp.php";
    $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
     if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);


	
	
	
echo '<script>
		window.location="result.php?bi='.$booking_id.'";
	</script>';	
}
											
							?>
</body>

</html>