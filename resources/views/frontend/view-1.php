<?php
/**
 * @var gallery_data string
 * @var images array
 */

wp_enqueue_script("gdgallerytiles", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-tiles.js", array('jquery'), false, true);

?>


<h3>Tiles Gallery</h3>

<div id="gdgallery_container_<?= $gallery_data->id_gallery ?>" style="display:none;" data-view="tiles">

    <?php foreach ($images as $key => $val):
        $video_id = ($val->type == "image") ? "" : "data-videoid = '" . $val->video_id . "'";
        ?>

        <a href="<?= $val->url ?>">
            <img alt="<?= $val->name ?>"
                 data-type="<?= $val->type ?>"
                 src="<?= $val->url ?>"
                 data-image="<?= $val->url ?>"
                 data-description="<?= $val->description ?>"
                <?= $video_id ?>
                 style="display:block">
        </a>

    <?php endforeach; ?>

</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        var container = jQuery("#gdgallery_container_<?= $gallery_data->id_gallery ?>");

        container.unitegallery({
            tile_enable_image_effect: true,
            tile_enable_overlay: true,
            tile_enable_icons: true,
            tile_image_effect_reverse: true,
            tiles_justified_space_between: 20, //margin
            lightbox_type: "wide", //compact
//            tile_as_link: true, // link
            tile_show_link_icon: true,
            tile_image_effect_type: "sepia",
            tile_enable_shadow: true,
            tile_enable_border: true,
            tile_enable_outline: false,
            tiles_space_between_cols: 15,
            tiles_justified_space_between: 15,
            tile_border_color: "red",
            tile_border_width: 3,
            tiles_col_width: 235,
            tile_border_radius: 20,
            theme_gallery_padding: 15,
            tile_enable_outline: false,
            theme_gallery_padding: 15,
            tile_enable_shadow: true,
            theme_gallery_padding: 25,
            tile_enable_textpanel: true,
            tile_textpanel_title_text_align: "center",
            tile_textpanel_bg_color: "#3A85E0",
            tile_textpanel_bg_opacity: 0.8,
            tile_textpanel_title_color: "yellow",
            tile_textpanel_always_on: false,
        });

    });

</script>