<?php include "includes/admin_header.php" ?>


<?php


if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];


    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_profile_query = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_array($select_user_profile_query)) {


        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_password = $row['user_password'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

?>

<?php


if (isset($_POST['edit_user'])) {



    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];



    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE username = '{$username}' ";

    $edit_user_query = mysqli_query($connection, $query);

    confirm($edit_user_query);
}

?>


<div id="wrapper">

    <!-- Navigation -->

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome To Admin
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>


                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="from-group">
                            <label for="firstName">Firstname</label>
                            <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname">
                        </div><br>

                        <div class="from-group">
                            <label for="lastName">Lastname</label>
                            <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname">
                        </div><br>

                        <div class="from-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
                        </div><br>

                        <div class="from-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
                        </div><br>

                        <div class="from-group">
                            <label for="password">Password</label>
                            <input autocomplete="off" type="password" class="form-control" name="user_password">
                        </div><br>

                        <div class="from-group">
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                        </div>

                    </form>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>