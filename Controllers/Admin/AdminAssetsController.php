<?php

namespace GDGallery\Controllers\Admin;


class AdminAssetsController
{
    public static function init()
    {
        add_action('admin_enqueue_scripts', array(__CLASS__, 'adminStyles'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'adminScripts'));
    }

    /**
     * @param $hook
     */
    public static function adminStyles($hook)
    {

        wp_enqueue_style('jqueryUI', \GDGallery()->pluginUrl() . '/resources/assets/css/jquery-ui.min.css');

        wp_enqueue_style('fontAwesome', \GDGallery()->pluginUrl() . '/resources/assets/css/font-awesome.min.css', false);

        wp_enqueue_style('toastrjs', \GDGallery()->pluginUrl() . '/resources/assets/css/admin/toastr.css');

        if ($hook === \GDGallery()->Admin->Pages['main_page']) {
            wp_enqueue_style('gdfrmAdminStyles', \GDGallery()->pluginUrl() . '/resources/assets/css/admin/main.css');
        }


        if ($hook === \GDGallery()->Admin->Pages['main_page'] || $hook === \GDGallery()->Admin->Pages['styles'] || $hook === \GDGallery()->Admin->Pages['submissions']) {


            wp_enqueue_style('gdfrmSelect2', \GDGallery()->pluginUrl() . '/resources/assets/css/select2.min.css', false);

            wp_enqueue_style('gdgallery_modal', \GDGallery()->pluginUrl() . '/resources/assets/css/admin/gdgallery-modal.css', false);

//            wp_enqueue_style('gdgalleryBannerStyle', \GDGallery()->pluginUrl() . '/resources/assets/css/admin/banner.css');

            wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;subset=cyrillic');

        }

        if ($hook === \GDGallery()->Admin->Pages['settings']) {
            wp_enqueue_style('gdfrmSettings', \GDGallery()->pluginUrl() . '/resources/assets/css/admin/settings.css');
        }

        if ($hook === \GDGallery()->Admin->Pages['styles']) {
            wp_enqueue_style('gdgalleryStyleSettings', \GDGallery()->pluginUrl() . '/resources/assets/css/admin/style_settings.css');
        }

        if ($hook === \GDGallery()->Admin->Pages['submissions']) {
            wp_enqueue_style('gdfrmSubmissions', \GDGallery()->pluginUrl() . '/resources/assets/css/admin/submissions.css');
        }


        if (isset($_GET['task']) && $_GET['task'] == 'edit_form_settings') {


        }

    }

    /**
     * @param $hook
     */
    public static function adminScripts($hook)
    {
        wp_enqueue_script('jqueryUI', \GDGallery()->pluginUrl() . '/resources/assets/js/jquery-ui.min.js');

        if ($hook === \GDGallery()->Admin->Pages['main_page']) {

            wp_enqueue_media();

            wp_enqueue_script('jquery');

            wp_enqueue_script('toastrjs', \GDGallery()->pluginUrl() . '/resources/assets/js/admin/toastr.min.js');


            if (isset($_GET['task']) && $_GET['task'] == 'edit_gallery') {
                wp_enqueue_script('gdgallery_modal', \GDGallery()->pluginUrl() . '/resources/assets/js/admin/gdgallery_modal.js', array('jquery'), false, true);

                wp_enqueue_script('gdfrmAdminSelect2', \GDGallery()->pluginUrl() . '/resources/assets/js/select2.min.js', array('jquery', 'jqueryUI'), false, true);

                wp_enqueue_script('gdgalleryAdminGallerySave', \GDGallery()->pluginUrl() . '/resources/assets/js/admin/form-save.js', array('jquery', 'jqueryUI'), false, true);

            }


            if (isset($_GET['task']) && $_GET['task'] == 'edit_form_settings') {
                wp_enqueue_script('gdfrmFormSettings', \GDGallery()->pluginUrl() . '/resources/assets/js/admin/form-settings.js', array('jquery'), false, true);

            }

            wp_enqueue_script('gdfrmAdminJs', \GDGallery()->pluginUrl() . '/resources/assets/js/admin/main.js', array('jquery', 'jqueryUI'), false, true);
        }

        if (in_array($hook, array('post.php', 'post-new.php'))) {
            wp_enqueue_script("gdfrmInlinePopup", \GDGallery()->pluginUrl() . "/resources/assets/js/admin/inline-popup.js", array('jquery'), false, true);
        }

        if ($hook === \GDGallery()->Admin->Pages['settings']) {
            wp_enqueue_script('gdfrmSettings', \GDGallery()->pluginUrl() . '/resources/assets/js/admin/settings.js', array('jquery'), false, true);
        }

        if ($hook === \GDGallery()->Admin->Pages['styles']) {
            wp_enqueue_script('gdgallery_styles', \GDGallery()->pluginUrl() . '/resources/assets/js/admin/styles_settings.js');
        }


        if ($hook === \GDGallery()->Admin->Pages['submissions']) {
            wp_enqueue_script('gdfrmSubmissions', \GDGallery()->pluginUrl() . '/resources/assets/js/admin/submissions.js', array('jquery'), false, true);
        }

        self::localizeScripts();

    }

    public static function localizeScripts()
    {

        wp_localize_script('gdgalleryAdminGallerySave', 'gallerySave', array(
            'nonce' => wp_create_nonce('gdgallery_save_gallery'),
        ));

        wp_localize_script('gdfrmInlinePopup', 'inlinePopup', array(
            'nonce' => wp_create_nonce('gdfrm_save_shortcode_options'),
        ));

        wp_localize_script('gdgalleryAdminGallerySave', 'field', array(
            'removeNonce' => wp_create_nonce('gdfrm_remove_field'),
            'duplicateNonce' => wp_create_nonce('gdfrm_duplicate_field'),
            'saveNonce' => wp_create_nonce('gdfrm_save_field'),
            'addOptionNonce' => wp_create_nonce('gdfrm_add_field_option'),
            'removeOptionNonce' => wp_create_nonce('gdfrm_remove_field_option'),
            'importOptionsNonce' => wp_create_nonce('gdfrm_import_options'),
        ));

        wp_localize_script('gdfrmFormSettings', 'GDGallery', array(
            'saveSettingsNonce' => wp_create_nonce('gdfrm_save_form_settings'),
        ));

        wp_localize_script('gdfrmSettings', 'settingsSave', array(
            'nonce' => wp_create_nonce('gdfrm_save_settings'),
        ));

        wp_localize_script('gdfrmSubmissions', 'submission', array(
            'removeNonce' => wp_create_nonce('gdfrm_remove_submission'),
            'readNonce' => wp_create_nonce('gdfrm_read_submission'),
        ));

        wp_localize_script('gdfrmAdminJs', 'form', array(
            'removeNonce' => wp_create_nonce('gdfrm_remove_form'),
        ));


    }
}