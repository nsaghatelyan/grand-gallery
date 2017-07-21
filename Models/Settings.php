<?php

namespace GDGallery\Models;


class Settings
{

    private $tableName;

    /**
     * @var []
     */
    private $options = array();

    private $defaultOptions = array(
        /************* Justified ***********/
        'show_title_justified' => 'b:0',
        'title_color_justified' => 'FFFFFF',
        'margin_justified' => '0',
        'row_height_justified' => '150',
        'load_more_text_justified' => 'Load More',
        'load_more_position_justified' => 'center',
        'load_more_font_size_justified' => '15',
        'pagination_position_justified' => 'center',
        'pagination_font_size_justified' => '15',

        /************* Tiles ***********/
        'show_title_tiles' => 'b:0',
        'margin_tiles' => '0',
        'width_tiles' => '100',
        'load_more_text_tiles' => 'Load More',
        'load_more_position_tiles' => 'center',
        'load_more_font_size_tiles' => '15',
        'pagination_position_tiles' => 'center',
        'pagination_font_size_tiles' => '15',

        /************* Carousel ***********/
        'show_title_carousel' => 'b:0',
        'margin_carousel' => '0',
        'width_carousel' => '100',
        'height_carousel' => '100',
        'icons_carousel' => '0',

        /************* Slider ***********/
        'show_title_slider' => 'b:0',
        'icons_slider' => '0',

        /************* Grid ***********/
        'show_title_grid' => 'b:0',
        'margin_grid' => '0',
        'height_grid' => '100',
        'width_grid' => '100',
        'load_more_text_grid' => 'Load More',
        'load_more_position_grid' => 'center',
        'load_more_font_size_grid' => '15',
        'pagination_position_grid' => 'center',
        'pagination_font_size_grid' => '15',

        /************* One and Others ***********/
        'show_title_one_and_others' => 'b:0',
        'icons_one_and_others' => '0',

    );

    public function __construct()
    {
        global $wpdb;
        $this->tableName = $wpdb->prefix . 'gdgallerysettings';

        $dbResults = $wpdb->get_results("SELECT * FROM `" . $this->tableName . "`", ARRAY_A);

        if (!empty($dbResults)) {
            foreach ($dbResults as $r) {

                $unserialized_value = @unserialize($r['option_value']);

                if (false !== $unserialized_value || 'b:0;' === $r['option_value']) {
                    $r['option_value'] = $unserialized_value;
                }

                $this->options[$r['option_key']] = $r['option_value'];
            }
        }
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getOption($key)
    {
        if (!isset($this->options[$key])) {
            return null;
        }
        return $this->options[$key];
    }

    public function setOption($key, $value)
    {
        global $wpdb;

        $key = sanitize_text_field($key);

        if (is_array($value) || is_object($value) || is_bool($value)) {
            $value = serialize($value);
        }

        if ($value === 'true') {
            $value = 'b:1;';
        } elseif ($value === 'false') {
            $value = 'b:0;';
        }

        $saved = $wpdb->query($wpdb->prepare('INSERT INTO ' . $this->tableName . ' (option_key,option_value) VALUES(%s,%s) ON DUPLICATE KEY UPDATE option_value=%s', $key, $value, $value));


        if (false !== $saved) {
            $this->options[$key] = $value;
        }

        return true;

    }

}