<?php 
session_start();
session_destroy();
header("Location: login.php");
ob_end_flush(); 
?>