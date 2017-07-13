<?php

namespace GDGallery\Controllers\Admin;

use GDGallery\Core\Admin\Listener;
use GDGallery\Helpers\View;
use GDGallery\Models\Gallery;

//use GDGALLERY\Models\Form;
//use GDGALLERY\Models\Submission;

class AdminController
{
    use Listener;
    /**
     * Array of pages in admin
     *
     * @var array
     */
    public $Pages;

    public function __construct()
    {

        /* if (!empty($_POST)) {
             \debug\debug::trace($_POST);
         }*/

        add_action('admin_footer', array('GDGallery\Controllers\Admin\ShortcodeController', 'showInlinePopup'));

        add_action('media_buttons_context', array('GDGallery\Controllers\Admin\ShortcodeController', 'showEditorMediaButton'));

        add_action('admin_menu', array($this, 'adminMenu'), 1);

        add_action('admin_init', array(__CLASS__, 'deleteGallery'), 1);

        add_action('admin_init', array(__CLASS__, 'duplicateForm'), 1);

        add_action('admin_init', array(__CLASS__, 'createGallery'), 1);

    }


    /**
     * Add admin menu pages
     */
    public function adminMenu()
    {
        $this->Pages['main_page'] = add_menu_page(__('Grand Gallery', GDGALLERY_TEXT_DOMAIN), __('Grand Gallery', GDGALLERY_TEXT_DOMAIN), 'manage_options', 'gdgallery', array(
            $this,
            'mainPage'
        ), \GDGALLERY()->pluginUrl() . '/assets/images/gallery_logo.png');

        $this->Pages['styles'] = add_submenu_page('gdgallery', __('Themes / Styles', GDGALLERY_TEXT_DOMAIN), __('Themes / Styles', GDGALLERY_TEXT_DOMAIN), 'manage_options', 'gdgallery_styles', array(
            $this,
            'stylesPage'
        ));

        $this->Pages['settings'] = add_submenu_page('gdgallery', __('Settings', GDGALLERY_TEXT_DOMAIN), __('Settings', GDGALLERY_TEXT_DOMAIN), 'manage_options', 'gdgallery_settings', array(
            $this,
            'settingsPage'
        ));
    }

    /**
     * Initialize main page
     */
    public function mainPage()
    {

        View::render('admin/header-banner.php', ["key"]);

        if (!isset($_GET['task'])) {

            View::render('admin/galleries-list.php');

        } else {

            $task = $_GET['task'];

            switch ($task) {
                case 'edit_gallery':


                    if (!isset($_GET['id'])) {

                        \GDGallery()->Admin->printError(__('Missing "id" parameter.', GDGALLERY_TEXT_DOMAIN));

                    }

                    $id = absint($_GET['id']);

                    if (!$id) {

                        \GDGALLERY()->Admin->printError(__('"id" parameter must be not negative integer.', GDGALLERY_TEXT_DOMAIN));

                    }

                    $gallery = new Gallery(array('id_gallery' => $id));

                    View::render('admin/edit-gallery.php', array('gallery' => $gallery));

                    break;
                case 'edit_form_settings':
                    $id = $_GET['id'];

                    if (absint($id) != $id) {

                        \GDGallery()->Admin->printError(__('Id parameter must be non negative integer.', GDGALLERY_TEXT_DOMAIN));

                    }

                    $form = new Form(array('Id' => $id));

                    View::render('admin/form-settings.php', array('form' => $form));

                    break;

            }

        }

    }


    public function submissionsPage()
    {
        if (self::isRequest('gdfrm_submissions', 'view_submission', 'GET')) {
            if (!isset($_GET['id'])) {
                wp_die(__('"id" parameter is required', GDFRM_TEXT_DOMAIN));
            }

            $id = $_GET['id'];

            if (absint($id) != $id) {
                wp_die(__('"id" parameter must be non negative integer', GDFRM_TEXT_DOMAIN));
            }

            if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'gdfrm_view_submission_' . $id)) {
                wp_die(__('Security check failed', GDFRM_TEXT_DOMAIN));
            }


            $submission = new Submission(array('Id' => $id));

            $submission->setViewed(1);

            $submission->save();

