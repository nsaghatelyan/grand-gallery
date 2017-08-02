<?php

namespace GDGallery\Models;


class Settings
{

    private $tableName;

    /**
     * @var []
     */
    private $options = array();

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

    private $defaultOptions = array(

        'RemoveTablesUninstall' => 'off',

        /************* Justified ***********/
        'lightbox_type_justified' => 'wide',
        'show_title_justified' => '0',
        'title_position_justified' => 'center',
        'title_vertical_position_justified' => 'inside_bottom',
        'title_appear_type_justified' => 'slide',
        'title_size_justified' => '16',
        'title_color_justified' => 'FFFFFF',
        'title_background_color_justified' => '333333',
        'title_background_opacity_justified' => '70',
        'margin_justified' => '10',
        'border_width_justified' => '0',
        'border_color_justified' => '333333',
        'border_radius_justified' => '0',
        'on_hover_overlay_justified' => 'b:1;',
        'show_icons_justified' => 'b:1;',
        'show_link_icon_justified' => 'b:1;',
        'item_as_link_justified' => 'b:0;',
        'link_new_tab_justified' => 'b:1;',
        'image_hover_effect_justified' => 'blur',
        'image_hover_effect_reverse_justified' => 'b:0;',
        'shadow_justified' => 'b:0;',
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
        'lightbox_type_tiles' => 'wide',
        'show_title_tiles' => '0',
        'title_position_tiles' => 'center',
        'title_vertical_position_tiles' => 'inside_bottom',

        'title_appear_type_tiles' => 'slide',
        'title_size_tiles' => '16',
        'title_color_tiles' => 'FFFFFF',
        'title_background_color_tiles' => '333333',
        'title_background_opacity_tiles' => '70',
        'margin_tiles' => '10',
        'col_width_tiles' => '250',
        'min_col_tiles' => '2',
        'border_width_tiles' => '0',
        'border_color_tiles' => '333333',
        'border_radius_tiles' => '0',
        'on_hover_overlay_tiles' => 'b:1;',
        'show_icons_tiles' => 'b:1;',
        'show_link_icon_tiles' => 'b:1;',
        'item_as_link_tiles' => 'b:0;',
        'link_new_tab_tiles' => 'b:1;',
        'image_hover_effect_tiles' => 'blur',
        'image_hover_effect_reverse_tiles' => 'b:0;',
        'shadow_tiles' => 'b:0;',

        'load_more_text_tiles' => 'Load More',
        'load_more_position_tiles' => 'center',
        'load_more_font_size_tiles' => '15',
        'load_more_vertical_padding_tiles' => '8',
        'load_more_horisontal_padding_tiles' => '13',
        'load_more_border_width_tiles' => '1',
        'load_more_border_radius_tiles' => '0',
        'load_more_color_tiles' => 'FFFFFF',
        'load_more_background_color_tiles' => '333333',
        'load_more_border_color_tiles' => '333333',
        'load_more_font_family_tiles' => 'monospace',
        'load_more_hover_color_tiles' => '333333',
        'load_more_hover_background_color_tiles' => 'FFFFFF',
        'load_more_hover_border_color_tiles' => '333333',

        'pagination_position_tiles' => 'center',
        'pagination_font_size_tiles' => '15',
        'pagination_vertical_padding_tiles' => '8',
        'pagination_horisontal_padding_tiles' => '13',
        'pagination_margin_tiles' => '3',
        'pagination_border_width_tiles' => '1',
        'pagination_border_radius_tiles' => '0',
        'pagination_border_color_tiles' => '333333',
        'pagination_color_tiles' => '333333',
        'pagination_background_color_tiles' => 'FFFFFF',
        'pagination_font_family_tiles' => 'monospace',
        'pagination_hover_border_color_tiles' => '333333',
        'pagination_hover_color_tiles' => 'FFFFFF',
        'pagination_hover_background_color_tiles' => '333333',
        'pagination_nav_type_tiles' => '0',
        'pagination_nav_text_tiles' => 'first,prev,next,last',
        'pagination_nearby_pages_tiles' => '2',

        /************* Carousel ***********/
        'lightbox_type_carousel' => 'wide',
        'show_title_carousel' => '0',
        'title_position_carousel' => 'center',
        'title_vertical_position_carousel' => 'inside_bottom',

        'title_appear_type_carousel' => 'slide',
        'title_size_carousel' => '16',
        'title_color_carousel' => 'FFFFFF',
        'title_background_color_carousel' => '333333',
        'title_background_opacity_carousel' => '70',
        'width_carousel' => '200',
        'height_carousel' => '200',
        'margin_carousel' => '10',
        'position_carousel' => 'center',
        'show_background_carousel' => 'b:0;',
        'background_color_carousel' => 'FFFFFF',
        'border_width_carousel' => '0',
        'border_color_carousel' => '333333',
        'border_radius_carousel' => '0',
        'on_hover_overlay_carousel' => 'b:1;',
        'show_icons_carousel' => 'b:1;',
        'show_link_icon_carousel' => 'b:1;',
        'item_as_link_carousel' => 'b:0;',
        'link_new_tab_carousel' => 'b:1;',
        'image_hover_effect_carousel' => 'blur',
        'image_hover_effect_reverse_carousel' => 'b:0;',
        'shadow_carousel' => 'b:0;',

        'nav_num_carousel' => '1',
        'scroll_duration_carousel' => '500',
        'autoplay_carousel' => 'b:1;',
        'autoplay_timeout_carousel' => '3000',
        'autoplay_direction_carousel' => 'left',
        'autoplay_pause_hover_carousel' => 'b:1;',
        'enable_nav_carousel' => 'b:1;',
        'nav_vertical_position_carousel' => 'bottom',
        'nav_horisontal_position_carousel' => 'center',
        'paly_icon_carousel' => 'b:1;',
        'icon_space_carousel' => '20',


        /************* Grid ***********/
        'width_grid' => '200',
        'height_grid' => '200',
        'space_cols_grid' => '20',
        'space_rows_grid' => '20',
        'gallery_width_grid' => '100',
        'gallery_bg_grid' => 'b:1;',
        'gallery_bg_color_grid' => 'FFFFFF',
        'num_rows_grid' => '3',
        'show_title_grid' => '1',
        'title_position_grid' => 'left',
        'title_vertical_position_grid' => 'bottom',
        'title_appear_type_grid' => 'slide',
        'title_size_grid' => '16',
        'title_color_grid' => 'FFFFFF',
        'title_background_color_grid' => '333333',
        'title_background_opacity_grid' => '70',
        'border_width_grid' => '1',
        'border_color_grid' => '333333',
        'border_radius_grid' => '3',
        'on_hover_overlay_grid' => 'b:1;',
        'show_icons_grid' => 'b:1;',
        'show_link_icon_grid' => 'b:1;',
        'item_as_link_grid' => 'b:0;',
        'link_new_tab_grid' => 'b:1;',
        'image_hover_effect_grid' => 'blur',
        'image_hover_effect_reverse_grid' => 'b:0;',
        'shadow_grid' => 'b:1;',
        'nav_type_grid' => 'bullets',
        'bullets_margin_grid' => '50',
        'bullets_color_grid' => 'gray',
        'bullets_space_between_grid' => '15',
        'arrows_margin_grid' => '50',
        'arrows_space_between_grid' => '20',
        'nav_position_grid' => 'center',
        'nav_offset_greed' => '0',


        /************* Slider ***********/
        'width_slider' => '900',
        'height_slider' => '500',
        'autoplay_slider' => 'b:1;',
        'play_interval_slider' => '5000',
        'pause_on_hover_slider' => 'b:1;',
        'scale_mode_slider' => 'fill',
        'transition_slider' => 'slide',
        'transition_speed_slider' => '1500',
        'zoom_slider' => 'b:1;',
        'loader_type_slider' => '1',
        'loader_color_slider' => 'white',
        'bullets_slider' => 'b:1;',
        'bullets_horisontal_position_slider' => 'center',
        'bullets_vertical_position_slider' => 'bottom',
        'arrows_slider' => 'b:1;',
        'progress_indicator_slider' => 'b:1;',
        'progress_indicator_type_slider' => 'pie',
        'progress_indicator_horisontal_position_slider' => 'right',
        'progress_indicator_vertical_position_slider' => 'top',
        'play_slider' => 'b:0;',
        'play_horizontal_position_slider' => 'left',
        'play_vertical_position_slider' => 'top',
        'fullscreen_slider' => 'b:0;',
        'fullscreen_horisontal_position_slider' => 'left',
        'fullscreen_vertical_position_slider' => 'top',
        'zoom_panel_slider' => 'b:0;',
        'zoom_horisontal_panel_position_slider' => 'left',
        'zoom_vertical_panel_position_slider' => 'top',
        'controls_always_on_slider' => 'b:0;',
        'video_play_type_slider' => 'round',
        'text_panel_slider' => 'b:1;',
        'text_panel_always_on_slider' => 'b:0;',
        'text_title_slider' => 'b:1;',
        'text_description_slider' => 'b:1;',
        'text_panel_bg_slider' => 'b:1;',
        'carousel_slider' => 'b:1;',
        'text_panel_bg_color_slider' => '000000',
        'text_panel_bg_opacity_slider' => '70',
        'text_panel_title_size_slider' => '17',
        'text_panel_title_color_slider' => 'FFFFFF',
        'text_panel_desc_size_slider' => '14',
        'text_panel_desc_color_slider' => 'FFFFFF',
        'playlist_slider' => 'b:0;',
        'thumb_width_slider' => '88',
        'thumb_height_slider' => '50',
        'playlist_bg_slider' => '000000'

    );

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