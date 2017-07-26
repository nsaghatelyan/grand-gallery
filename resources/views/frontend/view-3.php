<?php
/**
 * @var gallery_data string
 * @var images array
 */

$gallery_options = array();

$gallery_options["gallery_images_preload_type"] = "minimal";
$gallery_options["gallery_width"] = $options["width_slider"];
$gallery_options["gallery_height"] = $options["height_slider"];

/*  add optiond here  */

wp_enqueue_script("gdgalleryslider", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/ug-theme-slider.js", array('jquery'), false, true);
?>


<h3>Slider Gallery</h3>

<div id="gdgallery_container_<?= $gallery_data->id_gallery ?>" style="display:none;" data-view="slider">

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

        container.unitegallery(/*{
         gallery_autoplay: true,						//true / false - begin slideshow autoplay on start
         gallery_play_interval: 10000,				//play interval of the slideshow
         gallery_pause_on_mouseover: true,
         slider_scale_mode: "fit",
         slider_transition: "fade",
         slider_transition_speed: 3000,
         slider_control_zoom: true,
         slider_loader_type: 2,
         slider_loader_color: "white",  //black
         slider_enable_bullets: true,
         slider_bullets_align_hor: "center",			//left, center, right - bullets horizontal align
         slider_bullets_align_vert: "bottom",
         slider_enable_arrows: true,
         slider_enable_progress_indicator: true,
         slider_progress_indicator_type: "pie", //bar
         slider_progress_indicator_align_hor: "right",  //left, center, right - progress indicator horizontal align
         slider_progress_indicator_align_vert: "top",  //top, middle, bottom - progress indicator vertical align
         slider_enable_play_button: true,
         slider_play_button_align_hor: "left",    	 //left, center, right - play button horizontal align
         slider_play_button_align_vert: "top",
         slider_enable_fullscreen_button: true,
         slider_fullscreen_button_align_hor: "left",   //left, center, right	- fullscreen button horizonatal align
         slider_fullscreen_button_align_vert: "top",
         slider_enable_zoom_panel: true,
         slider_zoompanel_align_hor: "right",    		 //left, center, right - zoom panel horizontal align
         slider_zoompanel_align_vert: "top",
         slider_controls_always_on: false,
         slider_videoplay_button_type: "round", //square
         slider_enable_text_panel: true,
         slider_textpanel_always_on: true,
         slider_textpanel_enable_title: true,			//enable the title text
         slider_textpanel_enable_description: true,		//enable the description text
         slider_textpanel_enable_bg: true,				//enable the textpanel background
         gallery_carousel: true,
         slider_textpanel_bg_color: "#000000",			//textpanel background color
         slider_textpanel_bg_opacity: 0.8,
         slider_textpanel_title_color: "#CC0000",
         slider_textpanel_desc_color: "yellow",
         }*/);

    });

</script>