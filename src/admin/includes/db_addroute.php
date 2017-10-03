<?php
require_once('../verify_session.php');
if(!isset($_GET['id'])){
	exit;
}
	include_once('connection.php');
	$pdo_connection = Connection::dbConnection();
	if(trim($_GET['id'])<>""){
		$mrows = Connection::sqlSelect($pdo_connection, "UPDATE route SET bus_id=".$_POST['bus_id'].", board_point='".$_POST['board_point']."' , board_time='".$_POST['board_time']."', drop_point='".$_POST['drop_point']."', drop_time='".$_POST['drop_time']."', fare='".$_POST['fare']."' WHERE id=".$_GET['id']);
		$_SESSION['result'] = '<div class="alert alert-success">
                                <strong>Result:</strong> Updated!
                            </div>';
	}
	else{
		$mrows = Connection::sqlSelect($pdo_connection, "INSERT INTO route (bus_id, board_point, board_time, drop_point, drop_time, fare) VALUES(".$_POST['bus_id'].", '".$_POST['board_point']."', '".$_POST['board_time']."', '".$_POST['drop_point']."', '".$_POST['drop_time']."', '".$_POST['fare']."')");
		$_SESSION['result'] = '<div class="alert alert-success">
                                <strong>Result:</strong> Added!
                            </div>';
	}
	
	echo '
	<script>
		window.location="../add_routedetails.php";
	</script>
	';
?>