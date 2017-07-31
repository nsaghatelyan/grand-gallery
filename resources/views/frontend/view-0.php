<?php
/**
 * @var gallery_data string
 * @var images array
 */

$page_options = array(
    "nav_type" => $options["pagination_nav_type_justified"],
    "nav_text" => $options["pagination_nav_text_justified"],
    "nearby" => $options["pagination_nearby_pages_justified"]
);

$gallery_options = array();

$gallery_options["tiles_type"] = 'justified';
if ($options["show_title_justified"] == 0) {
    $gallery_options["tile_enable_textpanel"] = true;
    $gallery_options["tile_textpanel_always_on"] = true;
} elseif ($options["show_title_justified"] == 1) {
    $gallery_options["tile_enable_textpanel"] = true;
}


$gallery_options["lightbox_type"] = $options["lightbox_type_justified"];
$gallery_options["tile_textpanel_title_text_align"] = $options["title_position_justified"];
$gallery_options["tile_textpanel_title_color"] = "#" . $options["title_color_justified"];
$gallery_options["tile_textpanel_bg_color"] = "#" . $options["title_background_color_justified"];
$gallery_options["tile_textpanel_bg_opacity"] = $options["title_background_opacity_justified"] / 100;
$gallery_options["tiles_justified_space_between"] = (int)$options["margin_justified"];
$gallery_options["tile_enable_border"] = true;
$gallery_options["tile_border_width"] = $options["border_width_justified"];
$gallery_options["tile_border_color"] = "#" . $options["border_color_justified"];
$gallery_options["tile_border_radius"] = $options["border_radius_justified"];
$gallery_options["tile_enable_overlay"] = $options["on_hover_overlay_justified"];
$gallery_options["tile_enable_icons"] = $options["show_icons_justified"];
$gallery_options["tile_enable_image_effect"] = true;
$gallery_options["tile_image_effect_type"] = $options["image_hover_effect_justified"];
$gallery_options["tile_image_effect_reverse"] = $options["image_hover_effect_reverse_justified"];
$gallery_options["tile_enable_shadow"] = $options["shadow_justified"];
$gallery_options["tile_show_link_icon"] = $options["show_link_icon_justified"];
$gallery_options["tile_as_link"] = $options["item_as_link_justified"];
$gallery_options["tile_textpanel_appear_type"] = $options["title_appear_type_justified"];
$gallery_options["tile_textpanel_position"] = $options["title_vertical_position_justified"];
$gallery_options["tile_link_newpage"] = $options["link_new_tab_justified"];


$json = json_encode($gallery_options);

wp_enqueue_script("gdgalleryjustified", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-tiles.js", array('jquery'), false, true);
?>

<div id="gdgallery_container_<?= $gallery_data->id_gallery ?>" style="display:none;" data-view="justified">

    <?php foreach ($images as $key => $val):
        $video_id = ($val->type == "image") ? "" : "data-videoid = '" . $val->video_id . "'";
        ?>
        <a href="<?= $val->link ?>" target="<?= $val->target ?>">
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
                class="gdgallery_load_more"><?= $options["load_more_text_justified"] ?>
        </button>
    </div>
    <?php
} ?>


<script type="text/javascript">

    jQuery(document).ready(function () {

        var container = jQuery("#gdgallery_container_<?= $gallery_data->id_gallery ?>");

        var api = container.unitegallery(/*{
         lightbox_type: "compact",
         lightbox_hide_arrows_onvideoplay: true,			//hide the arrows when video start playing and show when stop
         lightbox_arrows_offset: 110,						//The horizontal offset of the arrows
         lightbox_overlay_color: "white",					//the color of the overlay. if null - will take from css
         lightbox_overlay_opacity: 0.8,						//the opacity of the overlay. for compact type - 0.6
         lightbox_show_numbers: true,					//show numbers on the right side
         lightbox_numbers_size: "25",					//the size of the numbers string
         lightbox_numbers_color: "#336699",					//the color of the numbers
         lightbox_slider_image_border: true,				//enable border around the image (for compact type only)
         lightbox_slider_image_border_width: 10,			//image border width
         lightbox_slider_image_border_color: "#336699",	//image border color
         lightbox_slider_image_border_radius: 10,			//image border radius
         lightbox_slider_image_shadow: true,             //enable border shadow the image
         lightbox_slider_control_swipe: true,				//true,false - enable swiping control
         lightbox_slider_control_zoom: true,				//true, false - enable zooming control

         lightbox_show_textpanel: true,						//show the text panel
         lightbox_textpanel_width: 1050,						//the width of the text panel. wide type only

         lightbox_textpanel_enable_title: true,				//enable the title text
         lightbox_textpanel_enable_description: true,		//enable the description text

         lightbox_textpanel_padding_top: 5,					//textpanel padding top
         lightbox_textpanel_padding_bottom: 5,				//textpanel padding bottom
         lightbox_textpanel_padding_right: 11,				//cut some space for text from right
         lightbox_textpanel_padding_left: 11,				//cut some space for text from left

         lightbox_textpanel_title_color: "red",				//textpanel title color. if null - take from css
         lightbox_textpanel_title_font_family: null,			//textpanel title font family. if null - take from css
         lightbox_textpanel_title_text_align: "left",			//textpanel title text align. if null - take from css
         lightbox_textpanel_title_font_size: "18",			//textpanel title font size. if null - take from css
         lightbox_textpanel_title_bold: true,					//textpanel title bold. if null - take from css

         lightbox_textpanel_desc_color: "yellow",					//textpanel description font family. if null - take from css
         lightbox_textpanel_desc_font_family: null,			//textpanel description font family. if null - take from css
         lightbox_textpanel_desc_text_align: null,			//textpanel description text align. if null - take from css
         lightbox_textpanel_desc_font_size: null,				//textpanel description font size. if null - take from css
         lightbox_textpanel_desc_bold: null,					//textpanel description bold. if null - take from css

         }*/<?= $json ?>);


    });

</script>