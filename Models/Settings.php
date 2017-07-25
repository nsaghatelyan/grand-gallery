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
        'lightbox_type_justified' => 'wide',
        'show_title_justified' => '0',
        'title_position_justified' => 'center',
        'title_vertical_position_justified' => 'inside_bottom',
        'title_appear_type_justified' => 'slide',
        'title_color_justified' => 'FFFFFF',
        'title_background_color_justified' => '333333',
        'title_background_opacity_justified' => '70',
        'margin_justified' => '10',
        'border_width_justified' => '0',
        'border_color_justified' => '333333',
        'border_radius_justified' => '0',
        'on_hover_overlay_justified' => 'b:1',
        'show_icons_justified' => 'b:1',
        'show_link_icon_justified' => 'b:0',
        'item_as_link_justified' => 'b:1',
        'link_new_tab_justified' => 'b:1',
        'image_hover_effect_justified' => 'blur',
        'image_hover_effect_reverse_justified' => 'b:0',
        'shadow_justified' => 'b:0',
        'load_more_text_justified' => 'Load More',
        'load_more_position_justified' => 'center',
        'load_more_font_size_justified' => '15',


        'load_more_vertical_padding_justified' => '8',
        'load_more_horisontal_padding_justified' => '13',
        'load_more_border_width_justified' => '1',
        'load_more_border_radius_justified' => '0',
        'load_more_color_justified' => 'FFFFFF',
        'load_more_background_color_justified' => '333333',
        'load_more_border_color_justified' => '333333',
        'load_more_font_family_justified' => 'monospace',
        'load_more_hover_color_justified' => '333333',
        'load_more_hover_background_color_justified' => 'FFFFFF',
        'load_more_hover_border_color_justified' => '333333',


        'pagination_position_justified' => 'center',
        'pagination_font_size_justified' => '15',
        'pagination_vertical_padding_justified' => '8',
        'pagination_horisontal_padding_justified' => '13',
        'pagination_margin_justified' => '3',
        'pagination_border_width_justified' => '1',
        'pagination_border_radius_justified' => '0',
        'pagination_border_color_justified' => '333333',
        'pagination_color_justified' => '333333',
        'pagination_background_color_justified' => 'FFFFFF',
        'pagination_font_family_justified' => 'monospace',
        'pagination_hover_border_color_justified' => '333333',
        'pagination_hover_color_justified' => 'FFFFFF',
        'pagination_hover_background_color_justified' => '333333',
        'pagination_nav_type_justified' => '0',
        'pagination_nav_text_justified' => 'first,prev,next,last',
        'pagination_nearby_pages_justified' => '2',

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