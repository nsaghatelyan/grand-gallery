<?php
namespace GDGallery;

use GDGallery\Models\Settings;
use GDGallery\Controllers\Admin\AdminController;
use GDGallery\Controllers\Frontend\FrontendController;
use GDGallery\Controllers\Admin\AdminAssetsController;
use GDGallery\Controllers\Admin\AjaxController as AdminAjax;
use GDGallery\Controllers\Frontend\AjaxController as FrontAjax;
use debug\debug;

if (!defined('ABSPATH')) {
    exit();
}

if (!class_exists('GDGallery')) :
    class GDGallery
    {
        /**
         * Version of plugin
         * @var string
         */
        public $version = "1.0.0";

        /**
         * Instance of AdminController to manage admin
         * @var AdminController instance
         */
        public $admin;

        /**
         * Classnames of migration classes
         *
         * @var array
         */
        private $migrationClasses;

        /**
         * @var Settings
         */
        public $Settings;

        /**
         * The single instance of the class.
         *
         * @var GDForm
         */
        protected static $_instance = null;

        /**
         * Main GDGALLERY Instance.
         *
         * Ensures only one instance of GDGALLERY is loaded or can be loaded.
         *
         * @static
         * @see GDGALLERY()
         * @return GDForm - Main instance.
         */
        public static function instance()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }


        private function __construct()
        {
            $this->constants();
            $this->migrationClasses = array(
                'GDGallery\Database\Migrations\CreateGalleryTable',
                'GDGallery\Database\Migrations\CreateImageTable'
            );
            add_action('init', array($this, 'init'), 0);
        }

        public function constants()
        {
            define('GDGALLERY_PLUGIN_FILE', __FILE__);
            define('GDGALLERY_PLUGIN_BASENAME', plugin_basename(__FILE__));
            define('GDGALLERY_VERSION', $this->version);
            define('GDGALLERY_IMAGES_PATH', $this->pluginPath() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR);
            define('GDGALLERY_IMAGES_URL', untrailingslashit($this->pluginUrl()) . '/assets/images/');
            define('GDGALLERY_FONTS_URL', untrailingslashit($this->pluginUrl()) . '/assets/fonts/');
            define('GDGALLERY_FONTS_PATH', $this->pluginPath() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR);
            define('GDGALLERY_TEMPLATES_PATH', $this->pluginPath() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
            define('GDGALLERY_TEMPLATES_URL', untrailingslashit($this->pluginUrl()) . '/templates/');
            define('GDGALLERY_TEXT_DOMAIN', 'GDGALLERY');
        }


        /**
         * Initialize the plugin
         */
        public function init()
        {
            $this->checkVersion();

            $this->Settings = new Settings();

            if (defined('DOING_AJAX')) {
                AdminAjax::init();
                FrontAjax::init();
            }

            if (is_admin()) {
                $this->Admin = new AdminController();
                AdminAssetsController::init();

            } else {
                new FrontendController();
            }
        }


        public function checkVersion()
        {
            if (get_option('gdgallery_version') !== $this->version) {
                $this->runMigrations();
                update_option('gdgallery_version', $this->version);
            }
        }

        private function runMigrations()
        {
            if (empty($this->migrationClasses)) {
                return;
            }

            foreach ($this->migrationClasses as $className) {
                if (method_exists($className, 'run')) {
                    call_user_func(array($className, 'run'));
                } else {
                    throw new \Exception('Specified migration class ' . $className . ' does not have "run" method');
                }
            }
        }

        /**
         * @return string
         */
        public function viewPath()
        {
            return apply_filters('gdgallery_view_path', 'GDGallery/');
        }

        /**
         * @return string
         */
        public function pluginPath()
        {
            return plugin_dir_path(__FILE__);
        }

        /**
         * @return string
         */
        public function pluginUrl()
        {
            return plugins_url('', __FILE__);
        }
    }

endif;