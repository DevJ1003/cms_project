<?php

/***** DATABASE HELPER FUNCTIONS *****/

function redirect($location)
{

     return header("Location:" . $location);
     exit;
}


function query($query)
{

     global $connection;
     $result =  mysqli_query($connection, $query);
     confirm($result);
     return $result;
}


function fetchRecords($result)
{

     return mysqli_fetch_array($result);
}



function countRecords($result)
{
     return mysqli_num_rows($result);
}


/***** END DATABASE HELPER FUNCTIONS *****/




/***** GENERAL HELPERS *****/

function get_user_name()
{
     if (isset($_SESSION['username'])) {

          return $_SESSION['username'];
     }
}

/*****  END GENERAL HELPERS *****/




/***** AUTHENTICATION HELPER FUNCTIONS *****/

function is_admin()
{

     global $connection;

     if (IsLoggedIn()) {

          $result = query("SELECT user_role FROM users WHERE user_id = " . $_SESSION['user_id'] . "");
          $row = fetchRecords($result);

          if ($row['user_role'] == 'Admin') {

               return true;
          } else {

               return false;
          }
     }
}




/***** END AUTHENTICATION HELPER FUNCTIONS *****/



/***** USER SPECIFIC HELPER FUNCTIONS *****/


function get_all_user_posts()
{
     $result = query("SELECT * FROM posts WHERE user_id=" . logggedInUserId() . "");
     return $result;
}



function get_all_user_category()
{

     $result = query("SELECT * FROM categories WHERE user_id=" . logggedInUserId() . "");
     return $result;
}



function get_all_user_published_posts()
{

     $result = query("SELECT * FROM posts WHERE user_id=" . logggedInUserId() . " AND post_status='Published'");
     return $result;
}



function get_all_user_draft_posts()
{

     $result = query("SELECT * FROM posts WHERE user_id=" . logggedInUserId() . " AND post_status='Draft'");
     return $result;
}


/***** END USER SPECIFIC HELPER FUNCTIONS *****/




/***** ADMIN WELCOME LINE *****/


function welcomeLineIndex()
{

     if (IsLoggedIn()) {

          if ($_SESSION['user_role'] == "Admin") {

               echo " Welcome To My Data";
          } else {

               echo " Welcome To My Data";
          }
     }
}




function welcomeLineDashboard()
{
     if (IsLoggedIn()) {

          if ($_SESSION['user_role'] == "Admin") {

               echo " Welcome To Dashboard";
          }
     }
}




/***** END ADMIN WELCOME LINE *****/





function IfItIsMethod($method = null)
{

     if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {

          return true;
     } else {

          return false;
     }
}



function IsLoggedIn()
{
     if (isset($_SESSION['user_role'])) {

          return true;
     } else {

          return false;
     }
}





function logggedInUserId()
{
     if (IsLoggedIn()) {

          $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] . "'");
          confirm($result);
          $user = mysqli_fetch_array($result);
          if (mysqli_num_rows($result) >= 1) {
               return $user['user_id'];
          }
     }

     return false;
}







function userLikedThisPost($post_id = '')
{

     $result = query("SELECT  * FROM likes WHERE user_id=" . logggedInUserId() . " AND post_id={$post_id}");
     confirm($result);

     if ($result) {


          return mysqli_num_rows($result) >= 1 ? true : false;
     }
}






function CheckIfUserIsLoggedInAndRedirect($redirectLocation = null)
{

     if (IsLoggedIn()) {

          redirect($redirectLocation);
     }
}




function getPostlikes($post_id)
{

     $result = query("SELECT * FROM likes WHERE post_id = $post_id");
     confirm($result);
     echo mysqli_num_rows($result);
}






function escape($string)
{

     global $connection;
     return mysqli_real_escape_string($connection, trim($string));
}



function imagePlaceholder($image = '')
{

     if (!$image) {
          return 'no_image.jpg';
     } else {
          return $image;
     }
}




function users_online()
{

     if (isset($_GET['onlineusers'])) {

          global $connection;

          if (!$connection) {
               session_start();

               include("../includes/db.php");

               $session = session_id();
               $time = time();
               $time_out_in_seconds = 05;
               $time_out = $time - $time_out_in_seconds;

               $query = "SELECT * FROM users_online WHERE session = '$session'";
               $send_query = mysqli_query($connection, $query);
               $count = mysqli_num_rows($send_query);

               if ($count == NULL) {
                    mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time')");
               } else {
                    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
               }


               $user_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
               echo $count_user = mysqli_num_rows($user_online_query);
          }
     } //get request isset()

}

users_online();

function confirm($results)
{

     global $connection;

     if (!$results) {
          die("QUERY FAILED" . mysqli_error($connection));
     }
}







