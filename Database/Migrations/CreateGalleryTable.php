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
            "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "GDGalleryGalleries(
                `id_gallery` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NULL,
                `description` text,
                `ordering` int(11) NOT NULL,
                `display_type` int(1) NOT NULL DEFAULT 0,
                `view_type` int(1) NOT NULL DEFAULT 0,
                `position` ENUM('center', 'left','right') DEFAULT 'center',
                `hover_effect` int(1) NOT NULL DEFAULT 0,
                `custom_css` TEXT,
                `ctime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
                PRIMARY KEY (id_gallery)
            ) ENGINE=InnoDB "
        );
    }
}