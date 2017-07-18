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

    private $PostsPerPage;

    private $cache = array();

    private $DisplayTitle;

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


    public static function getTableName()
    {
        return $GLOBALS['wpdb']->prefix . self::$tableName;
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


        foreach ($items as $item) {
            if ($item->type == "video") {
                $item->thumbnail_info = $this->getVideoThumb($item->url);
            } else {
                $item->thumbnail_info = array();
            }
        }

        $this->Items = $items;

        return $this->Items;
    }

    public function getVideoThumb($url)
    {
        $default_thumbnail = null;
        $thumbnails = array();
        $result = array();

        if (strpos($url, "youtube") !== false) {
            $video_id = substr($url, -11);
            $default_thumbnail = "https://img.youtube.com/vi/" . $video_id . "/0.jpg";
            for ($i = 0; $i < 3; $i++) {
                $thumbnails[] = "https://img.youtube.com/vi/" . $video_id . "/" . $i . ".jpg";
            }
        } elseif (strpos($url, "vimeo") !== false) {
            $video_id = substr($url, -9);
            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
            $default_thumbnail = $hash[0]['thumbnail_medium'];
        }

        $result = array(
            "default_thumb" => $default_thumbnail,
            "thumbnails" => $thumbnails
        );

        return $result;

    }

    public
    function getGallery()
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

    public
    function saveGallery($data)
    {
        global $wpdb;
        $result = $wpdb->update(static::getTableName(), $data, array(static::$primaryKey => $data["id_gallery"]));

        if (false !== $result) {
            return static::$primaryKey;
        }

        return false;
    }

    public
    function saveGalleryImages($data)
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

    public
    function AddGalleryImage($img, $id_gallery)
    {
        global $wpdb;

        $wpdb->insert($wpdb->prefix . "gdgalleryimages", array(
                "id_gallery" => $id_gallery,
                'url' => esc_sql($img),
                "ordering" => 0,
                "target" => "_blank",
                "type" => "image"
            )
        );
        return static::$primaryKey;
    }

    public
    function AddGalleryVideo($data)
    {
        global $wpdb;

        $wpdb->insert($wpdb->prefix . "gdgalleryimages", array(
                "id_gallery" => $data["gdgallery_id_gallery"],
                "name" => $data["gdgallery_video_name"],
                "description" => $data["gdgallery_video_description"],
                'url' => esc_url($data["gdgallery_video_url"]),
                "ordering" => 0,
                "target" => $data["gdgallery_video_target"],
                "type" => "video"
            )
        );
        return static::$primaryKey;
    }

    public
    function setViewStyles()
    {
        $this->View_style = array(
            array("Jastified", GDGALLERY_IMAGES_URL . "icons/view/glossary.png"),
            array("Pinterest", GDGALLERY_IMAGES_URL . "icons/view/pinterest.png"),
            array("One and others 1", GDGALLERY_IMAGES_URL . "icons/view/slider_vertical.png"),
            array("Slider", GDGALLERY_IMAGES_URL . "icons/view/slider.png"),
            array("Grid", GDGALLERY_IMAGES_URL . "icons/view/grid.png"),
            array("One and others 2", GDGALLERY_IMAGES_URL . "icons/view/slider_horizontal.png"),
            array("Container Popup", GDGALLERY_IMAGES_URL . "icons/view/popup.png"),
            array("Collapse", GDGALLERY_IMAGES_URL . "icons/view/collapse.png"),
            array("Timeline", GDGALLERY_IMAGES_URL . "icons/view/timeline.png"),
            array("Masonry", GDGALLERY_IMAGES_URL . "icons/view/masonry.png")
        );
    }

    public
    function getViewStyles()
    {
        return $this->View_style;
    }

    /**
     * return string 0|1
     */
    public
    function getDisplayTitle()
    {
        return $this->DisplayTitle;
    }

    /**
     * @param $value int 0,1
     * @return $this
     */
    public
    function setDisplayTitle($value)
    {
        if (in_array($value, array(0, 1, 'on'))) {
            if ($value == 'on') $value = 1;

            $this->DisplayTitle = intval($value);
        }
        return $this;
    }

    /**
     * @param $key string
     * @param mixed $default
     * @return mixed
     */
    public
    function getData($key, $default = false)
    {
        if (!in_array($key, $this->cache)) {
            global $wpdb;
            $value = $wpdb->get_var($wpdb->prepare('select Value from ' . self::getTableName() . ' where Name=%s', $key));

            if (empty($value)) {
                $this->$key = $default;
            } else {
                $unserialized_value = @unserialize($value);

                if (false !== $unserialized_value || 'b:0;' === $value) {
                    $value = $unserialized_value;
                }

                $this->$key = $value;
            }


            $this->cache[] = $key;

        }

        return $this->$key;
    }

    /**
     * @param $key string
     * @param $value string
     * @return bool
     */
    public
    function set($key, $value)
    {
        global $wpdb;

        $option_exists = $this->getData($key);
        \debug::trace($option_exists);

        if ($option_exists) {
            $saved = $wpdb->update(self::getTableName(),
                array('Value' => esc_sql($value)),
                array('Name' => esc_sql($key))
            );
        } else {
            $saved = $wpdb->insert(self::getTableName(), array(
                    'Value' => esc_sql($value),
                    'Name' => esc_sql($key)
                )
            );
        }

        $this->$key = $value;

        return (bool)$saved;
    }

}