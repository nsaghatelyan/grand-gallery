<?php
/**
 * @var gallery_data string
 * @var images array
 */

$gallery_options = array();
if ($options["show_title_carousel"] == 0) {
    $gallery_options["tile_enable_textpanel"] = true;
    $gallery_options["tile_textpanel_always_on"] = true;
} elseif ($options["show_title_carousel"] == 1) {
    $gallery_options["tile_enable_textpanel"] = true;
}

if ($options["show_background_carousel"] == 1) {
    $gallery_options["gallery_background_color"] = "#" . $options["background_color_carousel"];
}

$gallery_options["lightbox_type"] = $options["lightbox_type_carousel"];
$gallery_options["tile_textpanel_title_text_align"] = $options["title_position_carousel"];
$gallery_options["tile_textpanel_title_font_size"] = $options["title_size_carousel"];
$gallery_options["tile_textpanel_title_color"] = "#" . $options["title_color_carousel"];
$gallery_options["tile_textpanel_bg_color"] = "#" . $options["title_background_color_carousel"];
$gallery_options["tile_textpanel_bg_opacity"] = $options["title_background_opacity_carousel"] / 100;
$gallery_options["tile_width"] = (int)$options["width_carousel"];
$gallery_options["tile_height"] = $options["height_carousel"];
$gallery_options["carousel_space_between_tiles"] = (int)$options["margin_carousel"];
$gallery_options["tile_enable_border"] = true;
$gallery_options["tile_border_width"] = $options["border_width_carousel"];
$gallery_options["tile_border_color"] = "#" . $options["border_color_carousel"];
$gallery_options["tile_border_radius"] = $options["border_radius_carousel"];
$gallery_options["tile_enable_overlay"] = $options["on_hover_overlay_carousel"];
$gallery_options["tile_enable_icons"] = $options["show_icons_carousel"];
$gallery_options["tile_enable_image_effect"] = true;
$gallery_options["tile_image_effect_type"] = $options["image_hover_effect_carousel"];
$gallery_options["tile_image_effect_reverse"] = $options["image_hover_effect_reverse_carousel"];
$gallery_options["tile_enable_shadow"] = $options["shadow_carousel"];
$gallery_options["tile_show_link_icon"] = $options["show_link_icon_carousel"];
$gallery_options["tile_as_link"] = $options["item_as_link_carousel"];
$gallery_options["tile_textpanel_appear_type"] = $options["title_appear_type_carousel"];
$gallery_options["tile_textpanel_position"] = $options["title_vertical_position_carousel"];
$gallery_options["tile_link_newpage"] = $options["link_new_tab_carousel"];
$gallery_options["tile_enable_outline"] = false;
$gallery_options["theme_carousel_align"] = $options["position_carousel"];

$gallery_options["carousel_navigation_numtiles"] = (int)$options["nav_num_carousel"];
$gallery_options["carousel_scroll_duration"] = (int)$options["scroll_duration_carousel"];
$gallery_options["carousel_autoplay"] = $options["autoplay_carousel"];
$gallery_options["carousel_autoplay_timeout"] = $options["autoplay_timeout_carousel"];
$gallery_options["carousel_autoplay_direction"] = $options["autoplay_direction_carousel"];
$gallery_options["carousel_autoplay_pause_onhover"] = $options["autoplay_pause_hover_carousel"];
$gallery_options["theme_enable_navigation"] = $options["enable_nav_carousel"];
$gallery_options["theme_navigation_position"] = $options["nav_vertical_position_carousel"];
$gallery_options["theme_navigation_align"] = $options["nav_horisontal_position_carousel"];
$gallery_options["theme_navigation_enable_play"] = $options["paly_icon_carousel"];
$gallery_options["theme_space_between_arrows"] = $options["icon_space_carousel"];

$lt = $options["lightbox_type_carousel"];
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

wp_enqueue_script("gdgallerycarousel", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-carousel.js", array('jquery'), false, true);

?>


<div id="gdgallery_container_<?= $gallery_data->id_gallery ?>" style="display:none;" data-view="carousel">

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