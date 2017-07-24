<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/4/2017
 * Time: 10:31 AM
 */

namespace GDGallery\Models;

use GDGallery\Core\Model;
use GDGallery\GDGallery;

class Gallery extends Model
{
    protected static $tableName = 'GDGalleryGalleries';

    protected static $itemsTableName = 'gdgalleryimages';

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
        'name', 'description', 'display_type', 'ordering', 'display_type', 'view_type', 'position', 'hover_effect', 'items_per_page', 'custom_css'
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

    public static function getItemsTableName()
    {
        return $GLOBALS['wpdb']->prefix . self::$itemsTableName;
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


        $query = $wpdb->prepare("select * from `" . $wpdb->prefix . "gdgalleryimages` where id_gallery=%d order by ordering ASC", $this->Id);
        $items = $wpdb->get_results($query);

        foreach ($items as $key => $val) {
            if ($val->id_post != 0) {
                $post = get_post($val->id_post);
                $items[$key]->url = wp_get_attachment_url($post->ID);
                $items[$key]->name = $post->post_title;
            }
        }

        if (empty($items)) {
            return null;
        }

        $this->Items = $items;

        return $this->Items;
    }

    public function getItemsCount()
    {
        global $wpdb;

        $query = $wpdb->prepare("select COUNT(*) AS count from `" . $wpdb->prefix . "gdgalleryimages` where id_gallery=%d order by ordering ASC", $this->Id);
        return $wpdb->get_var($query);
    }

    /**
     * @return Field[]
     */
    public function getItemsPerPage($data)
    {
        global $wpdb;

        if ($data->items_per_page) {
            $num = $data->items_per_page;
        } else {
            $num = 999;
        }

        $items_count = $this->getItemsCount();

        $total = intval((($items_count - 1) / $num) + 1);

        if (isset($_GET["gdgallery-page"])) {
            $page = absint($_GET["gdgallery-page"]);
        } else {
            $page = '';
        }
        if (empty($page) or $page < 0) {
            $page = 1;
        }
        if ($page > $total) {
            $page = $total;
        }
        $start = $page * $num - $num;

        $query = $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "gdgalleryimages where id_gallery = '%d' order by ordering ASC LIMIT " . $start . "," . $num, $this->Id);
        $items = $wpdb->get_results($query);

        foreach ($items as $key => $val) {
            if ($val->id_post != 0) {
                $post = get_post($val->id_post);
                $items[$key]->url = wp_get_attachment_url($post->ID);
                $items[$key]->name = $post->post_title;
            }
        }

        if (empty($items)) {
            return null;
        }

        $this->Items = $items;

