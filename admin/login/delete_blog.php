<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
  
  $id = $_GET["blog_id"];
  $query = "DELETE FROM blog WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_affected_rows($connection) == 1) {
    // SuccessS
    $_SESSION["message"] = "Blog deleted.";
    redirect_to("blog.php?id=5");
  } else {
    // Failure
    $_SESSION["message"] = "Blog deletion failed.";
    redirect_to("blog.php?id=5");
  }
  
?>