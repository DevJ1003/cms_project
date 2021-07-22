<?php

ob_start();

$connection = mysqli_connect('localhost', 'root', '', 'cms');


$query = "SET NAMES utf8";
mysqli_query($connection, $query);
