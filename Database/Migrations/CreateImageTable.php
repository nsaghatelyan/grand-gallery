<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/3/2017
 * Time: 4:09 PM
 */
namespace GDGallery\Database\Migrations;

class CreateImageTable
{
    public static function run()
    {
        global $wpdb;

        $wpdb->query(
            "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "GDGalleryImages(
                `id_image` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_gallery` int(11) UNSIGNED NOT NULL,
                `name` varchar(255) NULL,
                `description` text,
                `ordering` int(11) NOT NULL,
                `link` varchar(255) NULL,
                `url` varchar(255) NOT NULL,
                `target` ENUM('_blank', '_self','_top','_parent') DEFAULT '_blank',
                `type` ENUM('image', 'video') DEFAULT 'image',
                `ctime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id_image),
				FOREIGN KEY (id_gallery) REFERENCES " . $wpdb->prefix . "GDGalleryGalleries (id_gallery) ON DELETE CASCADE
            ) ENGINE=InnoDB "
        );
    }
}