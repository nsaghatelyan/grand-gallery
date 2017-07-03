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
        if (\GDGallery()->Settings->get('RemoveTablesUninstall')) {
            self::run();
        }
    }

    private function run()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "GDGalleryGalleries`");
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "GDGalleryImages`");
    }
}