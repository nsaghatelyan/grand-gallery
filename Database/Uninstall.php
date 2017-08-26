<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/3/2017
 * Time: 4:00 PM
 */

namespace GDGallery\Database;

class Uninstall
{
    public static function init()
    {
        if (GDGallery()->settings->getOption('RemoveTablesUninstall') == "on") {
            self::run();
        }
    }

    public static function run()
    {
        global $wpdb;

        delete_option("gdgallery_version");

        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "gdgallerysettings`");
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "gdgalleryimages`");
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "gdgallerygalleries`");

    }
}