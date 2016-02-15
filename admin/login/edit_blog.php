<?php require_once("includes/session.php"); //For creating a session, we don't use cookies "for better security" ?>
<?php require_once("includes/functions.php"); //Functions files ?>
<?php require_once("includes/db_connection.php"); //Including the database connection file ?>
<?php confirm_logged_in(); ?>
<?php $blog = find_blog_by_id($_GET["blog_id"]); ?>
<?php
if (isset($_POST['submit'])) {
 
  // Process the form
    $title = mysql_prep($_POST["title"]);
    $body = mysql_prep($_POST["body"]);
    $id = $_GET["blog_id"];
    global $connection; 
    $query  = "UPDATE blog SET ";
    $query .= "title = '{$title}', ";
    $query .= "body = '{$body}', ";

    if(isset($_FILES['file'])) {
    $allowed = array('png','jpg','jpeg');
      $file_name = $_FILES['file']['name'];
      $file_tmp = $_FILES['file']['tmp_name'];
      $file_size = $_FILES['file']['size'];
      $file_error = $_FILES['file']['error'];
      $ext = pathinfo($file_name, PATHINFO_EXTENSION);
      $image = str_replace(' ', '_', $file_name);  
      if(in_array($ext, $allowed)) {
        $query .= "image = '{$image}', ";
        if($file_error === 0) {
          if($file_size <= 3000000) {
            $file_destination = "../../includes/files/blogs/" . $image;
              move_uploaded_file($file_tmp, $file_destination); 
          }
        } 
      } 
    }
            $query .= "last_updated = NOW() ";
            $query .= "WHERE id = {$id} ";
            $query .= "LIMIT 1";


            $result = mysqli_query($connection, $query);

            if ($result && mysqli_affected_rows($connection) == 1) {
              // Success
              $_SESSION["message"] = "Blog Updated Successfully";
              redirect_to("blog.php?id=5");
            } else {
              // Failure
              $_SESSION["message"] = "Blog was not Updated.";
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
                <form role="form" action="edit_blog.php?id=5&blog_id=<?php echo $_GET["blog_id"]; ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                    <label>Blog Title</label>
                    <?php while($row = mysqli_fetch_assoc($blog)) { ?>
                      <input type="text" name="title" value="<?php echo $row["title"]; ?>" class="form-control" placeholder="Enter...">
                    </div>
                    <div class="form-group">
                    <label for="editor1">Blog Body</label>
                    <textarea id="editor1" name="body" rows="15" cols="90">
                      <?php echo $row["body"]; ?>
                    </textarea>
                    </div>
                    <div class="form-group">

                      <label for="exampleInputFile">Upload New Image</label>
                      <center><img style="width: 25%; height: 25%" src="../../includes/files/blogs/<?php echo $row["image"]; ?>"></center>
                      <input type="file" name="file" id="exampleInputFile">
                      <p class="help-block">This will override the old image.</p>
                    </div>
                  </div><!-- /.box-body -->
                  <?php } ?>
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