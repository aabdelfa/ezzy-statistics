<?php require_once("includes/session.php"); //For creating a session, we don't use cookies "for better security" ?>
<?php require_once("includes/functions.php"); //Functions files ?>
<?php require_once("includes/db_connection.php"); //Including the database connection file ?>
<?php confirm_logged_in(); ?>
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
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">All PDF files</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>File name</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          $a = array("Classification","Control Charts","Correlation and Association",
                            "Descriptive","Dispersion","Estimation","Forecasting","Graphs",
                            "Questionnaire Analysis","Means","Neural Networks","Prediction","Probability",
                            "Reliability","Shape","Survival Analysis","Testing Hypothesis");
                          
                          foreach ($a as $v) {
                            $dir = "../../includes/files/pdfs/" . str_replace(' ', '_', $v) . "/";
                          if (is_dir($dir)){
                            if ($dh = opendir($dir)){
                              while (($file = readdir($dh)) !== false) {
                                if (!in_array($file,array(".","..")))  { ?>
                                <tr>
                                  <td><?php echo '<a target="_blank" href='. $dir . $file .'>' . $file . '</a>' ; ?></td> 
                                  <td><?php echo round(filesize($dir . $file) / 1000) . "kb"; ?></td>
                                  <td><?php echo 'file/pdf'; ?></td>
                                  <?php $cat = explode("/", $dir)[5]; ?>
                                  <td><?php echo str_replace('_', ' ', $cat); ?></td>
                                  <td><?php echo '<a href="filedelete.php?file='. $dir . $file .'"><i class="fa fa-trash-o"></i></a>'; ?></td>
                                </tr>
                          <?php    }
                                }
                              closedir($dh);
                            }
                          }
                        }
                        ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <?php 
            ?>
            <div class="col-md-6">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Upload PDF file(s)</h3>
                </div><!-- /.box-header -->      
                <form role="form" action="pdfs_upload.php" method="post" enctype="multipart/form-data">
                  <div class="box-body">   
                    <div class="form-group">
                        <label for="fileToUpload">File input</label>
                        <input type="file" name="files[]" id="fileToUpload" multiple required>
                        <p class="help-block">Here you can upload PDF files <b>only</b>.</p>
                    </div>
                    <div class="form-group">
                    <label>Category</label>
                    <select name="category" class="form-control select2" style="width: 100%;" required>
                      <option value="" >Select...</option>
                      <?php 
                        foreach ($a as $v) { ?>

                      <option value="<?php echo str_replace(' ', '_', $v); ?>" ><?php echo $v ?></option>
                     <?php } ?>
                    </select>
                    <p class="help-block">Please make sure you choose the correct category.</p>
                  </div><!-- /.form-group -->
                  </div>
                  <div class="box-footer">
                      <input type="submit" value="Upload" name="submit" class="btn btn-primary">
                  </div>  
                  </form>
          </div>
        </div>
          </div>
        </section>
      </div><!-- /.content-wrapper -->
<?php include('includes/layouts/footer.php') ?>