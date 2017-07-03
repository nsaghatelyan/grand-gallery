<?php
namespace GDGallery;

if (!define('ABSPATH')) {
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
        private $MigrationClasses;

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
         * Main gdfrm Instance.
         *
         * Ensures only one instance of gdfrm is loaded or can be loaded.
         *
         * @static
         * @see gdfrm()
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
        }
    }

endif;