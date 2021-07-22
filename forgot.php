<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "includes/db.php";
include "includes/header.php";
include "Classes/Config.php";

require './vendor/autoload.php';


// if (!IfItIsMethod('get') && !isset($_GET['forgot'])) {    ************original

//     redirect('forgot');
// }


if (!isset($_GET['forgot'])) {        //for forgot mailing

    redirect('forgot');
}

// var_dump(IfItIsMethod('post'));
// var_dump(isset($_POST['email']));
// var_dump(email_exists($_POST['email']));
// die;
if (IfItIsMethod('post')) {

    if (isset($_POST['email'])) {

        $email = $_POST['email'];

        $length = 50;

        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if (email_exists($email)) {


            // $stmt = $mysqli->prepare("UPDATE users SET token =? WHERE user_email= ?");
            // $stmt->bind_param("si", $token, $email);
            // $stmt->execute();
            // $stmt->close();

            $query = "UPDATE users SET token={$token} WHERE user_email= $email";
            mysqli_query($connection, $query);


            /**
             * 
             * 
             * configure PHPMailer
             * 
             * 
             * 
             * 
             */

            // $mail = new PHPMailer();

            // $mail->isSMTP();
            // $mail->Host       = Config::SMTP_HOST;
            // $mail->Username   = Config::SMTP_USER;
            // $mail->Password   = Config::SMTP_PASSWORD;
            // $mail->Port       = Config::SMTP_PORT;
            // $mail->SMTPSecure = 'tls';
            // $mail->SMTPAuth   = true;
            // $mail->isHTML(true);
            // $mail->CharSet = 'UTF-8';

            // $mail->setFrom('devjoshi1384@gmail.com', 'Dev Joshi');
            // $mail->addAddress($email);

            // $mail->Subject = 'This is test email';

            $mail = new PHPMailer(true);

            $config = new Config();

            //Enable SMTP debugging.
            $mail->SMTPDebug = 0;
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name                          
            $mail->Host = $config->SMTP_HOST; //"smtp.gmail.com";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password     
            $mail->Username = $config->SMTP_USER; //"acmsexample7@gmail.com";
            $mail->Password = $config->SMTP_PASSWORD; //"ACMSexample7";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = 'tls';
            //Set TCP port to connect to
            $mail->Port = $config->SMTP_PORT; //587;

            $mail->setFrom('devjoshi1384@gmail.com', 'Dev Joshi');
            $mail->addAddress($email);
            $mail->CharSet = 'UTF-8';

            // $mail->From = "acmsexample7@gmail.com";
            // $mail->FromName = "Dev Joshi";
            // $mail->addAddress("acmsexample7@gmail.com", "Dev Joshi Receiver");

            $mail->isHTML(true);


            $mail->Body = '<p>Please click to reset your password


                <a href="https://localhost/CMS/reset.php?email=' . $email . '&token=' . $token . ' ">http://localhost/CMS/reset.php?email=' . $email . '&token=' . $token . '</a>
                
            </p>';

            if ($mail->send()) {

                $emailSent = true;
            } else {

                echo "NOT SENT";
            }
        }
    }
}


?>


<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <?php if (!isset($emailSent)) : ?>


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                            <?php else : ?>

                                <h3>Please check your mailbox for password reset link.</h3>
                                <hr>
                                <a href="/CMS/login" class="btn btn-primary">Login</a>
                                <br>
                                <br>
                                <a href="/CMS/index" class="btn btn-info">Home Page</a>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->