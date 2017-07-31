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

        if (\GDGallery()->settings->getOption('RemoveTablesUninstall') == "on") {
            self::run();
        }
    }

    private function run()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "GDGalleryGalleries`");
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "GDGalleryImages`");
        $wpdb->query("DROP TABLE IF EXISTS `" . $wpdb->prefix . "GDGallerySettings`");
    }
}