<?php require_once("includes/session.php"); //For creating a session, we don't use cookies "for better security" ?>
<?php require_once("includes/functions.php"); //Functions files ?>
<?php
$filename = $_GET['file']; //get the filename
unlink($filename); //delete it

$_SESSION["message"] = "File Deleted Successfully";
redirect_to($_SERVER['HTTP_REFERER']);
?>