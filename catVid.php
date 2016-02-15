<?php include("includes/layouts/catPresHeader.php") ?> 
<div class="container">

                    <div class="row">
                        <div class="section-title text-center">
                            <h3><?php echo str_replace('_', ' ',$_GET["cat"]); ?> Videos</h3>
                            
                        </div>
                    </div>
                     <div class="row">
                    <?php
                            $dir = "includes/files/videos/" . $_GET["cat"] . "/";
                          if (is_dir($dir)){
                            if ($dh = opendir($dir)){
                              while (($file = readdir($dh)) !== false) {
                                if (!in_array($file,array(".","..",".DS_Store")))  { ?> 
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="feature">
                                    <a href="<?php echo  $dir . $file; ?>"><i class="fa fa-video-camera"></i></a>
                                    <div class="feature-content">
                                      <?php $file_name = explode('.', $file);
                                      $file_name = $file_name[0]; ?>
                                        <h4><?php echo str_replace('_', ' ', $file_name); ?></h4>
                                    </div>
                                </div>
                            </div>
                          <?php       }
                               
                                } 
                             $fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
                              $cnt =  iterator_count($fi);
                              if($cnt == 0 ) { ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <div class="feature">
                                    <div class="feature-content">
                                        <br><br><br>
                                        <h3 class="text-danger">There are no videos in this catergory</h3>
                                    </div>
                                </div>
                            </div>
                           <?php   }
                                   
                              closedir($dh); 
                            }
                          }
                        ?>
                </div><!-- /.row -->
                </div>
<?php include("includes/layouts/footer.php") ?> 