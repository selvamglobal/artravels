<?php
session_start();
if(!isset($_GET['rdir'])){
	header("Location: http://www.artravels.in");
exit;	
}
$rdir = base64_decode($_GET['rdir']);
//echo  $rdir;
$rdir = explode("&",$rdir);
$where = array('',"","","","","","","","");
//board_point=Coimbatore&drop_point=Select a City&travel_date=06/10/2017&return_date=10/10/2017 
for($i=0;$i<count($rdir);$i++){
	$j= explode("=",$rdir[$i]);
	
		$where[$i]=$j[1];
	
	
}
//print_r ($where);
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
//echo "SELECT * FROM bus WHERE board_point='".$where[0]."' AND  drop_point='".$where[1]."'";
include_once('includes/header.php');
?>


<body>
include_once('includes/top_nav.php');
    <div class="container">
 <div class="row">
     <div class="col-md-12">
     	<h2 class="text-success">Select Bus</h2>
     </div>
     <div class="col-lg-12">
     <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                          
                           <th>Bus Name</th>                                                                             
                           
                           <th>Bus Type</th>						   
                           
                           <th>Available</th>                        
                           <th>Route</th>  
                                            
                           <th>Start Time</th>                        
                           <th>Drop Time</th> 
                           <th>Fare</th>       
                           <th width="200px;">Action</th>
                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									
									$mrows = Connection::sqlSelect($pdo_connection,"SELECT r.id, b.bus_name, b.bus_type, b.bus_reg_no, b.max_seats, b.max_seats AS available, r.fare, r.board_point, r.drop_point, r.board_time, r.drop_time  FROM bus b 
									INNER JOIN route r ON b.id = r.bus_id  
																		
									WHERE r.board_point='".$where[0]."' AND  r.drop_point='".$where[1]."' ");
									$booked_seat = 0;
									$tdate = explode("/",$where[2]);//[0]=>d [1]=>m [2]=>Y
									
									if(count($mrows)>0){
										foreach($mrows as $rows){
											$mrows1 = Connection::sqlSelect($pdo_connection,"SELECT sum(tot_seats) AS tot_seats FROM booking_details  WHERE route_id=".$rows->id." AND travel_date='".$tdate[2].'-'.$tdate[1].'-'.$tdate[0]."'  ");
											if(count($mrows1)>0){
										foreach($mrows1 as $rows1){
											$booked_seat = $rows1->tot_seats;
										}
											}
											
											?>
                                            <tr>
                         
                           <td class="center"><?php echo $rows->bus_name." - ".$rows->bus_reg_no." : ".$rows->available.' Seats'; ?></td>                         
                          
                          
                           <td class="center"><?php echo $rows->bus_type; ?></td>						   
                          
                           <td class="center"><?php echo ($rows->available-$booked_seat); ?></td>                         
                           <td class="center"><?php echo $rows->board_point.' - '.$rows->drop_point; ?></td>  
                                                  
                           <td class="center"><?php echo $rows->board_time; ?></td>                         
                           <td class="center"><?php echo $rows->drop_time; ?></td>
                           <td class="center"><i  class="fa fa-inr">&nbsp;</i><?php echo $rows->fare; ?></td>                          
                           <td class="center">	                         
                           		  <?php
								  if(($rows->available-$booked_seat)>0){
									  echo ' <a class="btn btn-sm btn-success show-busgetdetails" onClick="ViewSeats('."'".base64_encode($rows->id)."'".')"  href="#"  data-id="101" id="vs_'.base64_encode($rows->id).'"><i class="fa fa-fw fa-eye"></i> View Seats</a>';
								  }
								  else{
									   echo ' <a class="btn btn-sm btn-default show-busgetdetails" > Sold</a>';
								  }
								  ?>
                        							
                           </td>
                        </tr>
                                            <?php
										}//end for
									}//end if
									?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
     </div>
 </div>
 </div>
<?php
include_once('admin/includes/bottom_contact.php');
include_once('admin/includes/footer.php');
?>    
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
 
</body>

</html>