<?php
require_once('verify_session.php');
if(isset($_GET['id'])){
	include_once('includes/connection.php');
	$pdo_connection = Connection::dbConnection();
	$mrows = Connection::sqlSelect($pdo_connection,"DELETE FROM board_points WHERE id=".$_GET['id']);
	echo '
	<script>
		window.location="view_boardingdetails.php";
	</script>
	';
	exit;
}
?>