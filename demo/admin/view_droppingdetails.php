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

    <title>Drop Information - Art Travels</title>

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
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Drop Point Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Drop Point Info.
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                           <th class="hidden">ID</th>
                           <th>Bus Name</th>
                           <th>Bus Type</th>
                            <th>Route</th>						   
                           <th>Drop Point</th>                       
                           <th>Drop Time</th>               
                           <th>Address</th>  
                           <th width="200px;">Action</th>
                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$mrows = Connection::sqlSelect($pdo_connection,"SELECT dp.id,  dp.stop_point , dp.drop_time, dp.landmark, dp.address, b.bus_reg_no, b.bus_name, b.bus_type, r.board_point, r.board_time, r.drop_point FROM drop_points dp INNER JOIN bus b ON dp.bus_id=b.id 
									INNER JOIN route r ON dp.drop_point=r.id");
									if(count($mrows)>0){
										foreach($mrows as $rows){
											?>
                                            <tr>
                           <td class="hidden"><?php echo $rows->id; ?></td>
                           <td class="center"><?php echo $rows->bus_name.'<br>(Time: '.$rows->bus_reg_no.')'; ?></td>  
                          
                           <td class="center"><?php echo $rows->bus_type; ?></td>	
                           	 <td class="center"><?php echo $rows->drop_point; ?></td>				   
                           <td class="center"><?php echo $rows->stop_point; ?></td>                         
                           <td class="center"><?php echo $rows->drop_time; ?></td>                         
                           <td class="center"><?php echo $rows->address; ?></td>                        
                           <td class="center">	                         
                           		  
                         <a class="btn btn-sm btn-success show-busgetdetails"  href="add_droppingdetails.php?id=<?php echo $rows->id; ?>"  data-id="101">
                              <i class="fa fa-fw fa-eye"></i> View / Edit</a>	
                              <a class="btn btn-sm btn-danger" href="delete_dropping.php?id=<?php echo $rows->id; ?>" onClick="return doconfirm()">
                              <i class="fa fa-fw fa-trash"></i>Delete</a>							
                           </td>
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
	function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
     if(job!=true)
    {
        return false;
    }
}
    </script>

</body>

</html>

