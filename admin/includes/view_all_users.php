<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit User</th>
            <th>Delete User</th>
        </tr>
    </thead>



    <?php


    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {


        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];


        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";

        echo "<td><a class='btn btn-info' href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
        echo "<td><a class='btn btn-success' href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
        echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
        echo "<td><a class='btn btn-danger' href='users.php?delete={$user_id}'>Delete</a></td>";
        echo "</tr>";
    }


    if (escape(isset($_GET['change_to_admin']))) {

        $the_user_id = $_GET['change_to_admin'];


        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $the_user_id ";
        $change_to_admin_query = mysqli_query($connection, $query);

        header("Location: users.php");
    }


    if (escape(isset($_GET['change_to_sub']))) {

        $the_user_id = $_GET['change_to_sub'];


        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $the_user_id ";
        $change_to_sub_query = mysqli_query($connection, $query);

        header("Location: users.php");
    }


    if (escape(isset($_GET['delete']))) {

        if (isset($_SESSION['user_role'])) {

            $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);

            $query = "DELETE FROM users where user_id = $the_user_id ";
            $delete_user_query = mysqli_query($connection, $query);

            header("Location: users.php");
        }
    }


    ?>