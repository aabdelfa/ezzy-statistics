<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php
$ip = $_SERVER['REMOTE_ADDR'];
$query_string = $_SERVER['QUERY_STRING'];
$http_referer = $_SERVER['HTTP_REFERER'];
$http_user_agent = $_SERVER['HTTP_USER_AGENT']; 
include('includes/layouts/ip2locationlite.class.php');
//Load the class
$ipLite = new ip2location_lite;
$ipLite->setKey('ADD_API_KEY_HERE');

//Get errors and locations
$locations = $ipLite->getCity($ip);
$errors = $ipLite->getError();

//Getting the result
if (!empty($locations) && is_array($locations)) {
  foreach ($locations as $field => $val) {
    if ($field == 'countryName')
      $country = $val;
    if ($field == 'cityName')
      $city = $val;
  }
}
if (is_bot())
$isbot = 1;
else
$isbot = 0;
$date = date("Y-m-d");
$time = date("H:i:s");
global $connection; 
$query = "INSERT INTO `tracker` (`date`, `time`, `ip`, `http_referer`, `http_user_agent`, `isbot`)
VALUES ('$date', '$time', '$ip', '$http_referer' ,'$http_user_agent' , $isbot)";
$result =  mysqli_query($connection, $query);
?>
<?php include("includes/layouts/header.php") ?>   
<?php include('includes/layouts/logo.php') ?>    
<?php include('includes/layouts/nav.php') ?>
<?php include('includes/layouts/copyright.php') ?>        
<?php include('includes/pages/image.php') ?>  
<?php include('includes/pages/presentations.php') ?>
<?php include('includes/pages/files.php') ?> 
<?php include('includes/pages/videos.php') ?> 
<?php include('includes/pages/about.php') ?>                    
<?php include('includes/pages/blog.php') ?> 
<?php include('includes/pages/contact.php') ?>
<?php include('includes/layouts/footer.php') ?>