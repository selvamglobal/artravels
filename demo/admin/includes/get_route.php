<?php
session_start();
if(!isset($_REQUEST['id']) ){
	exit;
}
	include_once('connection.php');
	$pdo_connection = Connection::dbConnection();
	$mrows = Connection::sqlSelect($pdo_connection,"SELECT * FROM route WHERE bus_id ='".$_REQUEST['id']."' ");
	if(count($mrows)>0){
		foreach($mrows as $rows){
				echo '<option value="'.$rows->id.'"> -'.$rows->board_point.' to '.$rows->drop_point.'</option>';
		}//end foreach
	}
	exit;
?>