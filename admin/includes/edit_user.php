<?php

if(isset($_GET['edit_user'])){

$the_user_id = escape($_GET['edit_user']);


$query = "SELECT * FROM users WHERE user_id = $the_user_id";
$select_users_query = mysqli_query($connection , $query);  
while($row=mysqli_fetch_assoc($select_users_query)){

    
$user_id = $row['user_id'];
$username = $row['username'];   
$user_firstname = $row['user_firstname'];

$user_password = $row['user_password'];

$user_lastname = $row['user_lastname'];
$user_email = $row['user_email'];
$user_image = $row['user_image'];
$user_role = $row['user_role'];

}


if(escape(isset($_POST['edit_user']))){

//$user_id = $_POST['user_id'];
$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_role = $_POST['user_role'];

$username = $_POST['username'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
$post_date = date('d-m-y');

    if(!empty($user_password)){

    $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
    $get_user_query = mysqli_query($connection , $query_password);
    confirm($get_user_query);

    $row = mysqli_fetch_array($get_user_query);
    $db_user_password = $row['user_password'];


        if($db_user_password != $user_password){

        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        }

        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = '{$the_user_id}' ";

        $edit_user_query = mysqli_query($connection,$query);
        confirm($edit_user_query);

        echo "User Updated" . " " . "<a href='users.php'>View Users</a>";

    }

}

} else {

    header("Location: index.php");
}

?>

<form action="" method="post" enctype="multipart/form-data" >

<div class="from-group">
<label for="firstName">Firstname</label>
<input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname" >
</div><br>

<div class="from-group">
<label for="lastName">Lastname</label>
<input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname" >
</div><br>

<select name="user_role" id="">


<option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

<?php
if($user_role == 'Admin'){
echo "<option value='Subscriber'>Subscriber</option>";
} else {
echo "<option value='Admin'>Admin</option>";
}

?>


</select>

<div class="from-group">
<label for="username">Username</label>
<input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
</div><br>

<div class="from-group">
<label for="email">Email</label>
<input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email" >
</div><br>

<div class="from-group">
<label for="password">Password</label>
<input autocomplete="off" type="password" class="form-control" name="user_password">
</div><br>

<div class="from-group">
<input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
</div>

</form>