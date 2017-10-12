<?php
require_once('../verify_session.php');
if(!isset($_GET['id'])){
	exit;
}
	include_once('connection.php');
	$pdo_connection = Connection::dbConnection();
	if(trim($_GET['id'])<>""){
		$mrows = Connection::sqlSelect($pdo_connection,"UPDATE drop_points SET bus_id=".$_POST['bus_id'].", drop_point=".$_POST['drop_point'].", 
		stop_point='".$_POST['stop_point']."', drop_time='".$_POST['drop_time']."', landmark='".$_POST['landmark']."', address='".addslashes($_POST['address'])."' WHERE id=".$_GET['id']);
		$_SESSION['result'] = '<div class="alert alert-success">
                                <strong>Result:</strong> Updated!
                            </div>';
	}
	else{
		$mrows = Connection::sqlSelect($pdo_connection,"INSERT INTO drop_points (bus_id, drop_point, stop_point,  drop_time,landmark, address) VALUES(".$_POST['bus_id'].", ".$_POST['drop_point'].", '".$_POST['stop_point']."','".$_POST['drop_time']."', '".$_POST['landmark']."', '".addslashes($_POST['address'])."')");
		$_SESSION['result'] = '<div class="alert alert-success">
                                <strong>Result:</strong> Added!
                            </div>';
	}
	
	echo '
	<script>
		window.location="../add_droppingdetails.php";
	</script>
	';
?>