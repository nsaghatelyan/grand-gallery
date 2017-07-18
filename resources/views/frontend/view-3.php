<?php
/**
 * @var gallery_data string
 * @var images array
 */

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

</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        jQuery("#gallery").unitegallery();

    });

</script>