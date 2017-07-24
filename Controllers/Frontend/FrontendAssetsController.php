<?php

namespace GDGallery\Controllers\Frontend;

use GDGallery\Models\Gallery;

class FrontendAssetsController
{

    public static function init()
    {
        add_action('gdgalleryShortcodeScripts', array(__CLASS__, 'addScripts'));

        add_action('gdgalleryShortcodeScripts', array(__CLASS__, 'addStyles'));

        add_action('wp_head', array(__CLASS__, 'addAjaxUrlJs'));

    }

    /**
     * Add Scripts
     *
     */
    public static function addScripts($GalleryId)
    {
        $gallery = new Gallery(array('Id' => $GalleryId));

        wp_enqueue_script("gdgalleryunite", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/unitegallery.min.js", array('jquery'), false, true);
        wp_enqueue_script('gdgalleryFrontJs', \GDGallery()->pluginUrl() . '/resources/assets/js/frontend/main.js', array('jquery'), false, true);

    }


    /**
     * Define the 'ajaxurl' JS variable, used by themes and plugins as an AJAX endpoint.
     *
     */
    public static function addAjaxUrlJs()
    {
        ?>

        <script
                type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php', is_ssl() ? 'admin' : 'http'); ?>';</script>
        <?php
    }

    /**
     * Add Styles
     */
    public static function addStyles()
    {
        wp_enqueue_style('fontAwesome', \GDGallery()->pluginUrl() . '/resources/assets/css/font-awesome.min.css', false);
        wp_enqueue_style('gdgalleryunit', \GDGallery()->pluginUrl() . '/resources/assets/css/frontend/unite-gallery.css');
    }

}