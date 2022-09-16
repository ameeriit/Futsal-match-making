<?php
// @var
$db_host = 'localhost';
$db_username = 'saroj';
$db_password = 'admin@123';
$db_database = 'futsal';
// connect to database
$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);


if (!$con)
    die('Something Went Wrong');
 ?>
