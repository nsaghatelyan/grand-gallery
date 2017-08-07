<?php
/**
 * @var gallery_data string
 * @var images array
 */


$gallery_options = array();
if ($options["show_title_grid"] == 0) {
    $gallery_options["tile_enable_textpanel"] = true;
    $gallery_options["tile_textpanel_always_on"] = true;
} elseif ($options["show_title_grid"] == 1) {
    $gallery_options["tile_enable_textpanel"] = true;
}

$gallery_options["tile_width"] = (int)$options["width_grid"];
$gallery_options["tile_height"] = (int)$options["height_grid"];
$gallery_options["grid_space_between_cols"] = (int)$options["space_cols_grid"];
$gallery_options["grid_space_between_rows"] = (int)$options["space_rows_grid"];
$gallery_options["gallery_width"] = $options["gallery_width_grid"] . "%";
if ($options["gallery_bg_grid"] == 1) {
    $gallery_options["gallery_background_color"] = "#" . $options["gallery_bg_color_grid"];
}
$gallery_options["grid_num_rows"] = (int)$options["num_rows_grid"];
$gallery_options["tile_textpanel_title_text_align"] = $options["title_position_grid"];
$gallery_options["tile_textpanel_position"] = $options["title_vertical_position_grid"];
$gallery_options["tile_textpanel_appear_type"] = $options["title_appear_type_grid"];
$gallery_options["tile_textpanel_title_font_size"] = $options["title_size_grid"];
$gallery_options["tile_textpanel_title_color"] = $options["title_color_grid"];
$gallery_options["tile_textpanel_bg_color"] = "#" . $options["title_background_color_grid"];
$gallery_options["tile_textpanel_bg_opacity"] = $options["title_background_opacity_grid"] / 100;
$gallery_options["tile_border_width"] = $options["border_width_grid"];
$gallery_options["tile_border_color"] = "#" . $options["border_color_grid"];
$gallery_options["tile_border_radius"] = $options["border_radius_grid"];
$gallery_options["tile_enable_overlay"] = $options["on_hover_overlay_grid"];
$gallery_options["tile_enable_icons"] = $options["show_icons_grid"];
$gallery_options["tile_enable_image_effect"] = true;
$gallery_options["tile_show_link_icon"] = $options["show_link_icon_grid"];
$gallery_options["tile_as_link"] = $options["item_as_link_grid"];
$gallery_options["tile_link_newpage"] = $options["link_new_tab_grid"];
$gallery_options["tile_image_effect_type"] = $options["image_hover_effect_grid"];
$gallery_options["tile_image_effect_reverse"] = $options["image_hover_effect_reverse_grid"];
$gallery_options["tile_enable_shadow"] = $options["shadow_grid"];


$gallery_options["theme_navigation_type"] = $options["nav_type_grid"];
$gallery_options["theme_bullets_margin_top"] = (int)$options["bullets_margin_grid"];
$gallery_options["theme_bullets_color"] = $options["bullets_color_grid"];
$gallery_options["bullets_space_between"] = (int)$options["bullets_space_between_grid"];
$gallery_options["theme_arrows_margin_top"] = (int)$options["arrows_margin_grid"];
$gallery_options["theme_space_between_arrows"] = (int)$options["arrows_space_between_grid"];
$gallery_options["theme_navigation_align"] = $options["nav_position_grid"];
$gallery_options["theme_navigation_offset_hor"] = (int)$options["nav_offset_greed"];

$lt = $options["lightbox_type_grid"];
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

wp_enqueue_script("gdgallerygrid", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-tilesgrid.js", array('jquery'), false, true);

?>

<div id="gdgallery_container_<?= $gallery_data->id_gallery ?>" style="display:none;" data-view="grid">

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

<script type="text/javascript">

    jQuery(document).ready(function () {

        var container = jQuery("#gdgallery_container_<?= $gallery_data->id_gallery ?>");

        container.unitegallery(<?= $json ?>);

    });

</script>