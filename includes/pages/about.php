<?php
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM about ";
    $query .= "LIMIT 1";
    $about = mysqli_query($connection, $query);
    confirm_query($about);
?>
<?php
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM education ";
    $query .= "ORDER BY id ASC";
    $education = mysqli_query($connection, $query);
    confirm_query($education);
?>
<?php
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM work ";
    $query .= "ORDER BY id ASC";
    $work = mysqli_query($connection, $query);
    confirm_query($work);
?>
<?php
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM teaching ";
    $query .= "ORDER BY id ASC";
    $teaching = mysqli_query($connection, $query);
    confirm_query($teaching);
?>
        <!-- Start About Me Section -->
        <div class="section-modal modal fade" id="about-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                
                <div class="container">
                    <div class="row">
                        <div class="section-title text-center">
                            <h3>About Dr. Ezz H. Abdelfattah</h3>
                            <p>Who is he? And what does he do?</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="about-text">
                                <?php while($row = mysqli_fetch_assoc($about)) { ?>
                                      <?php echo $row["about"]; } ?>
                                      <?php  mysqli_free_result($about); ?>
                                <hr><br><div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <h4><b>His Education</b></h4>
                                        <ul>
                                            <?php while($row = mysqli_fetch_assoc($education)) { ?>
                                            <li><i class="fa fa-book"></i><?php echo $row["education"]; } ?></li>
                                            <?php  mysqli_free_result($education); ?>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <h4><b>His Work Experience</b></h4>
                                        <ul>
                                            <?php while($row = mysqli_fetch_assoc($work)) { ?>
                                            <li><i class="fa fa-suitcase"></i><?php echo $row["work"]; } ?></li>
                                            <?php  mysqli_free_result($work); ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                     <h4><b>His Teaching Experience</b></h4>
                                        <ul>
                                            <?php while($row = mysqli_fetch_assoc($teaching)) { ?>
                                            <li><i class="fa fa-commenting-o"></i><?php echo $row["teaching"]; } ?></li>
                                            <?php  mysqli_free_result($teaching); ?>
                                        </ul>
                                    </div>
                                </div><!-- /.row -->
                            </div>
                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 text-center">
                            <div class="skill-shortcode">
                                <h4><b>SPSS Courses introduced</b></h4>
                                <!-- Progress Bar -->
                            </div>
                        </div>
                    </div><br>
                        <?php
                            $dir = "images/spss/";
                          if (is_dir($dir)){
                            if ($dh = opendir($dir)){
                                $cnt = 0;
                                $lcnt = 0;
                              while (($file = readdir($dh)) !== false) {

                                if (!in_array($file,array(".","..",".DS_Store")))  { ?> 
                                <?php $lcnt = $lcnt + 1; ?>
                                <?php if($cnt == 0){ ?>
                                <div class="row">
                                    <?php } $cnt = $cnt + 1; ?>
                                <div class="col-md-3 col-sm-6">
                                    <img src="<?php echo $dir . $file; ?>">
                                    </div>
                            <?php if($cnt == 4) { ?></div><br><?php $cnt = 0; } ?>
                            <?php if($lcnt == 17) { ?></div><?php } ?>
                            <?php       }  ?>
                            <?php     }
                              closedir($dh); 
                            }
                          }
                        ?>
                </div>
            </div>
        </div>
        <!-- End About Me Section -->