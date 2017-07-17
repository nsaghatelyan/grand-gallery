<?php
/**
 * @var gallery_data string
 * @var images array
 */

wp_enqueue_script("gdgalleryunite", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/unitegallery.min.js", array('jquery'), false, true);
wp_enqueue_style('gdgalleryunit', \GDGallery()->pluginUrl() . '/resources/assets/css/frontend/unite-gallery.css');
wp_enqueue_script("gdgalleryslider", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-slider.js", array('jquery'), false, true);

?>


<h3>Slider Gallery</h3>

<div id="gallery" style="display:none;">

    <?php foreach ($images as $key => $val): ?>

        <img alt="<?= $val->name ?>"
             src="<?= $val->url ?>"
             data-image="<?= $val->url ?>"
             data-description="<?= $val->description ?>">

    <?php endforeach; ?>


    <img alt="Preview Image 2"
         src="http://lorempixel.com/140/227/?1"
         data-image="http://lorempixel.com/140/227/?1"
         data-description="Preview Image 2 Description">

    <img alt="Preview Image 3"
         src="http://lorempixel.com/340/227/?1"
         data-image="http://lorempixel.com/340/227/?1"
         data-description="Preview Image 3 Description">

</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        jQuery("#gallery").unitegallery();

    });

</script>