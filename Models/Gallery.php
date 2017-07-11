<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/4/2017
 * Time: 10:31 AM
 */

namespace GDGallery\Models;

use GDGallery\Core\Model;

class Gallery extends Model
{
    protected static $tableName = 'GDGalleryGalleries';

    /**
     * Form Name
     *
     * @var string
     */
    private $Name;


    private $Items;


    private $Gallery;

    private $View_style;

    protected static $dbFields = array(
        'name', 'description', 'display_type', 'position', 'hover_style', 'custom_css'
    );

    public function __construct($args = array())
    {

        $this->setID($args["id_gallery"]);
        $this->setViewStyles();

        parent::__construct($args);


        if (null !== $this->Id) {

            $this->Gallery = $this->getGallery();

            $this->Name = $this->Gallery->name;

        } else {
            $this->Name = __('New Gallery', GDGALLERY_TEXT_DOMAIN);

            $this->DisplayTitle = 1;
        }

    }


    public function setId($id)
    {
        $this->Id = $id;
    }

    public function getId()
    {
        return $this->Id;
    }

    public function unsetId()
    {
        $this->Id = null;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return (!empty($this->Name) ? $this->Name : __('(no title)', GDGALLERY_TEXT_DOMAIN));
    }

    /**
     * @param string $name
     *
     * @return Gallery
     */
    public function setName($name)
    {
        $this->Name = sanitize_text_field($name);

        return $this;
    }

    /**
     * Edit link for current gallery
     */
    public function getEditLink()
    {

        if (is_null($this->Id)) {
            return false;
        }

        return admin_url('admin.php?page=gdgallery&task=edit_gallery&id=' . $this->Id);

    }

    /**
     * @return Field[]
     */
    public function getItems()
    {
        global $wpdb;

        $query = $wpdb->prepare("select * from `" . $wpdb->prefix . "gdgalleryimages` where id_gallery=%d order by ordering", $this->Id);
        $items = $wpdb->get_results($query);

        if (empty($items)) {
            return null;
        }

        $this->Items = $items;

        return $this->Items;
    }

    public function getGallery()
    {
        global $wpdb;

        $query = $wpdb->prepare("select * from `" . $wpdb->prefix . "gdgallerygalleries` where id_gallery=%d order by ordering", $this->Id);
        $galleries = $wpdb->get_row($query);


        if (empty($galleries)) {
            return null;
        }

        $this->Gallery = $galleries;

        return $this->Gallery;
    }

    public function saveGallery($data)
    {
        global $wpdb;
        $result = $wpdb->update(static::getTableName(), $data, array(static::$primaryKey => $data["id_gallery"]));

        if (false !== $result) {
            return static::$primaryKey;
        }

        return false;
    }

    public function saveGalleryImages($data)
    {
        global $wpdb;

        foreach ($data as $key => $val) {
            if ($key != "id_gallery") {
                foreach ($val as $k => $v) {
                    $wpdb->update($wpdb->prefix . "gdgalleryimages", array($key => $v), array(static::$primaryKey => $data["id_gallery"], "id_image" => $k));
                }
            }
        }
        return static::$primaryKey;
    }

    public function setViewStyles()
    {
        $this->View_style = array(
            array("Grid", GDGALLERY_IMAGES_URL . "icons/view/grid.png"),
            array("Container Popup", GDGALLERY_IMAGES_URL . "icons/view/popup.png"),
            array("Slider", GDGALLERY_IMAGES_URL . "icons/view/slider.png"),
            array("Glossary", GDGALLERY_IMAGES_URL . "icons/view/glossary.png"),
            array("Collapse", GDGALLERY_IMAGES_URL . "icons/view/collapse.png"),
            array("Pinterest", GDGALLERY_IMAGES_URL . "icons/view/pinterest.png"),
            array("Timeline", GDGALLERY_IMAGES_URL . "icons/view/timeline.png"),
            array("Masonry", GDGALLERY_IMAGES_URL . "icons/view/masonry.png"),
            array("One and others 1", GDGALLERY_IMAGES_URL . "icons/view/slider_vertical.png"),
            array("One and others 2", GDGALLERY_IMAGES_URL . "icons/view/slider_horizontal.png")
        );
    }

    public function getViewStyles()
    {
        return $this->View_style;
    }
}