<?php
/**
 * This example shows how to handle a simple contact form.
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');
 
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    $mail->isSMTP();
        $mail->Host = "smtp.sendgrid.net";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = "apikey";
        $mail->Password = "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";
     $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    // $mail->Port = 465;
    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('arun@arttravels.in', 'ART Tour & Travels');
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addAddress('kamalakannan.pm@gmail.com ', 'John Doe');
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'ART Travels';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Email: {$_POST['exampleInputEmail1']}
Password: {$_POST['exampleInputPassword1']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
   
    //SMS Server
    $mobileNo=919944452225;
   // $message = urlencode($_POST['message']);
    $message = "Your account created - by ART Travels";
    $authKey = "178345AJsFi1TeNMok59d9234f";
    $senderId = "ARTTRV";
    $route = "4";
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNo,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route,
        'country'=>'0'
    );
    $url="https://control.msg91.com/api/sendhttp.php";
    $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
     if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);
}

?>

    <?php
include_once('includes/header.php');
?>
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
                        <div class="cover-inner container  reveal-top" style="max-width:600px;">
                            <h1 class="jumbotron-heading ">Sign in</h1>
                            <h6 class="text-light-blue"> You can manage your ticket easily by signing into your account! </h6>
                            <?php if (!empty($msg)) {
    echo "<h2>$msg</h2>";
} ?>
                            <form method="POST" class="mt-5 mb-5">
                                <div class="form-group">
                                    <label for="name">Name: </label>
                                    <input class="form-control" type="text" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address: </label>
                                    <input class="form-control" type="email" name="email" id="email">
                                </div>
                                <br>
                                <input type="submit" class="btn btn-lg btn-success" value="Sign up">
                            </form>



                            <p class="text-left">
                                <a class="text-danger" href="forgot_password.php"> Forgot your password?</a>
                            </p>
                            <p class="text-left">
                                <a href="sign_up.php" class="text-white"> New user? Create your account!</a>
                            </p>



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