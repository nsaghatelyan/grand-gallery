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

        if (\GDGallery()->settings->getOption('RemoveTablesUninstall') == "off") {
            self::run();
        }
    }

    private function run()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "gdgallerygalleries`");
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "gdgalleryimages`");
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "gdgallerysettings`");
    }
}