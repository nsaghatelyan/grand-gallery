<?php
/**
 * @var gallery_data string
 * @var images array
 */

$page_options = array(
    "nav_type" => $options["pagination_nav_type_tiles"],
    "nav_text" => $options["pagination_nav_text_tiles"],
    "nearby" => $options["pagination_nearby_pages_tiles"]
);

$gallery_options = array();

if ($options["show_title_tiles"] == 0) {
    $gallery_options["tile_enable_textpanel"] = true;
    $gallery_options["tile_textpanel_always_on"] = true;
} elseif ($options["show_title_tiles"] == 1) {
    $gallery_options["tile_enable_textpanel"] = true;
}

$gallery_options["lightbox_type"] = $options["lightbox_type_tiles"];
$gallery_options["tile_textpanel_title_text_align"] = $options["title_position_tiles"];
$gallery_options["tile_textpanel_title_font_size"] = $options["title_size_tiles"];
$gallery_options["tile_textpanel_title_color"] = "#" . $options["title_color_tiles"];
$gallery_options["tile_textpanel_bg_color"] = "#" . $options["title_background_color_tiles"];
$gallery_options["tile_textpanel_bg_opacity"] = $options["title_background_opacity_tiles"] / 100;
$gallery_options["tiles_space_between_cols"] = (int)$options["margin_tiles"];
$gallery_options["tiles_col_width"] = (int)$options["col_width_tiles"];
$gallery_options["tiles_min_columns"] = $options["min_col_tiles"];
$gallery_options["tile_enable_border"] = true;
$gallery_options["tile_border_width"] = $options["border_width_tiles"];
$gallery_options["tile_border_color"] = "#" . $options["border_color_tiles"];
$gallery_options["tile_border_radius"] = $options["border_radius_tiles"];
$gallery_options["tile_enable_overlay"] = $options["on_hover_overlay_tiles"];
$gallery_options["tile_enable_icons"] = $options["show_icons_tiles"];
$gallery_options["tile_enable_image_effect"] = ($gallery_data->display_type != 1) ? true : false;
$gallery_options["tile_image_effect_type"] = $options["image_hover_effect_tiles"];
$gallery_options["tile_image_effect_reverse"] = $options["image_hover_effect_reverse_tiles"];
$gallery_options["tile_enable_shadow"] = $options["shadow_tiles"];
$gallery_options["tile_show_link_icon"] = $options["show_link_icon_tiles"];
$gallery_options["tile_as_link"] = $options["item_as_link_tiles"];
$gallery_options["tile_textpanel_appear_type"] = $options["title_appear_type_tiles"];
$gallery_options["tile_textpanel_position"] = $options["title_vertical_position_tiles"];
$gallery_options["tile_link_newpage"] = $options["link_new_tab_tiles"];

$lt = $options["lightbox_type_tiles"];
$gallery_options["lightbox_type"] = $lt;
$gallery_options["lightbox_arrows_offset"] = (int)$options["arrows_offset_" . $lt];
$gallery_options["lightbox_overlay_color"] = "#" . $options["overlay_color_" . $lt];
$gallery_options["lightbox_overlay_opacity"] = $options["overlay_opacity_" . $lt] / 100;
$gallery_options["lightbox_top_panel_opacity"] = $options["top_panel_opacity_" . $lt] / 100;
$gallery_options["lightbox_show_numbers"] = $options["show_numbers_" . $lt];
$gallery_options["lightbox_numbers_size"] = $options["number_size_" . $lt];
$gallery_options["lightbox_numbers_color"] = "#" . $options["number_color_" . $lt];
$gallery_options["lightbox_slider_image_border_width"] = $options["image_border_width_" . $lt];
$gallery_options["lightbox_slider_image_border_color"] = "#" . $options["image_border_color_" . $lt];
$gallery_options["lightbox_slider_image_border_radius"] = $options["image_border_radius_" . $lt];
$gallery_options["lightbox_slider_image_shadow"] = $options["image_shadow_" . $lt];
$gallery_options["lightbox_slider_control_swipe"] = $options["swipe_control_" . $lt];
$gallery_options["lightbox_slider_control_zoom"] = $options["zoom_control_" . $lt];
$gallery_options["lightbox_slider_image_border"] = true;

$gallery_options["lightbox_show_textpanel"] = $options["show_text_panel_" . $lt];
$gallery_options["lightbox_textpanel_enable_title"] = $options["enable_title_" . $lt];
$gallery_options["lightbox_textpanel_enable_description"] = $options["enable_desc_" . $lt];
$gallery_options["lightbox_textpanel_padding_top"] = (int)$options["texpanel_paddind_vert_" . $lt];
$gallery_options["lightbox_textpanel_padding_bottom"] = (int)$options["texpanel_paddind_vert_" . $lt];
$gallery_options["lightbox_textpanel_padding_right"] = (int)$options["texpanel_paddind_hor_" . $lt];
$gallery_options["lightbox_textpanel_padding_left"] = (int)$options["texpanel_paddind_hor_" . $lt];
$gallery_options["lightbox_textpanel_title_color"] = "#" . $options["title_color_" . $lt];
$gallery_options["lightbox_textpanel_title_text_align"] = $options["text_position_" . $lt];
$gallery_options["lightbox_textpanel_title_font_size"] = $options["title_font_size_" . $lt];
$gallery_options["lightbox_textpanel_desc_color"] = "#" . $options["desc_color_" . $lt];
$gallery_options["lightbox_textpanel_desc_text_align"] = $options["text_position_" . $lt];
$gallery_options["lightbox_textpanel_desc_font_size"] = $options["desc_font_size_" . $lt];

$json = json_encode($gallery_options);

wp_enqueue_script("gdgallerytiles", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-tiles.js", array('jquery'), false, true);

?>

<div id="gdgallery_container_<?= $gallery_data->id_gallery ?>" style="display:none;" data-view="tiles">

    <?php foreach ($images as $key => $val):
        $video_id = ($val->type == "image") ? "" : "data-videoid = '" . $val->video_id . "'";
        ?>

        <a href="<?= $val->link ?>">
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
<?php

if ($gallery_data->display_type == 2) {
    \GDGallery\Helpers\View::render('frontend/pagination.php', compact('gallery_data', 'images', 'page_options'));
} elseif ($gallery_data->display_type == 1) {
    ?>
    <div class="gdgallery_load_more_space">
        <button data-id="<?= $gallery_data->id_gallery ?>" data-count="<?= $gallery_data->items_per_page ?>"
                class="gdgallery_load_more"><?= $options["load_more_text_tiles"] ?>
        </button>
    </div>
    <?php
} ?>

<script type="text/javascript">

    jQuery(document).ready(function () {

        var container = jQuery("#gdgallery_container_<?= $gallery_data->id_gallery ?>");

        container.unitegallery(<?= $json ?>);

    });

</script>