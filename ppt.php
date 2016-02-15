<?php include("includes/layouts/catPresHeader.php") ?> 
<div class="container">

                    <div class="row">
                        <div class="section-title text-center">
                            <?php $noExt = explode(".", $_GET["file"]) ?>
                            <h3><?php echo str_replace('_', ' ', $noExt[0]); ?> Presentation</h3><br>
                            <iframe src="http://docs.google.com/gview?url=http://ezzy-statistics.com/pre/includes/files/ppt/<?php echo $_GET["cat"]; ?>/<?php echo $_GET["file"]; ?>&embedded=true" style="width:1000px; height:900px;" frameborder="0"></iframe>
                        </div>
                    </div>
                     <div class="row">

                </div><!-- /.row -->
                </div>
<?php include("includes/layouts/footer.php") ?> 