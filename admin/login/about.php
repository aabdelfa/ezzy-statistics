<?php require_once("includes/session.php"); //For creating a session, we don't use cookies "for better security" ?>
<?php require_once("includes/functions.php"); //Functions files ?>
<?php require_once("includes/db_connection.php"); //Including the database connection file ?>
<?php confirm_logged_in(); ?>
<?php $about = about_page(); ?>
<?php $education = education(); ?>
<?php $work = work(); ?>
<?php $teaching = teaching(); ?>
<?php
if (isset($_POST['aboutSubmit'])) {
  // Process the form

    $about = $_POST["about"];

    $query  = "UPDATE about SET ";
    $query .= "about = '{$about}' ";
    $query .= "WHERE id = 1 ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "The about has been updated.";
      redirect_to("about.php?id=1");
    } else {
      // Failure
      $_SESSION["message"] = "The about update failed.";
    }
} 
?>
<?php
if (isset($_POST['workSubmit'])) {
  // Process the form

    $work = $_POST["work"];

    $query  = "UPDATE work SET ";
    $query .= "work = '{$work}' ";
    $query .= "WHERE id = {$_GET["work_id"]} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "The work experience with ID = {$_GET["work_id"]} has been updated.";
      redirect_to("about.php?id=1");
    } else {
      // Failure
      $_SESSION["message"] = "The work experience with ID = {$_GET["work_id"]} failed to update.";
    }
} 
?>
<?php
if (isset($_POST['educationSubmit'])) {
  // Process the form

    $education = $_POST["education"];

    $query  = "UPDATE education SET ";
    $query .= "education = '{$education}' ";
    $query .= "WHERE id = {$_GET["education_id"]} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "The education with ID = {$_GET["education_id"]} has been updated.";
      redirect_to("about.php?id=1");
    } else {
      // Failure
      $_SESSION["message"] = "The education with ID = {$_GET["education_id"]} failed to update.";
    }
} 
?>
<?php
if (isset($_POST['teachingSubmit'])) {
  // Process the form

    $teaching = $_POST["teaching"];

    $query  = "UPDATE teaching SET ";
    $query .= "teaching = '{$teaching}' ";
    $query .= "WHERE id = {$_GET["teaching_id"]} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $_SESSION["message"] = "The teaching experience with ID = {$_GET["teaching_id"]} has been updated.";
      redirect_to("about.php?id=1");
    } else {
      // Failure
      $_SESSION["message"] = "The education with ID = {$_GET["teaching_id"]} failed to update.";
    }
} 
?>
<?php include('includes/layouts/header.php') ?>
<?php include('includes/layouts/sidebar.php') ?>
<!-- Main content -->
        <section class="content">
          <?php if (isset($_SESSION["message"]) != NULL){ ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong><?php echo message(); ?></strong>
            </div>
            <?php  } ?>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Edit About <small>Here you can edit the about text.</small></h3>
                  <!-- tools box -->
                </div><!-- /.box-header -->
                <div class="box-body pad">
                  <form action="about.php?id=1" method="post">
                    <textarea id="editor1" name="about" rows="15" cols="90">
                      <?php while($row = mysqli_fetch_assoc($about)) { ?>
                      <?php echo $row["about"]; } ?>
                      <?php  mysqli_free_result($about); ?>                                           
                    </textarea>
                  
                </div>
                <div class="box-footer">
                  <button type="submit" name="aboutSubmit" class="btn btn-success">Submit</button>
                </div>
              </form>
              </div><!-- /.box -->
            </div><!-- /.col-->
            <div class="col-xs-12">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Education Table</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Education</th>
                      <th>Edit</th>
                    </tr>
                    <?php while($row = mysqli_fetch_assoc($education)) { ?>
                    <tr>
                      <td><?php echo $row["id"]; ?></td>
                      <td><?php echo $row["education"]; ?></td>
                      <td><a data-toggle="modal" data-target="#educationid<?php echo $row["id"]; ?>"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                      <!-- Modal -->
                      <div id="educationid<?php echo $row["id"]; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Education</h4>
                              <code><?php echo htmlentities('<br> means there a break'); ?></code><br>
                              <code><?php echo htmlentities('<b> means the font is bold and </b> to close the bold'); ?></code>
                            </div>
                             <form action="about.php?id=1&education_id=<?php echo $row["id"]; ?>" method="post">
                            <div class="modal-body">
                                  <textarea name="education" class="form-control" rows="4">
                                      <?php echo $row["education"]; ?>
                                  </textarea>          
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" name="educationSubmit" class="btn btn-success">Submit</button>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <?php  mysqli_free_result($education); ?> 
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-xs-12">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Work Experience Table</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Work Experience</th>
                      <th>Edit</th>
                    </tr>
                    <?php while($row = mysqli_fetch_assoc($work)) { ?>
                    <tr>
                      <td><?php echo $row["id"]; ?></td>
                      <td><?php echo $row["work"]; ?></td>
                      <td><a data-toggle="modal" data-target="#workid<?php echo $row["id"]; ?>"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                      <!-- Modal -->
                      <div id="workid<?php echo $row["id"]; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Work Experience</h4>
                              <code><?php echo htmlentities('<br> means there a break'); ?></code><br>
                              <code><?php echo htmlentities('<b> means the font is bold and </b> to close the bold'); ?></code>
                            </div>
                             <form action="about.php?id=1&work_id=<?php echo $row["id"]; ?>" method="post">
                            <div class="modal-body">
                                  <textarea name="work" class="form-control" rows="4">
                                      <?php echo $row["work"]; ?>
                                  </textarea>          
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" name="workSubmit" class="btn btn-success">Submit</button>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <?php  mysqli_free_result($work); ?> 
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-xs-12">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Teaching Experience Table</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Teaching Experience</th>
                      <th>Edit</th>
                    </tr>
                    <?php while($row = mysqli_fetch_assoc($teaching)) { ?>
                    <tr>
                      <td><?php echo $row["id"]; ?></td>
                      <td><?php echo $row["teaching"]; ?></td>
                      <td><a data-toggle="modal" data-target="#teachingid<?php echo $row["id"]; ?>"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                      <!-- Modal -->
                      <div id="teachingid<?php echo $row["id"]; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Teaching Experience</h4>
                              <code><?php echo htmlentities('<br> means there a break'); ?></code><br>
                              <code><?php echo htmlentities('<b> means the font is bold and </b> to close the bold'); ?></code>
                            </div>
                             <form action="about.php?id=1&teaching_id=<?php echo $row["id"]; ?>" method="post">
                            <div class="modal-body">
                                  <textarea name="teaching" class="form-control" rows="4">
                                      <?php echo $row["teaching"]; ?>
                                  </textarea>          
                                
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" name="teachingSubmit" class="btn btn-success">Submit</button>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <?php  mysqli_free_result($teaching); ?> 
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section>
      </div><!-- /.content-wrapper -->
<?php include('includes/layouts/footer.php') ?>