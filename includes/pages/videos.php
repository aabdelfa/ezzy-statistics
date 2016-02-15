 <!-- Start Portfolio Section -->
        <div class="section-modal modal fade" id="portfolio-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h3>Videos</h3>
                            <p>Sorted by Category</p>
                        </div>
                    </div>
                    <?php
                            $dir = "includes/files/videos/";
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
                                <div class="col-md-4">
                                <div class="portfolio-item">
                                    <img src="images/videos/<?php echo $lcnt; ?>.png" class="img-responsive" alt="...">
                                    <div class="portfolio-details text-center">
                                        <h4><?php echo str_replace('_', ' ', $file); ?></h4>
                                        <a target="_blank" href="catVid.php?cat=<?php echo $file; ?>"><i class="fa fa-video-camera"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php if($cnt == 3) { ?></div><br><?php $cnt = 0; } ?>
                            <?php if($lcnt == 17) { ?></div><?php } ?>
                          <?php       }  ?>
                           <?php     }
                              closedir($dh); 
                            }
                          }
                        ?>
<!--

                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="portfolio-item">
                                <img src="images/portfolio/2.png" class="img-responsive" alt="...">
                                <div class="portfolio-details text-center">
                                    <h4>Project Name</h4>
                                    <a href="#"><i class="fa fa-video-camera"></i></a>
                                </div>
                            </div>
                        </div>
     -->                   
                        
                    </div><!-- /.row -->
                </div>
                
            </div>
        </div>
        <!-- End Portfolio Section -->