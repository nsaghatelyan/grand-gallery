<?php
/**
 * @var gallery_data string
 * @var images array
 */

wp_enqueue_script("gdgallerycarousel", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-carousel.js", array('jquery'), false, true);

?>


<h3>Carousel Gallery</h3>

<div id="gallery" style="display:none;">

    <?php foreach ($images as $key => $val): ?>

        <a href="<?= $val->link ?>">
            <img alt="<?= $val->name ?>"
                 src="<?= $val->url ?>"
                 data-image="<?= $val->url ?>"
                 data-description="<?= $val->description ?>"
                 style="display:block">
        </a>

    <?php endforeach; ?>

</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        jQuery("#gallery").unitegallery();

    });

</script>