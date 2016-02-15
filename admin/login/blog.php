<?php require_once("includes/session.php"); //For creating a session, we don't use cookies "for better security" ?>
<?php require_once("includes/functions.php"); //Functions files ?>
<?php require_once("includes/db_connection.php"); //Including the database connection file ?>
<?php confirm_logged_in(); ?>
<?php $blog = blogs(); ?>
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
              <div class="col-xs-12">
                <a href="new_blog.php?id=5" class="btn btn-primary">New Blog &nbsp; <i class="fa fa-plus"></i></a> 
                
              </div>
              <div class="col-xs-12">
                <br>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Blog Posts</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Image</th>
                        <th>Last Recorded</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($row = mysqli_fetch_assoc($blog)) { ?>
                      <tr>
                        <td><?php echo $row["title"]; ?></td>
                        <td><?php echo $row["body"]; ?></td>
                        <td><img style="width: 25%; height: 25%" src="../../includes/files/blogs/<?php echo $row["image"]; ?>"></td>
                        <td><?php echo $row["last_updated"]; ?></td>
                        <td><a href="edit_blog.php?id=5&blog_id=<?php echo $row["id"]; ?>"><i class="fa fa-pencil"></i></a> 
                          <a href="delete_blog.php?id=5&blog_id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o"></i></a></td>
                      </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>       
        </section>
      </div><!-- /.content-wrapper -->
<?php include('includes/layouts/footer.php') ?>