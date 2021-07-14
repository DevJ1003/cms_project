<?php
                                                                               /*
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "CMS";






////////////////////////////////////////////////FOR GODADDY HOSTING
$db['db_host'] = "localhost";
$db['db_user'] = "demo_cms_user";
$db['db_pass'] = "TqlcgE}c+JHo";
$db['db_name'] = "demo_cms_db";






foreach( $db as $key => $value ){
define(strtoupper($key) , $value);    
}

$connection = mysqli_connect(DB_HOST , DB_USER , DB_PASS , DB_NAME);

if($connection){
echo "We are connected!";
}                                                                               */


$connection = mysqli_connect('localhost' , 'root' , '' , 'cms');

//if($connection){
//echo "We are connected!";
//}

?>