function insert_categories()
{

     global $connection;

     if (isset($_POST['submit'])) {

          $cat_title = $_POST['cat_title'];


          if ($cat_title == "" || empty($cat_title)) {

               echo "This field should not be empty";
          } else {

               $cat_query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}') ";
               $query = mysqli_query($connection, $cat_query);
               confirm($query);

               if (!$query) {
                    die('QUERY FAILED' . mysqli_error($connection));
               }
          }
     }
}









function findAllCategories()
{                                          // FIND ALL CATEGORIES QUERY

     global $connection;
     $query = "SELECT * FROM categories";
     $select_categories = mysqli_query($connection, $query);


     while ($row = mysqli_fetch_assoc($select_categories)) {

          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title'];

          echo "<tr>";
          echo "<td>{$cat_id}</td>";
          echo "<td>{$cat_title}</td>";
          echo "<td><a class='btn btn-danger' href = 'categories.php?delete={$cat_id}'>Delete</a></td>";
          echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";
          echo "</tr>";
     }
}



function deleteCategories()
{                                             // DELETE QUERY

     global $connection;
     if (isset($_GET['delete'])) {
          $the_cat_id = $_GET['delete'];

          $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
          $delete_query = mysqli_query($connection, $query);
          header("Location: categories.php");
     }
}




function recordCount($table, $user_id = 0)
{

     global $connection;

     $query = "SELECT * FROM " . $table;
     if ($user_id > 0) {
          $query .= " WHERE user_id='$user_id'";
     }

     $select_all_post = mysqli_query($connection, $query);

     $result = 0;
     if (is_object($select_all_post) && $select_all_post->num_rows > 0) {
          $result = mysqli_num_rows($select_all_post);
          confirm($result);
     }

     return $result;
}




function checkStatus($table, $column, $status, $user_id)
{

     global $connection;

     $query = "SELECT * FROM $table WHERE $column = '$status'";

     if ($user_id > 0) {
          $query .= "AND user_id='$user_id'";
     }

     $result = mysqli_query($connection, $query);

     confirm($result);
     return mysqli_num_rows($result);
}

function checkUserRole($table, $column, $role)
{

     global $connection;

     $query = "SELECT * FROM $table WHERE $column = '$role' ";
     $select_all_subscriber = mysqli_query($connection, $query);

     return mysqli_num_rows($select_all_subscriber);
}





function username_exists($username)
{

     global $connection;

     $query = "SELECT username FROM users WHERE username = '$username'";
     $result = mysqli_query($connection, $query);
     confirm($result);

     if (mysqli_num_rows($result) > 0) {

          return true;
     } else {

          return false;
     }
}




function email_exists($email)
{
     global $connection;

     $query = "SELECT user_email FROM users WHERE user_email = '$email'";
     $result = mysqli_query($connection, $query);
     confirm($result);

     if (mysqli_num_rows($result) > 0) {

          return true;
     } else {

          return false;
     }
}



function register_user($username, $email, $password)
{

     global $connection;

     $username = mysqli_real_escape_string($connection, $username);
     $email    = mysqli_real_escape_string($connection, $email);
     $password = mysqli_real_escape_string($connection, $password);

     $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));


     $query = "INSERT INTO users(username , user_email , user_password , user_role) ";
     $query .= "VALUES('{$username}' , '{$email}' , '{$password}' , 'Subscriber')";
     $register_user_query = mysqli_query($connection, $query);

     confirm($register_user_query);
}




function login_user($username, $password)
{

     global $connection;


     $username = trim($username);
     $password = trim($password);


     $username = mysqli_real_escape_string($connection, $username);
     $password = mysqli_real_escape_string($connection, $password);

     $query = "SELECT * FROM users WHERE username = '{$username}' ";
     $select_user_query = mysqli_query($connection, $query);

     if (!$select_user_query) {
          die("QUERY FAILED" . mysqli_error($connection));
     }


     while ($row = mysqli_fetch_array($select_user_query)) {

          $db_user_id = $row['user_id'];
          $db_username = $row['username'];
          $db_user_password = $row['user_password'];
          $db_user_firstname = $row['user_firstname'];
          $db_user_lastname = $row['user_lastname'];
          $db_user_role = $row['user_role'];

          if (password_verify($password, $db_user_password)) {

               $_SESSION['user_id'] = $db_user_id;
               $_SESSION['username'] = $db_username;
               $_SESSION['user_firstname'] = $db_user_firstname;
               $_SESSION['user_lastname'] = $db_user_lastname;
               $_SESSION['user_role'] = $db_user_role;

               redirect("/cms/admin/index.php");
          } else {
               return false;
          }
     }
}
