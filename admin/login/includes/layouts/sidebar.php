<?php require_once("includes/functions.php"); //Functions files ?>
<?php require_once("includes/db_connection.php"); //Including the database connection file ?>
<?php
  $sp = find_page_by_id($_GET["id"]);
  $pages = find_pages();
?>
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <?php 
                  //  Navigation: left bar - Complex!
                    while($subject = mysqli_fetch_assoc($pages)) {
                    $output  = " <li"; // start: li
                    if($subject["id"] == $_GET["id"]){
                      $output .= " class=\"active\""; 
                    }
                    $output .= ">";
                    $output .= "<a href=\"";
                    $output .= urlencode($subject["page"]);
                    $output .= "?id=";
                    $output .= urlencode($subject["id"]);
                    $output .= "\">";
                    $output .= "<i class=\"";
                    $output .= $subject["icon"];
                    $output .= "\"></i>";
                    $output .= " <span>";
                    $output .= htmlentities($subject["name"]);
                    $output .= "</span></a>";
                    $output .= "</li>"; // end of the subject li

                    echo $output;
                  }
                    mysqli_free_result($pages); //free memory from mysql query       
                  ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php while($selected_page = mysqli_fetch_assoc($sp)) { ?>
            <?php echo $selected_page["name"]; ?>
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> Home</li>
            <li class="active"><?php echo $selected_page["name"]; ?>
              <?php mysqli_free_result($pages); ?>
              <?php } ?></li>
          </ol>
        </section>