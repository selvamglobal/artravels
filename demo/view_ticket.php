<?php
session_start();
$title="ART Travels";
$description = "Online bus tickets from tiruppur to chennai, coimbatore to chennai, pollachi to chennai";
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>
    </head>
    <body>
<?php
$page = 'print';
include_once('includes/top_nav.php');
?>
        <div class="pimg1 text-center ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5">
                        <div class="cover-inner container  reveal-top" style="max-width:600px;">
                            <h1 class="jumbotron-heading ">Print / Send / Download your ticket</h1>
                            <h6 class="text-light-blue">Enter your ticket number and your email id.</h6>
                            <form class="text-left mt-5 mb-5" id="frmPrint"  >
  <div class="form-group">
    <label for="exampleInputEmail1">Ticket number<sup>*</sup></label>
    <input type="number" class="form-control is-invalid" id="booking_id" name="booking_id" aria-describedby="emailHelp" placeholder="Enter ticket number">
    <small id="emailHelp" class="form-text text-danger"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email<sup>*</sup></label>
    <input type="email" class="form-control is-valid" id="email" name="email" placeholder="Enter your email" required>
  </div>
   <a href="#"   class="btn btn-lg btn-success" id="print_ticket" >Print ticket</a> 
 <br> <br>
  <button type="button" class="btn btn-lg btn-success">Send to SMS/email</button> <br> <br>
 <!-- <button type="button" class="btn btn-lg btn-success">Download pdf</button>-->
</form>

 
 
  
  
 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
 include_once('includes/footer.php');
?>
        <script>
		function IsEmail(email) {
		  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  return regex.test(email);
	}
	function text_validate(ids){
		var str = $(ids).val();
		var NumberRegex = /^[0-9]*$/;
		if(str.length > 3){
			if(NumberRegex.test(str)){
				return true;
			}
			else{
				return false;	
			}
		}
		else{
			return false;	
		}
			
			
	}
		$("#booking_id").keyup(function(){
            console.log("booked");
					if(text_validate("#booking_id")===false){
						$('#emailHelp').html('Please enter valid ticket number');
						return false;
					}
					$.ajax({
				url: 'includes/chkticket.php',
				type: 'POST',
				data: 'booking_id='+$("#booking_id").val(),
				success: function(result){ 
					if(result>0){
                        
                         
						$("#print_ticket").attr("href",function() {
return  "print_ticket.php?booking_id="+$("#booking_id").val()
}); 
                                               $("#print_ticket").attr("target","_blank");
			
												
					}
					else{
						$('#emailHelp').html('Please enter valid ticket number');
					}
					//return false;
				}
			})
			
		});
		</script>	
    </body>
    </html>