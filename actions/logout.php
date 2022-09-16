<?php
session_start();
// destroy session
session_destroy();
session_unset();

header('Location: ../index.php');
 ?>
