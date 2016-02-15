<?php require_once("includes/session.php"); //For creating a session, we don't use cookies "for better security" ?>
<?php require_once("includes/functions.php"); //Functions files ?>
<?php require_once("includes/db_connection.php"); //Including the database connection file ?>
<?php confirm_logged_in(); ?>
<?php $contact = contact_info(); ?>
<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  
  if (empty($errors)) {
    
    // Perform Update

    $email = mysql_prep($_POST["email"]);
    $mobile = mysql_prep($_POST["mobile"]);
    $facebook = mysql_prep($_POST["facebook"]);
    $linkedin = mysql_prep($_POST["linkedin"]);

    $query  = "UPDATE contact SET ";
    $query .= "email = '{$email}', ";
    $query .= "mobile = '{$mobile}', ";
    $query .= "facebook = '{$facebook}', ";
    $query .= "linkedin = '{$linkedin}' ";
    $query .= "WHERE id = '1' ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "Contact Info updated.";
      redirect_to("contact.php?id=8");
    } else {
      // Failure
      $_SESSION["message"] = "Contact Info update failed.";
    }
  
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

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
            <div class="col-md-6">
           <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Contact Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="contact.php?id=8" method="post">
                  <?php while($contact = mysqli_fetch_assoc($contact)) { ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputUsername">Email</label>
                      <input type="email" name="email" value="<?php echo htmlentities($contact["email"]); ?>" class="form-control" id="exampleInputUsername" placeholder="Enter email" required />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFirst">Phone Number</label>
                      <input type="text" name="mobile" value="<?php echo htmlentities($contact["mobile"]); ?>" class="form-control" id="exampleInputFirst" placeholder="Enter phone number" required />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputLast">Facebook Account</label>
                      <input type="text" name="facebook" value="<?php echo htmlentities($contact["facebook"]); ?>"  class="form-control" id="exampleInputLast" placeholder="Enter Facebook link" required />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Linkedin Account</label>
                      <input type="text" name="linkedin" value="<?php echo htmlentities($contact["linkedin"]); ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Linkedin link" required />
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <?php } ?>
                </form>
              </div><!-- /.box -->
            </div>
          </div>
        </section>
      </div><!-- /.content-wrapper -->
<?php include('includes/layouts/footer.php') ?>