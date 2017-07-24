<?php

namespace GDGallery\Controllers\Frontend;

use GDGallery\Models\Gallery;
use GDGallery\Models\Settings;


class AjaxController
{

    public static function init()
    {
        add_action('wp_ajax_gdgallery_get_items', array(__CLASS__, 'getItems'));
        add_action('wp_ajax_nopriv_gdgallery_get_items', array(__CLASS__, 'getItems'));
    }


    public static function getItems()
    {
        global $wpdb;

        $id_gallery = intval($_REQUEST["id_gallery"]);
        $start = intval($_REQUEST["offset"]);

        if ($id_gallery <= 0) {
            return false;
        }

        $gallery = new Gallery(array("id_gallery" => $id_gallery));


        $data = $gallery->getGallery();
        $total_count = $gallery->getItemsCount();


        $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "gdgalleryimages where id_gallery = '%d' order by ordering ASC LIMIT " . $start, $id_gallery);
        $items = $wpdb->get_results($query);

        $show_button = (count($items) < $total_count) ? 1 : 0;

        echo json_encode(array(
            "success" => true,
            "data" => $items,
            "show_button" => $show_button
        ));
        die();
    }

}