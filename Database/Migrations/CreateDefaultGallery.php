<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/3/2017
 * Time: 4:09 PM
 */
namespace GDGallery\Database\Migrations;

class CreateDefaultGallery
{
    public static function run()
    {
        global $wpdb;

        $galleries = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "gdgallerygalleries");
        //\GDGallery\Debug::trace($galleries);
        if ($galleries == 0) {
            $new_gallery = $wpdb->insert($wpdb->prefix . "gdgallerygalleries", array("name" => "My First test Gallery"));
            for ($i = 1; $i < 14; $i++) {
                $wpdb->insert($wpdb->prefix . "gdgalleryimages", array(
                        "id_gallery" => $new_gallery,
                        "name" => $i,
                        "url" => GDGALLERY_IMAGES_URL . "project/" . $i . ".jpg")
                );
            }
        }
    }
}