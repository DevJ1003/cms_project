<?php

include "includes/db.php";
include "includes/header.php";


if (isset($_POST['submit'])) {

    $to         = "acmsexample7@gmail.com";
    $subject    = wordwrap($_POST['subject'], 70);
    $body       = $_POST['body'];
    $from       = $_POST['email'];
    $header     = "From: " . $from;
    mail($to, $from, "$subject", $body, $header);
}


/* Navigation */

include "includes/navigation.php";

?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <div class="text-center">
                            <h1><span class="glyphicon glyphicon-phone-alt"></span> Contact</h1>
                        </div>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter You Email">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <hr>

    <?php include "includes/footer.php"; ?>