            View::render('admin/view-submission.php', compact('submission'));

            return;
        } else {
            View::render('admin/submissions.php');
        }
    }


    public function settingsPage()
    {

        View::render('admin/settings.php');

    }

    public function stylesPage()
    {
        View::render('admin/header-banner.php');

        $builder = new SettingsController();

        // View::render('admin/styles.php', ["settings" => $options]);
    }


    public function printError($error_message, $die = true)
    {

        $str = sprintf('<div class="error"><p>%s&nbsp;<a href="#" onclick="window.history.back()">%s</a></p></div>', $error_message, __('Go back', GDGALLERY_TEXT_DOMAIN));

        if ($die) {

            wp_die($str);

        } else {
            echo $str;
        }

    }

    public static function deleteGallery()
    {
        if (!self::isRequest('gdgallery', 'remove_gallery', 'GET')) {
            return;
        }

        if (!isset($_GET['id'])) {
            wp_die(__('"id" parameter is required', GDGALLERY_TEXT_DOMAIN));
        }

        $id = $_GET['id'];

        if (absint($id) != $id) {
            wp_die(__('"id" parameter must be non negative integer', GDGALLERY_TEXT_DOMAIN));
        }

        if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'gdgallery_remove_gallery_' . $id)) {
            wp_die(__('Security check failed', GDGALLERY_TEXT_DOMAIN));
        }

        Gallery::delete($id);

        $location = admin_url('admin.php?page=gdgallery');


        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header("Location: $location");

        exit;

    }


    public static function DuplicateForm()
    {
        if (!self::isRequest('gdgallery', 'duplicate_gallery', 'GET')) {
            return;
        }

        if (!isset($_GET['id'])) {

            \GDGALLERY()->Admin->printError(__('Missing "id" parameter.', GDGALLERY_TEXT_DOMAIN));

        }

        $id = absint($_GET['id']);

        if (!$id) {

            \GDGALLERY()->Admin->printError(__('"id" parameter must be not negative integer.', GDGALLERY_TEXT_DOMAIN));

        }

        if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'gdgallery_duplicate_gallery_' . $id)) {

            \GDGALLERY()->Admin->printError(__('Security check failed.', GDGALLERY_TEXT_DOMAIN));

        }

        ////  continue here

        $gallery = new Gallery(array('Id' => $id));

        $fields = $gallery->getFields();

        $gallery->unsetId();

        $gallery->setName('Copy of ' . $gallery->getName());

        $gallery = $gallery->save();

        /**
         * after the form is created we need to redirect user to the edit page
         */
        if ($gallery && is_int($gallery)) {
            /* copy form fields to the new form */
            if (!empty($fields)) {
                foreach ($fields as $field) {
                    $newfield = clone $field;

                    $newfield->setForm($gallery);

                    $newfield->save();
                }
            }

            $location = admin_url('admin.php?page=gdfrm&task=edit_form&id=' . $gallery);

            $location = wp_nonce_url($location, 'gdfrm_edit_form_' . $gallery);

            $location = html_entity_decode($location);

            header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            header("Location: $location");

            exit;

        } else {

            wp_die(__('Problems occured while creating new form.', GDFRM_TEXT_DOMAIN));

        }

    }

    public static function createGallery()
    {
        if (!self::isRequest('gdgallery', 'create_new_gallery', 'GET')) {
            return;
        }

        if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'gdgallery_create_new_gallery')) {

            \GDGallery()->admin->printError(__('Security check failed.', GDGALLERY_TEXT_DOMAIN));

        }

        $gallery = new Gallery();

        $gallery = $gallery->setName('New Created Gallery')->save();

        /**
         * after the gallery is created we need to redirect user to the edit page
         */
        if ($gallery && is_int($gallery)) {

            $location = admin_url('admin.php?page=gdgallery&task=edit_gallery&id=' . $gallery);

            $location = wp_nonce_url($location, 'gdgallery_edit_gallery_' . $gallery);

            $location = html_entity_decode($location);

            header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            header("Location: $location");

            exit;

        } else {

            wp_die(__('Problems occured while creating new gallery.', GDGALLERY_TEXT_DOMAIN));

        }

    }


}