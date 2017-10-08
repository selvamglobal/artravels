<?php
session_start();
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
								$mrows = Connection::sqlSelect($pdo_connection,"INSERT INTO booking_details(booking_id, board_point_id, drop_point_id, route_id, user_id, seat_no, tot_seats, mobile, email, base_fare, gst, total_fare, discount_coupon, discount_amount, net, booking_date, travel_date, return_date) VALUES('".$booking_id."', ".$_POST['board_point_id'].",  ".$_POST['drop_point_id'].", ".$id[0].", ".$art_user_id.", '".$_POST['seats']."', ".count($_POST['name']).", '".addslashes($_POST['mobile'])."', '".addslashes($_POST['email'])."', ".$_POST['amount'].", ".$id[1].", ".$total_fare.", '', 0, ".$total_fare.", '".date("Y-m-d H:i:s")."', '".$id['2']."', '".$id['3']."')");
								$complete = false;
										for($i=0;$i<count($_POST['name']);$i++) {
											if($_POST["name"][$i]<>""){
												$bsrows = Connection::sqlSelect($pdo_connection,"INSERT INTO booking_seats(booking_id, seat_no, passenger_name, gender) VALUES('".$booking_id."', '".trim($seats[$i])."', '".addslashes($_POST["name"][$i])."', '".$_POST['gender'][$i]."')");
												$complete = true;
											}
											
										}
if($complete){
echo '<script>
		window.location="result.php?bi='.$booking_id.'";
	</script>';	
}
											
							?>
</body>

</html>