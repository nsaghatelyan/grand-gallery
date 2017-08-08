<?php
/**
 * Plugin Name: Grand Gallery
 * Author: GrandWP
 * Description: Easy to use Gallery Plugin
 * Version: 1.0.0
 * Domain Path: /languages
 * Text Domain: gdgallery
 */

error_reporting(E_ALL);

if (!defined('ABSPATH')) {
    exit();
}


require 'autoload.php';

require 'GDGallery.php';


/**
 * Main instance of GDGallery.
 *
 * Returns the main instance of GDGallery to prevent the need to use globals.
 *
 * @return \GDGallery\GDGallery
 */

function GDGallery()
{
    return \GDGallery\GDGallery::instance();
}

$GLOBALS['GDGallery'] = GDGallery();

register_uninstall_hook(__FILE__, array('GDGallery\Database\Uninstall', 'init'));
