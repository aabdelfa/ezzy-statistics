<?php require_once("includes/session.php");?>
<?php require_once("includes/functions.php"); //Functions ?>
<?php require_once("includes/db_connection.php"); //Including the database connection file ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['submit'])) {
 
  // Process the form
    $title = mysql_prep($_POST["title"]);
    $body = mysql_prep($_POST["body"]);

    if(isset($_FILES['file'])) {

    $allowed = array('png','jpg','jpeg');

      $file_name = $_FILES['file']['name'];
      $file_tmp = $_FILES['file']['tmp_name'];
      $file_size = $_FILES['file']['size'];
      $file_error = $_FILES['file']['error'];
      $ext = pathinfo($file_name, PATHINFO_EXTENSION);

      $image = str_replace(' ', '_', $file_name);
      if(in_array($ext, $allowed)) {
        if($file_error === 0) {
          if($file_size <= 3000000) {
            $file_destination = "../../includes/files/blogs/" . $image;
              move_uploaded_file($file_tmp, $file_destination); 
          }
        } 
      } 
    }
             global $connection; 
            $query  = "INSERT INTO blog (";
            $query .= " title, body, image, last_updated";
            $query .= ") VALUES (";
            $query .= "'{$title}','{$body}','{$image}', NOW()";
            $query .= ")";

            $result = mysqli_query($connection, $query);

            if ($result && mysqli_affected_rows($connection) == 1) {
              // Success
              $_SESSION["message"] = "Blog Created Successfully";
              redirect_to("blog.php?id=5");
            } else {
              // Failure
              $_SESSION["message"] = "Blog was not created.";
            }                     
  }

?>
<?php include('includes/layouts/header.php') ?>
<?php include('includes/layouts/sidebar.php') ?>
<!-- Main content -->
        <section class="content">
          <?php if (isset($_SESSION["message"]) != NULL){ ?>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong><?php echo message(); ?></strong>
            </div>
          <?php  } ?>
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Create New Blog</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="new_blog.php?id=5" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                    <label>Blog Title*</label>
                      <input type="text" name="title" class="form-control" placeholder="Enter..." required>
                    </div>
                    <div class="form-group">
                    <label for="editor1">Blog Body*</label>
                    <textarea id="editor1" name="body" rows="15" cols="90" required>

                    </textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Upload Image*</label>
                      <input type="file" name="file" id="exampleInputFile" required>
                      <p class="help-block">This will be the Blog Image</p>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button> 
                    <a href="blog.php?id=5" class="btn btn-default">Cancel</a>
                  </div>
                </form>
              </div><!-- /.box -->
          </div>
          </div> 
          </section>
      </div><!-- /.content-wrapper -->
<?php include('includes/layouts/footer.php') ?>