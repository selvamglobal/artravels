<?php
session_start();
if(!isset($_REQUEST['board_point']) ){
	exit;
}
	include_once('admin/includes/connection.php');
	$pdo_connection = Connection::dbConnection();
	$mrows1 = Connection::sqlSelect($pdo_connection,"SELECT drop_point FROM route WHERE board_point='".$_REQUEST['board_point']."' GROUP BY drop_point");
									if(count($mrows1)>0){
										echo '<option value="0">Select a city</option>';
										foreach($mrows1 as $rows1){
											
												echo '<option>'.$rows1->drop_point.'</option>';
																					
                                            
										}
									}
	
	exit;
?>