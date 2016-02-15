        <!-- Start Files Section -->
        <div class="section-modal modal fade" id="pricing-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">

                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>

                <div class="pricing-section">
                        <div class="section-title text-center">
                            <h3>PDF Documents</h3>
                            <p>Sorted by Category</p>
                        </div>
                    <div class="container">
                       
                            <?php
                            $dir = "includes/files/pdfs/";
                          if (is_dir($dir)){
                            if ($dh = opendir($dir)){
                                $cnt = 0;
                                $clpse = 0;
                                $lcnt = 0;
                              while (($file = readdir($dh)) !== false) {

                                if (!in_array($file,array(".","..",".DS_Store")))  { ?> 
                                <?php $lcnt = $lcnt + 1; ?>
                                <?php if($cnt == 0){ ?>
                                <div class="row">
                                    <?php } $cnt = $cnt + 1; ?>
                                <div class="col-md-3 col-sm-6">
                                <div class="pricing-table">
                                    <div class="plan-name">
                                        <h3><a style="color:white;" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $clpse; ?>"><?php echo str_replace('_', ' ', $file); ?> <i class="fa fa-caret-down"></i></a></h3>
                                    </div>
                                    <div id="collapse<?php echo $clpse; ?>" class="plan-list panel-collapse collapse">
                                        <?php $clpse = $clpse + 1; ?>
                                        <ul>
                                           <?php $fdir = "includes/files/pdfs/" . $file . "/"; 
                                           if (is_dir($fdir)){
                                            if ($fdh = opendir($fdir)){
                                                 while (($ffile = readdir($fdh)) !== false) { 
                                                    if (!in_array($ffile,array(".","..")))  { ?>
                                                    <?php $file_name = explode('.', $ffile);
                                                            $file_name = $file_name[0]; ?>
                                                        <li><?php echo '<a target="_blank" href='. $fdir . $ffile .'>' . $file_name  . '</a>'; ?></li>
                                                    <?php }  

                                                        } 
                                                        $fi = new FilesystemIterator($fdir, FilesystemIterator::SKIP_DOTS);
                                                        $filecnt =  iterator_count($fi);
                                                        if($filecnt == 0 ) { ?>
                                                            <li>No existing files in this category.</li>
                                                        <?php   }
                                                        closedir($fdh);
                                                    } 
                                                } ?>
                                        </ul>
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
                    
                    </div>
                </div>

            </div>
        </div>
        <!-- End Files Section -->