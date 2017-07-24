<?php
/**
 * @var gallery_data string
 * @var images array
 */

wp_enqueue_script("gdgallerygrid", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-tilesgrid.js", array('jquery'), false, true);

?>

<h3>Grid Gallery</h3>

<div id="gdgallery_container_<?= $gallery_data->id_gallery ?>" style="display:none;" data-view="grid">

    <?php foreach ($images as $key => $val):
        $video_id = ($val->type == "image") ? "" : "data-videoid = '" . $val->video_id . "'";
        ?>

        <img alt="<?= $val->name ?>"
             data-type="<?= $val->type ?>"
             src="<?= $val->url ?>"
             data-image="<?= $val->url ?>"
             data-description="<?= $val->description ?>"
            <?= $video_id ?>
             style="display:block">

    <?php endforeach; ?>

</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        var container = jQuery("#gdgallery_container_<?= $gallery_data->id_gallery ?>");

        container.unitegallery({
            grid_space_between_cols: 0,
            grid_space_between_rows: 0,
            tile_enable_border: false,
            tile_enable_shadow: false,
            grid_padding: 0,
            tile_width: 250,
            tile_show_link_icon: true,
        });

    });

</script>