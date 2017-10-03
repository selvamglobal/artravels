<?php
session_start();
if(!isset($_REQUEST['username']) && !isset($_REQUEST['password'])){
	echo '0';
	exit;
}
	include_once('connection.php');
	$pdo_connection = Connection::dbConnection();
//	$pass = base64_encode($_REQUEST['password']);
$pass = 'simrose';
	$mrows = Connection::sqlSelect($pdo_connection,"SELECT * FROM admin WHERE username ='".$_REQUEST['username']."' AND BINARY password='".$pass."' ");
	if(count($mrows)>0){
		foreach($mrows as $rows){
				$_SESSION['uname'] = $_REQUEST['username'];
				$_SESSION['pass'] = $_REQUEST['password'];
				$_SESSION['emp_id'] = $rows->id;
				$_SESSION['profile_picture'] = $rows->profile_picture;
				$_SESSION['status'] = $rows->status;
				$_SESSION['user_type'] = $rows->user_type;
				$_SESSION['logdt'] = $rows->logdt;
				$lrows = Connection::sqlSelect($pdo_connection,"UPDATE admin SET logdt ='".date('Y-m-d H:i:s')."' WHERE id=".$rows->id);
				echo '1';
				exit;
		}//end foreach
	}
	else{
		echo 'Invalid Login Information!';
		exit;
	}

?>