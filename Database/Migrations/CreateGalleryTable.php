<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/3/2017
 * Time: 4:09 PM
 */
namespace GDGallery\Database\Migrations;

class CreateGalleryTable
{
    public static function run()
    {
        global $wpdb;

        $wpdb->query(
            "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "gdgallerygalleries(
                `id_gallery` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NULL,
                `description` text,
                `ordering` int(11) NOT NULL DEFAULT 0,
                `order_by` int(1) NOT NULL DEFAULT 0,
                `sort_by` int(1) NOT NULL DEFAULT 0,
                `display_type` int(1) NOT NULL DEFAULT 0,
                `view_type` int(1) NOT NULL DEFAULT 0,
                `position` ENUM('center','left','right') DEFAULT 'center',
                `hover_effect` int(1) NOT NULL DEFAULT 0,
                `items_per_page` int(3) NOT NULL DEFAULT 5,
                `custom_css` TEXT,
                `ctime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
                PRIMARY KEY (id_gallery)
            ) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci "
        );

        /* $new_gallery = $wpdb->insert($wpdb->prefix . "gdgallerygalleries", array("name" => "My First test Gallery"));
         $default_images = array();
         for($i=1; $i < 14; $i++){
             $default_images[] = GDGALLERY_IMAGES_URL."project".$i.".jpg";
         }

         \GDGallery\Debug::trace($new_gallery);*/
    }
}