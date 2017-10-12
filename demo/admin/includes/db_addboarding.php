<?php
require_once('../verify_session.php');
if(!isset($_GET['id'])){
	exit;
}
	include_once('connection.php');
	$pdo_connection = Connection::dbConnection();
	if(trim($_GET['id'])<>""){
		$mrows = Connection::sqlSelect($pdo_connection,"UPDATE board_points SET bus_id=".$_POST['bus_id'].", board_point=".$_POST['board_point'].", pickup_point='".$_POST['pickup_point']."', pickup_time='".$_POST['pickup_time']."', landmark='".$_POST['landmark']."', address='".addslashes($_POST['address'])."' WHERE id=".$_GET['id']);
		$_SESSION['result'] = '<div class="alert alert-success">
                                <strong>Result:</strong> Updated!
                            </div>';
	}
	else{
		$mrows = Connection::sqlSelect($pdo_connection,"INSERT INTO board_points (bus_id, board_point, pickup_point,  pickup_time,landmark, address) VALUES(".$_POST['bus_id'].", ".$_POST['board_point'].", '".$_POST['pickup_point']."','".$_POST['pickup_time']."', '".$_POST['landmark']."', '".addslashes($_POST['address'])."')");
		$_SESSION['result'] = '<div class="alert alert-success">
                                <strong>Result:</strong> Added!
                            </div>';
	}
	
	echo '
	<script>
		window.location="../add_boardingdetails.php";
	</script>
	';
?>