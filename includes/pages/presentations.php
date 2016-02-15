        <!-- Start Presentations Section -->
        <div class="section-modal modal fade" id="feature-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h3>PowerPoint Presentations</h3>
                            <p>Sorted by Category</p>
                        </div>
                    </div>
                    <?php
                            $dir = "includes/files/ppt/";
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
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="feature">
                                    <?php $inDir = "includes/files/ppt/" . $file; ?>
                                    <a target="_blank" href="catPres.php?cat=<?php echo $file; ?>"><i class="fa fa-files-o"></i></a>
                                    <div class="feature-content">
                                        <h4><?php echo str_replace('_', ' ', $file); ?></h4>
                                    </div>
                                </div>
                            </div>
                            <?php if($cnt == 4) { ?></div><br><?php $cnt = 0; } ?>
                            <?php if($lcnt == 17) { ?></div><?php } ?>
                          <?php       }  ?>
                           <?php     }
                              closedir($dh); 
                            }
                          }
                        ?>
                </div><!-- /.row -->

                </div>               
            </div>
        <!-- End Presentations Section -->