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
    public static function addScripts($FormId)
    {


        wp_enqueue_script("gdgalleryunite", \GDGallery()->pluginUrl() . "/resources/assets/js/frontend/unitegallery.min.js", array('jquery'), false, true);


        /* $Form = new Form(array('Id' => $FormId));

         wp_enqueue_script('jqueryUI', \GDGALLERY()->pluginUrl() . '/assets/js/jquery-ui.min.js');
         wp_enqueue_script('jqueryMask', \GDGALLERY()->pluginUrl() . '/assets/js/maskedInputs.js');
         wp_enqueue_script('select2', \GDGALLERY()->pluginUrl() . '/assets/js/select2.min.js', array('jquery', 'jqueryUI'), false, true);
         wp_enqueue_script('gdfrmFrontJs', \GDGALLERY()->pluginUrl() . '/assets/js/frontend/main.js',
             array(
                 'jquery', 'jqueryUI', 'jqueryMask', 'select2'
             ),
             false, true
         );

         if ($Form->getRecaptcha())
             wp_enqueue_script('gdfrm_recaptcha', 'https://www.google.com/recaptcha/api.js', array('jquery'), '1.0.0', true);*/

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
        wp_enqueue_style('gdgalleryunit', \GDGallery()->pluginUrl() . '/resources/assets/css/frontend/unite-gallery.css');

        /* wp_enqueue_style('jqueryUI', \GDGALLERY()->pluginUrl() . '/assets/css/jquery-ui.min.css');//todo
         wp_enqueue_style('flavorsFont', \GDGALLERY()->pluginUrl() . '/assets/css/flavorsFont.css');
         wp_enqueue_style('fontAwesome', \GDGALLERY()->pluginUrl() . '/assets/css/font-awesome.min.css');
         wp_enqueue_style('select2', \GDGALLERY()->pluginUrl() . '/assets/css/select2.min.css');
         wp_enqueue_style('gdfrmFrontCss', \GDGALLERY()->pluginUrl() . '/assets/css/frontend/main.css', array('jqueryUI', 'select2', 'flavorsFont', 'fontAwesome'));*/
    }

}