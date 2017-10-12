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

    <title>Add Bus Information - Art Travels</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
 <link href="js/jquery-ui.css" rel="stylesheet">
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
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Bus Management Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
           <div class="panel panel-default">
                        <div class="panel-heading">
                            Bus Info.
                        </div>
                        <div class="panel-body">
                            <div class="row">
                            <div class="col-lg-12">
                            <?php
								if(isset($_SESSION['result'])){
									echo $_SESSION['result'];
									unset($_SESSION['result']);	
								}				
							?>
                            </div>
                                <div class="col-lg-12">
                                 <?php
				 $busInfo = array("","","","","","","","","","Submit","","","","","");
				 if(isset($_GET['id'])){
				  $mrows = Connection::sqlSelect($pdo_connection,"SELECT * FROM bus WHERE id=".$_GET['id']);
									if(count($mrows)>0){
										foreach($mrows as $rows){
											  $busInfo[0]=$rows->id;
												$busInfo[1]=$rows->bus_name;                        
												$busInfo[2]=$rows->bus_reg_no; 
												$busInfo[3]=$rows->bus_type; 
												$busInfo[4]=$rows->max_seats;                       
												$busInfo[5]=$rows->board_point; 
												$busInfo[7]=$rows->board_time; 
												$busInfo[6]=$rows->drop_point; 
												$busInfo[8]=$rows->drop_time;
												$busInfo[9]='Update';
												$busInfo[10]=$rows->avail_seats_from; 
												$busInfo[11]=$rows->avail_seats_to;
												
						  				 }
									}
				 }
				  ?>
               <!-- form start -->
			    <form role="form" action="includes/db_addbus.php?id=<?php echo $busInfo[0];?>" method="post"  class="validate" enctype="multipart/form-data">
                 
                     <div class="col-md-6">
                        <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Bus Name</label>
                            <input type="text" class="form-control required" data-parsley-trigger="change"	
                            data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z\  \/]+$" required="" name="bus_name"  placeholder="Bus Name" value="<?php echo $busInfo[1];?>" >
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>         
						
					   <div class="form-group">
                        <label>Bus Type</label>
							<select class="form-control select2 required"  style="width: 100%;" name="bus_type">
                           <option value="<?php echo $busInfo[3];?>"> - <?php echo $busInfo[3];?></option>
								   								   <option value="Semi Sleepre Non AC"> - Semi Sleeper Non AC</option>								  
								   								   <option value="Semi Sleeper AC"> - Semi Sleeper AC</option>								  
								   								   <option value="Sleeper Non AC"> - Sleeper Non AC</option>								  <option value="Sleeper AC"> - Sleeper AC</option>
								                               </select>
                       </div>
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Start Point</label>
                           <input type="text" class="form-control required" name="board_point" data-parsley-trigger="change"	
                           data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required="" placeholder="Start Point" value="<?php echo $busInfo[5];?>" >
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
						
						 <div class="bootstrap-timepicker">
							<div class="form-group">
							  <label>Start Time</label>
							  <div class="input-group">
								<input type="text" name="board_time" class="form-control timepicker" value="<?php echo $busInfo[7];?>">
								<div class="input-group-addon">
								  <i class="fa fa-clock-o"></i>
								</div>
							  </div><!-- /.input group -->
							</div><!-- /.form group -->
						  </div>
						 

						
					    <div class="box-footer">
                     <button type="submit" class="btn btn-primary"><?php echo $busInfo[9];?></button>
                  </div>             
                        </div>                   
                   <div class="col-md-6">
				   
				      	<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Bus Register Number</label>
                           <input type="text" class="form-control required" name="bus_reg_no" data-parsley-trigger="change"	
                           data-parsley-minlength="2" data-parsley-maxlength="15" required="" placeholder="Bus Register Number" value="<?php echo $busInfo[2];?>">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                           <label for="max_seats">Maximum Seats</label> &nbsp;<label for="avail_seats_from">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Available Seats From</label>&nbsp;<label for="avail_seats_from">&nbsp;&nbsp;Seats To</label><br>
                           <input type="text" class="form-control required" name="max_seats" id="max_seats" data-parsley-trigger="change" required="" placeholder="Maximum Seats" value="<?php echo $busInfo[4];?>" style="width:150px; float:left;padding-right:5px;">
                           <input type="text" class="form-control required" name="avail_seats_from" id="avail_seats_from" data-parsley-trigger="change" required="" placeholder="Seats From" value="<?php echo $busInfo[10];?>" style="width:150px;float:left;">
                           <input type="text" class="form-control required" name="avail_seats_to" id="avail_seats_to" data-parsley-trigger="change" required="" placeholder="Seats To" value="<?php echo $busInfo[11];?>" style="width:150px;">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>  
						
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">End Point</label>
                           <input type="text" class="form-control required" name="drop_point" data-parsley-trigger="change"	
                           data-parsley-minlength="2" data-parsley-maxlength="15" required="" placeholder="End Point" value="<?php echo $busInfo[6];?>" >
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
						
						  <div class="bootstrap-timepicker">
							<div class="form-group">
							  <label>Arrival Time</label>
							  <div class="input-group">
								<input type="text" name="drop_time" class="form-control timepicker"  value="<?php echo $busInfo[8];?>" >
								<div class="input-group-addon">
								  <i class="fa fa-clock-o"></i>
								</div>
							  </div><!-- /.input group -->
							</div><!-- /.form group -->
						  </div>
                  <!-- /.box-body -->
                 		
				  </div>
               </form>
            </div></div></div>
            </div><!-- end panel -->
            <!-- /.box -->
         </div>
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
 <script src="js/jquery-ui.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
	function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
     if(job!=true)
    {
        return false;
    }
}
    </script>
<script>
	 $(function () {
	   $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
    <script>
   $(function () {
    $( "#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
     $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
	<!--time picker-->
<!--Cancellation Time Picker-->	
	<script>
	 $(function () {
	   $("#timepicker_cancellation").timepicker({
          showInputs: false,
		  //defaultTime: false,
		  showMeridian: false,
		 /* $('#timepicker_cancellation').timepicker({
                minuteStep: 1,
                template: 'modal',
                appendWidgetTo: 'body',
                //showSeconds: false,
                //showMeridian: false,
                defaultTime: false
            });*/
		  
		  
		  
		  
		  
        });
 });
    </script>
<!--time picker-->
</body>

</html>

