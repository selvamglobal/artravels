<?php
require_once('verify_session.php');
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

<body>

    <div id="wrapper">
 <?php include_once('includes/topnav.php'); ?>
   <?php
								  $rdate = array(date('Y-m-d'),date('Y-m-d'));
								 $frmdate = ""; $todate = ""; $pstatus = 'Success';
								 $retrive = array(date('d/m/Y'),date('d/m/Y'),'',''); $bus_id=1;
								 if(isset($_GET['dtp_From']) && isset($_GET['dtp_To']) && isset($_GET['pstatus']) && isset($_GET['bus_id'])){
									 $pstatus = $_GET['pstatus'];
									 $bus_id = $_GET['bus_id'];
									 if($_GET['dtp_From']<>"" && $_GET['dtp_To']<>"")
									 $frmdate = explode("/",$_GET['dtp_From']);
									 $frmto = explode("/",$_GET['dtp_To']);
									// echo  $frmdate(1).'-'.$frmdate(0).'-'.$frmdate(2);
									 if(count($frmdate)==3 && count($frmto)==3){
										 $retrive[0] = $_GET['dtp_From']; $retrive[1] = $_GET['dtp_To'];
									 $rdate[0]=date("Y-m-d",mktime(0,0,0,$frmdate[1],$frmdate[0],$frmdate[2]));
									 $rdate[1]=date("Y-m-d",mktime(0,0,0,$frmto[1],$frmto[0],$frmto[2]));
									 }
								 }
								
								 ?> 
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Booking Details  <a class="btn btn-info pull-right" href="" onClick="return doPrint()">
                              <i class="fa fa-print">&nbsp;</i>Print</a>	</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <div class="col-lg-12">
                       
                                 		 <form name="frmList" id="frmList" method="get" action=""  role="form" >
                               
                                				 <div class="col-lg-2">
                                                    <label class="control-label">Travel Date From
													</label>
														<input type="text"  class="form-control date-picker"  data-date-format="dd/mm/yyyy"  name="dtp_From" value="<?php echo $retrive[0];?>" id="dtp_From"   autocomplete="off" >
													</div>
                                                     <div class="col-lg-2" style="display:none;visibility:hidden;">
                                                    <label class="control-label">Travel Date To
													</label>
														<input type="text"  class="form-control date-picker"  data-date-format="dd/mm/yyyy"  name="dtp_To"  value="<?php echo $retrive[1];?>" id="dtp_To"  autocomplete="off" >
													</div>
                                                    <div class="col-lg-2">
                                                    <label class="control-label">Payment
													</label>
														<select class="form-control" name="pstatus" id="pstatus">
                                                        <?php
														$pay = array("","","");
														$pay[Connection::paymentStatus($pstatus)]=' selected ';
														
														?>
                                                        	<option value="Success" <?php echo $pay[0];?> >Success</option>
                                                            <option value="Abort" <?php echo $pay[1];?> >Abort</option>
                                                            <option value="Failure" <?php echo $pay[2];?> >Failure</option>
                                                        </select>
													</div>
                                                     <div class="col-lg-2">
                                                    <label class="control-label">Bus
													</label>
														<select class="form-control" name="bus_id" id="bus_id">
                                                        <?php
														$bus_name = '';
														$mrows = Connection::sqlSelect($pdo_connection,"SELECT * FROM bus");
														if(count($mrows)>0){
															foreach($mrows as $rows){
																if($bus_id == $rows->id){
									echo '<option value="'.$rows->id.'" selected >'.$rows->board_point.' - '.$rows->drop_point.' ('.$rows->bus_reg_no.')'.'</option>';								
									$bus_name = $rows->board_point.' - '.$rows->drop_point.' ('.$rows->bus_reg_no.')';
																}
																else{
																echo '<option value="'.$rows->id.'">'.$rows->board_point.' - '.$rows->drop_point.' ('.$rows->bus_reg_no.')'.'</option>';	
																$bus_name = $rows->board_point.' - '.$rows->drop_point.' ('.$rows->bus_reg_no.')';
																}
																
															}
														}
														?>
                                                        </select>
													</div>
                                                    <div class="col-lg-2">
                                                    <label class="control-label">&nbsp;
													</label>
                                                     <button class="form-control btn btn-success" type="submit" name="btnSubmit" >View</button></div>
                                                     </form>
                                                    
                         </div>
                         <div class="col-lg-12">&nbsp;</div>
                         </div>
                          <div class="row">
                <div class="col-lg-12">
                
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3><?php echo $bus_name;?></h3>
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                           <th class="hidden">ID</th>
                           <th>Booking ID</th> 
                           <th>Booking Date</th>	
                           <th>Travel Date</th>					   
                           <th>Bus Name</th> 				   
                           <th>Pickup Point</th> 
                           <th>Drop Point</th>
                           <th>Payment Status</th>						   
                           <th>Amount</th>	
                           <th>Seats</th>
                           <th>Contact No.</th>							   
                          <!-- <th>Action</th> -->
                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$mrows = Connection::sqlSelect($pdo_connection,"SELECT bd.*, r.board_point, r.board_time, r.drop_point, r.drop_time, r.fare, r.gst, b.bus_name, b.bus_reg_no, b.bus_type, b.max_seats, bp.pickup_point, bp.pickup_time, dp.stop_point , dp.drop_time FROM booking_details bd INNER JOIN route r ON bd.route_id=r.id INNER JOIN bus b ON r.bus_id=b.id INNER JOIN board_points bp ON bd.board_point_id= bp.id INNER JOIN drop_points dp ON dp.id=bd.drop_point_id WHERE CAST(travel_date AS DATE)  BETWEEN ('".$rdate[0]."') AND  ('".$rdate[1]."')  AND bd.payment_status = '".$pstatus."' AND b.id = ".$bus_id);
									if(count($mrows)>0){
										foreach($mrows as $rows){
											?>
                                            <tr>
                           <td class="hidden"><?php echo $rows->id; ?></td>
                           <td><?php echo $rows->booking_id; ?></td>
                           <td ><?php echo $rows->booking_date; ?></td>
                            <td ><?php echo $rows->travel_date; ?></td>
                           <td class="center"><?php echo $rows->bus_name.'<br>('.$rows->bus_reg_no.')'.'<br>'.$rows->bus_type.' - '.$rows->max_seats; ?></td>  
                          		   
                           <td class="center"><?php echo $rows->pickup_point.'<br>'.$rows->pickup_time; ?></td>      
                                              
                           <td class="center"><?php echo $rows->stop_point.'<br>'.$rows->drop_time; ?></td>   
                           <td class="center"><?php echo $rows->payment_status; ?></td>    
                             <td class="center"><?php echo $rows->net; ?></td>   
                            
                           <td class="center"><?php echo $rows->seat_no; ?></td> 
                                       
                           
                            <td class="center"><?php echo $rows->mobile; ?></td>    
                                               
                        <!--   <td class="center">	                         
                           		  
                         <a class="btn btn-sm btn-success show-busgetdetails"  href="#"  data-id="101">
                              <i class="fa fa-fw fa-eye"></i> View</a>	
                             						
                           </td> -->
                        </tr>
                                            <?php
										}//end for
									}//end if
									?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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
	
   var href ="print_busbooking.php?print="+window.btoa(unescape(encodeURIComponent($("#dtp_From").val()+"&"+$("#dtp_To").val()+'&'+$('#pstatus').val()+'&'+$('#bus_id').val())));
   var a = document.createElement('a');
							 a.setAttribute('target', '_blank');
							a.href = href;
					document.body.appendChild(a);
					a.click();
					document.body.removeChild(a);
  
   return false;
}
    </script>

</body>

</html>

