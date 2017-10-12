<?php
session_start();
$title="ART Travels";
$description = "Online bus tickets from tiruppur to chennai, coimbatore to chennai, pollachi to chennai";
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>   <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/jquery.datetimepicker.css" />
    </head>
    <body>
<?php
include_once('includes/top_nav.php');
?>
        <div class="pimg1 text-center ">
            <div class="dark-wrapper">
                <div class="ptext">
                    <div class="cover-container pb-5 pt-5">
                        <div class="cover-inner container reveal-top">
                            <h1 class="jumbotron-heading">Cancellation &amp; Refund policy</h1>
                            <h6 class="text-light-blue">Customer friendly easy cancellation policy.</h6>
                            <div class="card text-primary text-left">
  <div class="card-body">
   <p class="p-2"> 
    
   <h5><strong>ART Travels believes in helping its customers as far as possible, and has therefore a liberal cancellation policy. </strong></h5> Under this policy:
								
    <p>E-tickets can be cancelled ONLY by the user in our site <a href="http://www.arttravels.in">
			 
				www.arttravels.in </a> and online up to 1 hour prior to the 
				preparation of the boarding List (Viz., 1 hr prior to the reporting Time). 
				E-tickets CANNOT be cancelled at our Branch counters
			</p>
			<p>* 
					Deduction of Charges from the reporting time, if this boarding pass cancelled…
			</p>
			<ul style="padding-left:30px;">
				<li type="disc">
					<p>before 24 Hrs       - 15%</p>
				</li>
				<li type="disc">
						<p>24 Hrs to 3 Hr     - 25%</p>
				</li>
				<li type="disc">
					<p>if less than 3 Hr   – No Cancellation &amp; Refund</p>
				</li>
			</ul>
            <br>
			<p>After the cancellation process please ensure by checking your ‘<b>My Account</b>’ 
                in our site, if cancellation was done as desired by you. If the process 
				completed properly then the relevant e-ticket will NOT be available there for 
				cancellation, if it exists then it was not cancelled properly do it again 
				properly.
			</p>
			<p> The E-ticket will not be available 1 hr prior to the Reporting time for printing or cancellation.</p>
			<p><b>Refunds towards bus alterations:</b></p>
			<p>The company holds the rights to cancel / modify any trip. In such circumstances, 
				the full pass amount / difference in bus alteration will be refunded ONLY 
				electronically to the Card account which is used for booking
			</p>
			<p><b>Delay in getting Refund:</b></p>
			<p>To get the refund quickly, customers are advised to cancel their tickets within 
				the prescribed time limits, wherever possible. If you missed to click on 
				Confirm cancellation your occupancy allotment may not be released Hence it will 
				be treated as rendered service and refund will not be eligible for this case. 
				In cases where the tickets are not cancelled within the prescribed time limits, 
				the time taken and amount of refund granted in such cases is dependent on the 
				merit of each case and is to be decided by the Management of ART Tours and  Travels not responsible for delays at the ART Tours &amp; Travels  end in any 
				such case. Amount of refund whenever received from the ART Tours &amp; Travels shall be credited to the customer's account immediately.
			</p>
					                
 
  </div>
</div> 
 
 
 
  
  
 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
 include_once('includes/footer.php');
?>
        
    </body>
    </html>