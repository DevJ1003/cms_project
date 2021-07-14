<?php


if(escape(isset($_POST['create_user']))){


//$user_id = $_POST['user_id'];
$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_role = $_POST['user_role'];

//$post_image = $_FILES['image']['name'];
//$post_image_temp = $_FILES['image']['tmp_name'];

$username = $_POST['username'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
//$post_date = date('d-m-y');

/*      move_uploaded_file($post_image_temp , "../images/$post_image");              */


$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));


$query = "INSERT INTO users(user_firstname , user_lastname , user_role , username , user_email , user_password) ";
$query.= "VALUES('{$user_firstname}' , '{$user_lastname}' , '{$user_role}' , '{$username}' , '{$user_email}' , '{$user_password}') ";
$create_user_query = mysqli_query($connection , $query);
confirm($create_user_query);
echo "User Created:" . " " , "<a href='users.php'>View Users</a>";

}


?>


<form action="" method="post" enctype="multipart/form-data" >

<div class="from-group">
<label for="firstName">Firstname</label>
<input type="text" class="form-control" name="user_firstname" >
</div><br>

<div class="from-group">
<label for="lastName">Lastname</label>
<input type="text" class="form-control" name="user_lastname" >
</div><br>

<select name="user_role" id="">


<option value="admin">Select Options</option>
<option value="admin">Admin</option>
<option value="subscriber">Subscriber</option>


</select>


<!-- 

<div class="from-group">
<label for="post image">Post Image</label>
<input type="file" name="image">
</div><br>      -->


<div class="from-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username">
</div><br>

<div class="from-group">
<label for="email">Email</label>
<input type="email" class="form-control" name="user_email" >
</div><br>

<div class="from-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="user_password">
</div><br>

<div class="from-group">
<input class="btn btn-primary" type="submit" name="create_user" value="Add User">
</div>

</form>