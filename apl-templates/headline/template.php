<?php
/*
Template Name: APL Headline
*/

// layer fields
$title = $layer['title'];
$dek = $layer['dek'];
?>

<!--Box Module Header (Green)-->
<!--<h6 class="module-description">Module 1A Box Module Header (Green)</h6>-->

<?php apl_open_layer( $layer_name, $apl_unique_id ); ?>

  <div class="col-xs-12 <?php echo $layer_name; ?>">
    <h1><?php echo $layer['title']; ?></h1>
    <h3><?php echo $layer['dek']?></h3>
  </div>
  
  <?php /*
  <div class="col-sm-12 col-md-12 col-lg-12 header-arrow-bar">
    <div class="sub-nav-bar">
      
      <div class="arrow-box">
        <h3>Programs</h3>
      </div>
      
      <div class="wedge2"></div>
      
      <div class="arrow-box-description">Take a look at all of the programs we offer, Lorem Ipsum. </div>
      
    </div>
  </div>
  */ ?>

<?php apl_close_layer(); ?>
