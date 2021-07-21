<?php session_start(); ?>

<?php
// echo 1;
// die;
session_destroy();
// $_SESSION['username'] = $db_username;
// $_SESSION['user_password'] = $db_user_password;
// $_SESSION['user_firstname'] = $db_user_firstname;
// $_SESSION['user_lastname'] = $db_user_lastname;
// $_SESSION['user_role'] = $db_user_role;

header("Location: /CMS/");

?>