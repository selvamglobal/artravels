<?php
require_once('../verify_session.php');
if(!isset($_GET['id'])){
	exit;
}
	include_once('connection.php');
	$pdo_connection = Connection::dbConnection();
	if(trim($_GET['id'])<>""){
		$mrows = Connection::sqlSelect($pdo_connection,"UPDATE bus SET bus_name='".$_POST['bus_name']."', bus_type='".$_POST['bus_type']."', bus_reg_no='".$_POST['bus_reg_no']."', max_seats=".$_POST['max_seats'].", board_point='".$_POST['board_point']."', board_time='".$_POST['board_time']."', drop_point='".$_POST['drop_point']."', drop_time='".$_POST['drop_time']."', avail_seats_from=".intval($_POST['avail_seats_from'])." , avail_seats_to=".intval($_POST['avail_seats_to'])." WHERE id=".$_GET['id']);
		$_SESSION['result'] = '<div class="alert alert-success">
                                <strong>Result:</strong> Updated!
                            </div>';
	}
	else{
		$mrows = Connection::sqlSelect($pdo_connection,"INSERT INTO bus (bus_name, bus_type,  bus_reg_no,max_seats, board_point, board_time,drop_point, drop_time, avail_seats_from, avail_seats_to ) VALUES('".$_POST['bus_name']."', '".$_POST['bus_type']."','".$_POST['bus_reg_no']."', ".$_POST['max_seats'].", '".$_POST['board_point']."', '".$_POST['board_time']."', '".$_POST['drop_point']."', '".$_POST['drop_time']."', ".intval($_POST['avail_seats_from']).", ".intval($_POST['avail_seats_to']).")");
		$_SESSION['result'] = '<div class="alert alert-success">
                                <strong>Result:</strong> Added!
                            </div>';
	}
	
	echo '
	<script>
		 window.location="../add_busdetails.php";
	</script>
	';
?>