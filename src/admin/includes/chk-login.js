$(document).ready(function(e) {
	$("#password").keypress(function(e){
			var key = e.which;
			if(key==13){
					$("#btnSubmit").click();
					return false;
			}
		});
$('#btnSubmit').click(function(){
		
		 var dataString = 'username='+$("#username").val()+'&password='+$('#password').val(); 	  
				   $.ajax({
					type: "POST",
					url: "includes/login_verify.php",
					data:dataString,
					success: function(res) {
						if(res !=1){
						
								$('.info').html(res);											
						}
						else{
							$('#frmLogin').submit();
						}
										   }
					  });					
   });
		});
		