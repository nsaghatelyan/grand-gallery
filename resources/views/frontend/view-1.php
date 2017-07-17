<?php
/**
 * @var gallery_data string
 * @var images array
 */

wp_enqueue_script("gdgallerytiles", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-tiles.js", array('jquery'), false, true);

?>


<h3>Tiles Gallery</h3>

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
    <a href="sdasdsa">
        <img alt="sdadsdsa"
             src="http://lorempixel.com/140/227/?1"
             data-image="http://lorempixel.com/140/227/?1"
             data-description="sadasdsdasda"
             style="display:none">
    </a>
    <a href="sdasdsa">
        <img alt="sdadsdsa"
             src="http://lorempixel.com/340/227/?1"
             data-image="http://lorempixel.com/140/227/?1"
             data-description="sadasdsdasda"
             style="display:none">
    </a>
    <a href="sdasdsa">
        <img alt="sdadsdsa"
             src="http://lorempixel.com/227/340/?1"
             data-image="http://lorempixel.com/140/227/?1"
             data-description="sadasdsdasda"
             style="display:none">
    </a>
    <a href="sdasdsa">
        <img alt="sdadsdsa"
             src="http://lorempixel.com/140/227/?1"
             data-image="http://lorempixel.com/140/227/?1"
             data-description="sadasdsdasda"
             style="display:none">
    </a>
    <a href="sdasdsa">
        <img alt="sdadsdsa"
             src="http://lorempixel.com/340/227/?1"
             data-image="http://lorempixel.com/140/227/?1"
             data-description="sadasdsdasda"
             style="display:none">
    </a> <a href="sdasdsa">
        <img alt="sdadsdsa"
             src="http://lorempixel.com/140/227/?1"
             data-image="http://lorempixel.com/140/227/?1"
             data-description="sadasdsdasda"
             style="display:none">
    </a>


</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        jQuery("#gallery").unitegallery();

    });

</script>