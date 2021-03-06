<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/CMS"><span class="glyphicon glyphicon-home"></span> CMS HOME</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">



                <?php

                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {

                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];


                    $category_class = '';

                    $registration_class = '';

                    $contact_class = '';

                    $login_class = '';

                    $pageName = basename($_SERVER['PHP_SELF']);

                    $registration = 'registration.php';

                    $contact = 'contact.php';

                    $login = 'login.php';

                    if (isset($_GET['category']) && $_GET['category'] == $cat_id) {

                        $category_class = 'active';
                    } else if ($pageName == $registration) {

                        $registration_class = 'active';
                    } else if ($pageName == $contact) {

                        $contact_class = 'active';
                    } else if ($pageName == $login) {

                        $login_class = 'active';
                    }



                    echo    "<li class='$category_class'>
                        <a href='/CMS/category/{$cat_id}'>{$cat_title}</a>
                        </li>";
                }

                ?>


                <?php

                if (IsLoggedIn()) :
                ?>


                    <li>
                        <a href="/CMS/admin"><span class="glyphicon glyphicon-user"></span> Admin</a>
                    </li>



                <?php else :
                ?>

                    <li class='<?php echo $login_class; ?>'>
                        <a href="/CMS/login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                    </li>

                    <li class='<?php echo $registration_class; ?>'>
                        <a href="/CMS/registration"><span class="glyphicon glyphicon-user"></span> Registration</a>
                    </li>


                <?php endif;
                ?>

                <li class='<?php echo $contact_class; ?>'>
                    <a href="/CMS/contact"><span class="glyphicon glyphicon-phone-alt"></span> Contact</a>
                </li>


                <?php

                if (isset($_SESSION['user_role'])) {

                    if (isset($_GET['p_id'])) {
                        $the_post_id = $_GET['p_id'];
                        echo "<li><a href='/CMS/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                    }
                }

                ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>