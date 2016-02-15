<?php require_once("includes/session.php"); //For creating a session, we don't use cookies "for better security" ?>
<?php require_once("includes/functions.php"); //Functions files ?>
<?php


if(!empty($_FILES['files']['name'][0])) {
    $files = $_FILES['files'];
    $category = $_POST["category"];
    $uploaded = array();
    $failed = array();

    $allowed = array('pdf');

    foreach($files['name'] as $position => $file_name) {
      $file_tmp = $files['tmp_name'][$position];
      $file_size = $files['size'][$position];
      $file_error = $files['error'][$position];

      $file_ext = explode('.', $file_name);
      $file_ext = strtolower(end($file_ext));

      if(in_array($file_ext, $allowed)) {
        if($file_error === 0) {
          if($file_size <= 8000000) {
            $file_destination = "../../includes/files/pdfs/". $category . "/" . str_replace(' ', '_', $file_name);
            move_uploaded_file($file_tmp, $file_destination);
            $_SESSION['message'] =   "Files uploaded successfully";
            
          }
        }
      }
    } 
    redirect_to('files.php?id=2');
}
?>