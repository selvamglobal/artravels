<?php
require_once('verify_session.php');
if(!isset($_GET['print'])){exit;}
include_once('includes/connection.php');
	$pdo_connection = Connection::dbConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Booking Information - Art Travels</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background:#FFF">

    <div class="wrapper">

   <?php

								  $rdate = array(date('Y-m-d'),date('Y-m-d'));
								 $frmdate = ""; $todate = ""; 
								 $retrive = array(date('d/m/Y'),date('d/m/Y'),'','');
								 $dt_bus = base64_decode($_GET['print']);
								// echo $dt_bus;
								 $dt_bus = explode("&",$dt_bus);
								
									 if($dt_bus[0]<>"" && $dt_bus[1]<>"")
									 $frmdate = explode("/",$dt_bus[0]);
									 $frmto = explode("/",$dt_bus[1]);
									// echo  $frmdate(1).'-'.$frmdate(0).'-'.$frmdate(2);
									 if(count($frmdate)==3 && count($frmto)==3){
										 $retrive[0] = $dt_bus[0]; $retrive[1] =$dt_bus[1];
									 $rdate[0]=date("Y-m-d",mktime(0,0,0,$frmdate[1],$frmdate[0],$frmdate[2]));
									 $rdate[1]=date("Y-m-d",mktime(0,0,0,$frmto[1],$frmto[0],$frmto[2]));
									 }
									
							 ?> 
        <!-- Page Content -->
        
            
                          <div class="row">
                <div class="col-lg-12">
                <div class="col-lg-12">
                   
                                    <?php
									$seats_booked ='';
									$vacant_seats = ''; $available_seats = '';
									$l = array("1","2","3","7","8","9","13","14","15","19","20","21","25","26","27","31");
									$u = array("32","33","6","5","4","12","11","10","18","17","16","24","23","22","30","29","28","36","35","34");
									$mrows = Connection::sqlSelect($pdo_connection,"SELECT bd.*, r.board_point, r.board_time, r.drop_point, r.drop_time, r.fare, r.gst, b.bus_name, b.bus_reg_no, b.bus_type, b.max_seats, b.avail_seats_from, b.avail_seats_to, bp.pickup_point, bp.pickup_time, dp.stop_point , dp.drop_time, bs.seat_no, bs.passenger_name, CASE bs.gender WHEN 1 THEN 'M' WHEN 2 THEN 'F' END AS 'gender' FROM booking_details bd INNER JOIN route r ON bd.route_id=r.id INNER JOIN bus b ON r.bus_id=b.id INNER JOIN board_points bp ON bd.board_point_id= bp.id INNER JOIN drop_points dp ON dp.id=bd.drop_point_id INNER JOIN booking_seats bs ON bd.booking_id=bs.booking_id WHERE CAST(travel_date AS DATE) BETWEEN ('".$rdate[0]."') AND  ('".$rdate[1]."')  AND bd.payment_status = '".$dt_bus[2]."' AND b.id=".$dt_bus[3]);
									if(count($mrows)>0){
										$i=0;$booking_id = 0;$j=0;$head = 0;
										foreach($mrows as $rows){
											if($head==0){
												?>
                                                 <h4 class="page-header"><?php echo $rows->bus_name.' ('.$rows->bus_reg_no.')'.' '.$rows->bus_type; ?> (<em>Travel Date</em>:<?php echo $dt_bus[0];?>)
                    <a class=" pull-right" href="" onClick="return doPrint()">
                              <i class="fa fa-print">&nbsp;</i></a>
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
                                    <tbody>
                                                <?php
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
												?>
                                            <tr>
                           <td class="hidden"><?php echo $rows->id; ?></td>
                            <td class="center"><?php echo $rows->pickup_point.'<br>'.$rows->pickup_time; ?></td>      
                                              
                           <td class="center"><?php echo $rows->stop_point.'<br>'.$rows->drop_time; ?></td>   
                           <td class="center"><?php echo $rows->board_point.'-'.$rows->drop_point; ?></td> 
                           <td><?php echo $rows->booking_id; ?></td>
                          
                          
                          		   
                          
                             
                             <td class="center"><?php echo $rows->net; ?></td>      
                           <td class="center"><?php echo $rows->tot_seats; ?></td> 
                                      <td class="center"><?php echo $rows->mobile; ?></td>     
                                        <td>
                           <?php
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
									?>
                                        
                                        </td> </tr>
                                    </tbody>
                                </table>
                                <table class="table " >
                                    <thead>
                                    <?php
									sort($vs);
										for($z=0;$z<count($vs);$z++){
											if(in_array($vs[$z],$l)){ 
												$vacant_seats .= 'L '.$vs[$z].', ';
												
													echo '<tr><th>'.'L '.$vs[$z].'</th><td></td></tr>';
												
											
												
											}
											else{
												$vacant_seats .= 'U '.$vs[$z].', ';
												
													echo '<tr><th>'.'U '.$vs[$z].'</th><td></td></tr>';
												
											}
										}
										
										
									?>
                                        
                                    </thead>
                                 </table>
                                </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        

    </div>
    <!-- /#wrapper -->
 <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
	function doPrint()
{
   window.print();
}
$("#Seat_Booked").html('<?php echo '<strong>Seat Booked:</strong> '.rtrim(trim($seats_booked),',');?>');
$("#Vacant_Seats").html('<?php echo '<strong>Vacant Seats:</strong> '.rtrim(trim($vacant_seats),',');?>');
    </script>

</body>

</html>

