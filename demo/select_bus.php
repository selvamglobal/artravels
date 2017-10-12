<?php
session_start();
if(!isset($_GET['rdir'])){
	header("Location: http://www.arttravels.in");
exit;	
}
$rdir = base64_decode($_GET['rdir']);
$rdir = explode("&",$rdir);
$where = array('',"","","","","","","","");
for($i=0;$i<count($rdir);$i++){
	$j= explode("=",$rdir[$i]);
	$where[$i]=$j[1];
}
$title = 'Select Your Bus - Art Travels'; $description = '';
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>
<link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
    </head>

    <body>
        <?php
include_once('includes/top_nav.php');
?>
        <div class="pimg1 text-left ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5 ">
                        <div class="cover-inner container reveal-top">
                            <h1 class="jumbotron-heading ">Select your bus</h1>
                            <h2 class="jumbotron-heading mt-4 "> Coimbatore to Chennai - 13-Oct-2017</h1>
                                <div class="row  text-primary text-left ">
                                    <div class="col-md-12 ">
                                    <div class="table-responsive   bg-white">
                                    <table class="table  text-primary  table-bordered  " id="dataTables-example">
                                        <thead>
                                            <tr class="text-secondary">

                                              

                                                <th>Bus type</th>

                                                <th>Available seats</th>
                                              

                                                <th>Start time</th>
                                                <th>Drop time</th>
                                                <th>Fare</th>
                                                <th width="200px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
									
									$mrows = Connection::sqlSelect($pdo_connection,"SELECT r.id, b.id AS bus_id, b.bus_name, b.bus_type, b.bus_reg_no, b.max_seats, b.max_seats AS available, r.fare, r.board_point, r.drop_point, r.board_time, r.drop_time, r.gst  FROM bus b 
									INNER JOIN route r ON b.id = r.bus_id  
																		
									WHERE r.board_point='".$where[0]."' AND  r.drop_point='".$where[1]."' ");
									$booked_seat = 0;
									$tdate = explode("/",$where[2]);//[0]=>d [1]=>m [2]=>Y
									$tdate = $tdate[2].'-'.$tdate[1].'-'.$tdate[0];
									if($where[3]<>""){
									$rdate = explode("/",$where[3]);//[0]=>d [1]=>m [2]=>Y
									$rdate = $rdate[2].'-'.$rdate[1].'-'.$rdate[0];
									}
									else{
										$rdate = '0000-00-00';	
									}
									if(count($mrows)>0){
										foreach($mrows as $rows){
											$mrows1 = Connection::sqlSelect($pdo_connection,"SELECT sum(tot_seats) AS tot_seats FROM booking_details INNER JOIN route r ON r.id = route_id  WHERE r.bus_id =".$rows->bus_id." AND travel_date='".$tdate."'  ");
											if(count($mrows1)>0){
										foreach($mrows1 as $rows1){
											$booked_seat = $rows1->tot_seats;
										}
											}
											$gst = (intval($rows->fare) * floatval($rows->gst))/100;
											$gst = $gst + intval($rows->fare);
											$total_far = number_format((float)$gst, 2, '.', '')
											?>
                                                <tr>

                                                    


                                                    <td class="center">
                                                        <?php echo $rows->bus_type; ?>
                                                    </td>

                                                    <td class="center">
                                                        <?php echo ($rows->available-$booked_seat); ?>
                                                    </td>
                                                 

                                                    <td class="center">
                                                        <?php echo $rows->board_time; ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo $rows->drop_time; ?>
                                                    </td>
                                                    <td class="center">
                                                        <i class="fa fa-inr">&nbsp;</i>
                                                        <?php echo round($total_far); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php
								 
								  if(($rows->available-$booked_seat)>0){
									  echo '<a class="btn btn-lg btn-success show-busgetdetails" onClick="ViewSeats('."'".base64_encode($rows->id."&".$tdate."&".$rows->available."&".$rows->fare."&".$rdate)."'".')"  href="#"  data-id="101" id="vs_'.base64_encode($rows->id).'"><i class="fa fa-fw fa-eye"></i> View Seats</a>';
								  }
								  else{
									   echo '<a class="btn btn-sm btn- show-busgetdetails" > Sold</a>';
                                  }
                                  echo ' <a class="btn btn-sm btn-link" href="index.php" > Go back </a>'
								  ?>
                                                    </td>
                                                </tr>
                                                <?php
										}//end for
									}//end if
									?>


                                        </tbody>
                                    </table> </div>
                                </div>

                                

                               
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <?php
include_once('includes/features.php');
include_once('includes/footer.php');
?>
        <script>
            function ViewSeats(route_id) {

                window.location = 'select_seat.php?id=' + route_id;

            }
        </script>
    </body>

    </html>