        return $this->Items;
    }

    public function duplicateGallery()
    {
        $gallery_data = (array)$this->getGallery(true);
        $gallery_items = (array)$this->getItems();
        unset($gallery_data["id_gallery"]);
        $gallery_data["name"] = $this->getName();
        array_walk($gallery_items, function ($item) {
            unset($item->id_image);
        });

        $id_gallery = $this->AddDuplicatedData($gallery_data, $gallery_items);

        return $id_gallery;
    }

    public function AddDuplicatedData($gallery, $items)
    {
        global $wpdb;

        $wpdb->insert($wpdb->prefix . "gdgallerygalleries", $gallery);
        $id_gallery = $wpdb->insert_id;

//        $id_gallery = 12;
        array_walk($items, function ($item) use ($id_gallery) {
            $item->id_gallery = $id_gallery;
        });
        foreach ($items as $item) {
            $wpdb->insert($wpdb->prefix . "gdgalleryimages", (array)$item);
        }

        return $id_gallery;
    }


    public function getVideoThumb($video_id, $type)
    {
        /*$default_thumbnail = null;
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
        );*/

        $thumbnail = null;

        if ($type == "youtube") {
            $thumbnail = "https://img.youtube.com/vi/" . $video_id . "/0.jpg";
        } elseif ($type == "vimeo") {
            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
            $thumbnail = $hash[0]['thumbnail_medium'];
        }

        return $thumbnail;

    }

    public
    function getGallery($duplicate = false)
    {
        global $wpdb;

        $query = $wpdb->prepare("select * from `" . $wpdb->prefix . "gdgallerygalleries` where id_gallery=%d order by ordering", $this->Id);
        $galleries = $wpdb->get_row($query);


        if ($duplicate == false) {
            $total = 0;
            if ($galleries->display_type == 2) {
                $items_count = $this->getItemsCount();
                $total = intval((($items_count - 1) / $galleries->items_per_page) + 1);
            }
            $galleries->total = $total;
        }


        if (empty($galleries)) {
            return null;
        }

        $this->Gallery = $galleries;

        return $this->Gallery;
    }

    public function getGalleriesUrl()
    {
        global $wpdb;
        $list = array();

        $query = $wpdb->prepare("select `id_gallery`,`name` from `" . $wpdb->prefix . "gdgallerygalleries` order by ordering", array());
        $galleries = $wpdb->get_results($query);
        foreach ($galleries as $val) {
            if ($val->id_gallery != $this->Id) {
                $EditUrl = admin_url('admin.php?page=gdgallery&task=edit_gallery&id=' . $val->id_gallery);
                $EditUrl = wp_nonce_url($EditUrl, 'gdgallery_edit_gallery_' . $val->id_gallery);
                $list[] = array(
                    "id_gallery" => $val->id_gallery,
                    "name" => $val->name,
                    "url" => $EditUrl
                );
            }
        }

        return $list;
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

    public function removeGalleryItems($data)
    {
        global $wpdb;

        foreach ($data as $key => $val) {
            $wpdb->delete($wpdb->prefix . "gdgalleryimages", array('id_image' => $val));
        }
        return static::$primaryKey;
    }

    public
    function AddGalleryImage($images, $id_gallery)
    {
        global $wpdb;

        foreach ($images as $img) {
            $wpdb->insert($wpdb->prefix . "gdgalleryimages", array(
                    "id_gallery" => $id_gallery,
                    "id_post" => intval($img["id"]),
                    "name" => esc_html($img["name"]),
                    'url' => esc_sql($img["url"]),
                    "ordering" => 0,
                    "target" => "_blank",
                    "type" => "image"
                )
            );
        }
        return static::$primaryKey;
    }


    public
    function AddGalleryVideo($data)
    {
        global $wpdb;

        $type = parent::getVideoType($data["gdgallery_video_url"]);
        $video_id = parent::getVideoId($data["gdgallery_video_url"], $type);
        $url = $this->getVideoThumb($video_id, $type);

        if ($type === false) {
            $type = "image";
        }

        $wpdb->insert($wpdb->prefix . "gdgalleryimages", array(
                "id_gallery" => $data["gdgallery_id_gallery"],
                "name" => $data["gdgallery_video_name"],
                "description" => $data["gdgallery_video_description"],
                'url' => esc_url($url),
                "ordering" => 0,
                "target" => $data["gdgallery_video_target"],
                "type" => $type,
                "video_id" => $video_id
            )
        );
        return static::$primaryKey;
    }

    public
    function setViewStyles()
    {
        $this->View_style = array(
            array("Jastified", GDGALLERY_IMAGES_URL . "icons/view/glossary.png"),
            array("Tiles", GDGALLERY_IMAGES_URL . "icons/view/pinterest.png"),
            array("Carousel", GDGALLERY_IMAGES_URL . "icons/view/slider_vertical.png"),
            array("Slider", GDGALLERY_IMAGES_URL . "icons/view/slider.png"),
            array("Grid", GDGALLERY_IMAGES_URL . "icons/view/grid.png"),
            array("One and others", GDGALLERY_IMAGES_URL . "icons/view/slider_horizontal.png")
            /* array("Container Popup", GDGALLERY_IMAGES_URL . "icons/view/popup.png"),
             array("Collapse", GDGALLERY_IMAGES_URL . "icons/view/collapse.png"),
             array("Timeline", GDGALLERY_IMAGES_URL . "icons/view/timeline.png"),
             array("Masonry", GDGALLERY_IMAGES_URL . "icons/view/masonry.png")*/
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