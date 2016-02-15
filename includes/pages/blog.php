<?php
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM blog ";
    $query .= "ORDER BY last_updated DESC";
    $blog = mysqli_query($connection, $query);
    confirm_query($blog);
?>
        <!-- Start Blog Blog Section -->
        <div class="section-modal modal fade" id="news-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h3>From The Blog</h3>
                            <p>View my Latest posts.</p>
                        </div>
                    </div>
                    <div class="row">
                        <?php while($row = mysqli_fetch_assoc($blog)) { ?>
                        <div class="col-md-6">
                            <div class="latest-post">
                                <img src="includes/files/blogs/<?php echo $row["image"]; ?>" class="img-responsive" alt="">
                                <h4><?php echo $row["title"]; ?></h4>
                                <div class="post-details">
                                    <ul>
                                        <li><i class="fa fa-user"></i> Auther : Dr. Ezz Abdelfattah</li>
                                        <li><i class="fa fa-calendar"></i><?php echo $row["last_updated"]; ?></li>
                                    </ul>
                                </div>
                                <p><?php echo $row["body"]; ?></p>
                                
                            </div>
                        </div>
                         <?php } mysqli_free_result($blog); ?>
                         <?php if(isset($blog)) { ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <div class="feature">
                                    <div class="feature-content">
                                        <br><br><br>
                                        <h3 class="text-danger">Check again soon for blogs...</h3>
                                    </div>
                                </div>
                            </div>
                           <?php   } ?>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- End Blog Section -->