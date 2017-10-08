<?php
session_start();
$title="ART Travels";
$description = "Online bus tickets from tiruppur to chennai, coimbatore to chennai, pollachi to chennai";
include_once('admin/includes/connection.php');
$pdo_connection = Connection::dbConnection();
include_once('includes/header.php');
?>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <div class="cover-inner container  reveal-top" style="max-width:600px;">
                            <h1 class="jumbotron-heading ">Book your tickets!</h1>
                            <h6 class="text-light-yellow"> Daily trips from Coimbatore, Tirupur to Chennai and from Chennai to Tirupur, Coimbatore </h6>
                            <form class="text-left">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="board_point" class="col-form-label">From</label>
                                        <select class="form-control" name="board_point" id="board_point">
                                        <option selected>Select a City</option>
                            <?php
							$mrows1 = Connection::sqlSelect($pdo_connection,"SELECT board_point FROM route GROUP BY board_point");
									if(count($mrows1)>0){
										foreach($mrows1 as $rows1){
											echo '<option value="'.$rows1->board_point.'" >'.$rows1->board_point.'</option>';
											  
										}
									}
							?>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="drop_point" class="col-form-label">To</label>
                                        <select class="form-control" name="drop_point" id="drop_point">
                                        <option selected>Select a city</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <i class="fa fa-calendar calendar" aria-hidden="true"></i>
                                        <label for="travel_date" class="col-form-label">Travel date</label>
                                        <input type="" class="form-control" id="travel_date" name="travel_date" placeholder="Choose Date">
                                         </div>
                                    <div class="form-group col-md-6">
                                    <i class="fa fa-calendar calendar" aria-hidden="true"></i>
                                    <label for="return_date" class="col-form-label">Return date(Optional) </label>
                                    <input type="text" class="form-control " id="return_date" name="return_date" placeholder="Choose Date">
                                </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6"> <a href="#" class="btn btn-success btn-lg" id="btnBook">Book ticket</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
include_once('includes/features.php');
include_once('includes/bottom_contact.php');
include_once('includes/footer.php');
?>
        <script src="assets/jquery.datetimepicker.full.js"></script>
        <script>
            $('#travel_date').datetimepicker({
                timepicker: false,
                formatDate: 'd.m.Y',
                format: 'd/m/Y',
                //defaultDate:'8.12.1986', // it's my birthday
                //defaultDate:'+03.01.1970', // it's my birthday
                timepickerScrollbar: false
            });
            $('#return_date').datetimepicker({
                timepicker: false,
                formatDate: 'd.m.Y',
                format: 'd/m/Y',
                //defaultDate:'8.12.1986', // it's my birthday
                defaultDate: '+03.01.1970', // it's my birthday
                timepickerScrollbar: false
            });
            $("#board_point").change(function () {
                var dataString = 'board_point=' + $("#board_point option:selected").val();
                $.ajax({
                    type: "POST",
                    url: "drop_point.php",
                    data: dataString,
                    success: function (res) {

                        $("#drop_point").html(res);


                    }
                });
            });
            $("#btnBook").click(function () {
                $var = "board_point=" + $("#board_point").val() + "&drop_point=" + $("#drop_point").val() +
                    "&travel_date=" + $("#travel_date").val() + "&return_date=" + $("#return_date").val();
                window.location = "select_bus.php?rdir=" + window.btoa(unescape(encodeURIComponent($var)));
            });
        </script>
        <script>
            window.sr = ScrollReveal();
            sr.reveal('.reveal-top', {
                duration: 2000,
                distance: '100px',
                origin: 'top'
            });
            sr.reveal('.reveal-bottom', {
                duration: 2000,
                distance: '100px',
                origin: 'bottom'
            });
            sr.reveal('.reveal-left', {
                duration: 2000,
                distance: '100px',
                origin: 'left'

            });
            sr.reveal('.reveal-right', {
                duration: 2000,
                distance: '100px',
                origin: 'right'
            });
        </script>
    </body>
    </html>