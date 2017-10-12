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

    <title>Add Dropping Information - Art Travels</title>

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
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
</head>

<body>

    <div id="wrapper">
 <?php include_once('includes/topnav.php'); ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Dropping Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
           <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Dropping Info.
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
				 $busInfo = array("","","","","","","","","","","Submit","","","","","");
				 if(isset($_GET['id'])){
				 $mrows = Connection::sqlSelect($pdo_connection,"SELECT bp.* FROM drop_points bp WHERE bp.id=".$_GET['id']);
									if(count($mrows)>0){
										foreach($mrows as $rows){
											  $busInfo[0]=$rows->id;
												$busInfo[1]=$rows->bus_id;                        
												$busInfo[2]=$rows->drop_point; 
												$busInfo[3]=$rows->stop_point; 
												$busInfo[4]=$rows->drop_time;                       
												$busInfo[5]=$rows->landmark;
												$busInfo[6]=$rows->address; 
												$busInfo[10]='Update';
						  				 }
									}
				 }
				  ?>
               <!-- form start -->
			   <form role="form" action="includes/db_adddropping.php?id=<?php echo $busInfo[0];?>" method="post"  class="validate" enctype="multipart/form-data">
                  <div class="box-body">                 
                     <div class="col-md-6">
					     
						<div class="form-group">
                           <label>Bus Name</label>
							<select class="form-control select2"  style="width: 100%;" id="bus_id" name="bus_id" onChange="showRoute();">
                            <option> -Select Bus Name</option>
                            <?php
							$mrows1 = Connection::sqlSelect($pdo_connection,"SELECT * FROM bus ");
									if(count($mrows1)>0){
										foreach($mrows1 as $rows1){
											if($busInfo[1]==$rows1->id){
												echo '<optgroup label="'.$rows1->board_point.' to '.$rows1->drop_point.' ('.$rows1->board_time.' - '.$rows1->drop_time.') ">
   
												<option value="'.$rows1->id.'"  selected > '.$rows1->bus_name.' - '.$rows1->bus_reg_no.'</option>
												 </optgroup>';
											}
											else{
												echo '<optgroup label="'.$rows1->board_point.' to '.$rows1->drop_point.' ('.$rows1->board_time.' - '.$rows1->drop_time.') ">
												<option value="'.$rows1->id.'" > '.$rows1->bus_name.' - '.$rows1->bus_reg_no.'</option> </optgroup>';
											}
											
                                            
										}
									}
							?>
                                 
								                               </select>
                        </div>
	
 			
						
					    <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">New Dropping Point</label>
                           <input type="text" class="form-control required" name="stop_point" value="<?php echo $busInfo[3]; ?>"  data-parsley-trigger="change"	
                           data-parsley-minlength="2" data-parsley-maxlength="15" data-parsley-pattern="^[a-zA-Z0-9\  \/]+$" required="" placeholder="Start Point">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
						
						<div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Landmark</label>
                           <input type="text" class="form-control required" value="<?php echo $busInfo[5];?>" name="landmark" placeholder="Landmark">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
                  
                  <!-- /.box-body -->
                  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
				   </div>
				   <div class="col-md-6">
				   
	                     <div class="form-group">
                          <label>Route</label>
							<select class="form-control select2 subcat"  style="width: 100%;" name="drop_point" id="drop_point">
								   								   <option selected value="0"> -Select</option>
                                                                   <?php
																   if($busInfo[2]<>""){
																	   $mrows2 = Connection::sqlSelect($pdo_connection,"SELECT * FROM route WHERE bus_id =".$busInfo[1]." ");
	if(count($mrows2)>0){
		foreach($mrows2 as $rows2){
			if($busInfo[2]==$rows2->id){
				echo '<option value="'.$rows2->id.'" selected > -'.$rows2->board_point.' to '.$rows2->drop_point.'</option>';
			}
			else{
				echo '<option value="'.$rows2->id.'"> -'.$rows2->board_point.' to '.$rows2->drop_point.'</option>';
			}
				
		}//end foreach
	}
																   }
																   ?>
								                               </select>
                        </div>
						
						
						 <div class="bootstrap-timepicker">
							<div class="form-group">
							  <label>Drop Time</label>
							  <div class="input-group">
								<input type="text"  value="<?php echo $busInfo[4]; ?>" name="drop_time" id="drop_time" class="form-control timepicker">
								<div class="input-group-addon">
								  <i class="fa fa-clock-o"></i>
								</div>
							  </div><!-- /.input group -->
							</div><!-- /.form group -->
						  </div>
						  
						  
						  <div class="form-group has-feedback">
                           <label for="exampleInputEmail1">Address</label>
                           <input type="text" class="form-control required" value="<?php echo $busInfo[6]; ?>" name="address" placeholder="Address">
                           <span class="glyphicon  form-control-feedback"></span>
                        </div>
				   </div>
				   
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
 <script src="js/jquery.datetimepicker.full.js"></script>
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
	
 
 function showRoute(){
	
	 var dataString = 'id='+ $("#bus_id option:selected" ).val(); 	  
				   $.ajax({
					type: "POST",
					url: "includes/get_route.php",
					data:dataString,
					success: function(res) {
										
								$("#drop_point").html(res);											
					
						
											}
					  });					
   
 }
$('#drop_time').datetimepicker({
	datepicker:false,
	format:'h:i a',
	step:5
});
    </script>
<!--time picker-->
</body>

</html>

