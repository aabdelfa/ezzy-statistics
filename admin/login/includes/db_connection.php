<?php
  define("DBSERVER", "localhost");
  define("DB_USER", "USERNAME");
  define("DB_PASS", "PASSWORD");
  define("DB_NAME", "ezzy-statistics");
  // 1. Create a database connection
  $connection = mysqli_connect(DBSERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>
