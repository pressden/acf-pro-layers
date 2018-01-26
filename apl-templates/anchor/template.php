<?php
/*
Template Name: APL Anchor
*/

// layer fields
$name = $layer['name'];
$css_classes = ( isset( $layer['css_classes'] ) ) ? $layer['css_classes'] : null;
?>

<a name="<?php echo $name; ?>" class="anchor <?php echo $css_classes; ?>"></a>
