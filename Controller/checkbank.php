<?php 
include '../connections/db.php';
session_start();
$id=$_SESSION['loggedUser'];
//$query to check bank acount
$query