<?php require_once("includes/session.php"); //For creating a session, we don't use cookies "for better security" ?>
<?php require_once("includes/functions.php"); //Functions files ?>
<?php require_once("includes/db_connection.php"); //Including the database connection file ?>
<?php confirm_logged_in(); ?>
<?php $user = find_admin_by_id($_SESSION['admin_id']); ?>
<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  
  if (empty($errors)) {
    
    // Perform Update

    $id = $_SESSION['admin_id'];
    $username = mysql_prep($_POST["username"]);
    $password = $_POST["password"];
    $passwordC = $_POST["passwordC"];
    if($password == $passwordC) {
      $hashed_password = password_encrypt($_POST["password"]);
    }
    else {
      $_SESSION["message"] = "Passwords don't match";
    }
    $first_name = mysql_prep($_POST["first_name"]);
    $last_name = mysql_prep($_POST["last_name"]);

    $query  = "UPDATE admins SET ";
    $query .= "username = '{$username}', ";
    $query .= "hashed_password = '{$hashed_password}', ";
    $query .= "first = '{$first_name}', ";
    $query .= "last = '{$last_name}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "User updated.";
      redirect_to("about.php?id=1");
    } else {
      // Failure
      $_SESSION["message"] = "User update failed.";
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
                  <h3 class="box-title">Edit Profile</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="profile.php" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputUsername">Username</label>
                      <input type="text" name="username" value="<?php echo htmlentities($user["username"]); ?>" class="form-control" id="exampleInputUsername" placeholder="Enter username" required />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFirst">First Name</label>
                      <input type="text" name="first_name" value="<?php echo htmlentities($user["first"]); ?>" class="form-control" id="exampleInputFirst" placeholder="Enter first name" required />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputLast">Last Name</label>
                      <input type="text" name="last_name" value="<?php echo htmlentities($user["last"]); ?>"  class="form-control" id="exampleInputLast" placeholder="Enter last name" required />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" value="" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" required />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword2">Confirm Password</label>
                      <input type="password" name="passwordC" value="" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" required />
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div>
          </div>
        </section>
      </div><!-- /.content-wrapper -->
<?php include('includes/layouts/footer.php') ?>