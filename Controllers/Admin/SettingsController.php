<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/13/2017
 * Time: 10:00 AM
 */

namespace GDGallery\Controllers\Admin;

use GDGallery\Helpers\SettingsPageBuilder;
use GDGallery\Helpers\View;
use GDGallery\Models\Gallery;


class SettingsController
{

    private $options;

    public function __construct()
    {
        $this->settingsFileds();
    }

    public function settingsFileds()
    {
        $builder = new SettingsPageBuilder();

        $builder->setPageTitle(__('Themes / Styles', 'gdgallery'));

        $builder->addTabs(array(
            "justified" => array('title' => __('Justified', 'gdgallery')),
            "tiles" => array('title' => __('Tiles', 'gdgallery')),
            "carousel" => array('title' => __('Carousel', 'gdgallery')),
            "slider" => array('title' => __('Slider', 'gdgallery')),
            "grid" => array('title' => __('Grid', 'gdgallery')),
            "one_and_others" => array('title' => __('One and Others', 'gdgallery'))
        ));

        $builder->addSections(array(
            'element_style_justified' => array(
                'title' => __('Element Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "justified"
            ),
            'load_more_justified' => array(
                'title' => __('Load More Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "justified"
            ),
            'pagination_justified' => array(
                'title' => __('Pagination Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "justified"
            ),
            'element_style_tiles' => array(
                'title' => __('Element Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "tiles"
            ),
            'load_more_tiles' => array(
                'title' => __('Load More Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "tiles"
            ),
            'pagination_tiles' => array(
                'title' => __('Pagination Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "tiles"
            ),
            'element_style_carousel' => array(
                'title' => __('Element Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "carousel"
            ),
            'components_carousel' => array(
                'title' => __('Components Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "carousel"
            ),
            'element_style_slider' => array(
                'title' => __('Element Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "slider"
            ),
            'components_slider' => array(
                'title' => __('Components Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "slider"
            ),
            'element_style_grid' => array(
                'title' => __('Element Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "grid"
            ),
            'load_more_grid' => array(
                'title' => __('Load More Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "grid"
            ),
            'pagination_grid' => array(
                'title' => __('Pagination Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "grid"
            ),
            'element_style_one_and_others' => array(
                'title' => __('Element Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "one_and_others"
            ),
            'components_one_and_others' => array(
                'title' => __('Components Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "one_and_others"
            ),


        ));

        $builder->addFields(array(
            /*********** Justify options  ****************/
            'show_title_justified' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Show / Hide Title', 'gdgallery')
            ),
            'title_color_justified' => array(
                'type' => 'color',
                'label' => __('Title color', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Choose Title Color', 'gdgallery')
            ),
            'margin_justified' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Element Margin', 'gdgallery')
            ),
            'row_height_justified' => array(
                'type' => 'number',
                'label' => __('Row height', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Row height', 'gdgallery')
            ),
            'load_more_text_justified' => array(
                'type' => 'text',
                'label' => __('Load more text', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Load more text', 'gdgallery')
            ),
            'load_more_position_justified' => array(
                'type' => 'select',
                'label' => __('Load more position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'load_more_justified',
                'help' => __('Load more position', 'gdgallery')
            ),
            'load_more_font_size_justified' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Font size', 'gdgallery')
            ),

            'pagination_position_justified' => array(
                'type' => 'select',
                'label' => __('Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'pagination_justified',
                'help' => __('Pagination position', 'gdgallery')
            ),
            'pagination_font_size_justified' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Font size', 'gdgallery')
            ),
            'pagination_vertical_padding_justified' => array(
                'type' => 'number',
                'label' => __('Vertical Padding', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Vertical Padding', 'gdgallery')
            ),
            'pagination_horisontal_padding_justified' => array(
                'type' => 'number',
                'label' => __('Horisontal Padding', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Horisontal Padding', 'gdgallery')
            ),
            'pagination_margin_justified' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Margin', 'gdgallery')
            ),
            'pagination_border_width_justified' => array(
                'type' => 'number',
                'label' => __('Border Width', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Border Width', 'gdgallery')
            ),
            'pagination_border_radius_justified' => array(
                'type' => 'number',
                'label' => __('Roundness of corners', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Roundness of corners', 'gdgallery')
            ),
            'pagination_border_color_justified' => array(
                'type' => 'color',
                'label' => __('Border Color', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Border Color', 'gdgallery')
            ),
            'pagination_color_justified' => array(
                'type' => 'color',
                'label' => __('Color', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Color', 'gdgallery')
            ),
            'pagination_background_color_justified' => array(
                'type' => 'color',
                'label' => __('Background Color', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Background Color', 'gdgallery')
            ),
            'pagination_font_family_justified' => array(
                'type' => 'select',
                'label' => __('Font Type', 'gdgallery'),
                'options' => array(
                    'monospace' => __('monospace', 'gdgallery'),
                    'cursive' => __('cursive', 'gdgallery'),
                    'fantasy' => __('fantasy', 'gdgallery'),
                    'sans-serif' => __('sans-serif', 'gdgallery'),
                    'serif' => __('serif', 'gdgallery'),
                ),
                'section' => 'pagination_justified',
                'help' => __('Font Type', 'gdgallery')
            ),
            'pagination_hover_border_color_justified' => array(
                'type' => 'color',
                'label' => __('On Hover Border Color', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Border Color', 'gdgallery')
            ),
            'pagination_hover_color_justified' => array(
                'type' => 'color',
                'label' => __('On Hover Color', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Color', 'gdgallery')
            ),
            'pagination_hover_background_color_justified' => array(
                'type' => 'color',
                'label' => __('On Hover Background Color', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Background Color', 'gdgallery')
            ),
            'pagination_nav_type_justified' => array(
                'type' => 'select',
                'label' => __('Navigation Type', 'gdgallery'),
                'options' => array(
                    '0' => __('Arrows', 'gdgallery'),
                    '1' => __('Text', 'gdgallery'),
                    '2' => __('Only Numbers', 'gdgallery')
                ),
                'section' => 'pagination_justified',
                'help' => __('Navigation Type', 'gdgallery')
            ),
            'pagination_nav_text_justified' => array(
                'type' => 'text',
                'label' => __('Navigation Text', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Navigation Text (with comma separetion)', 'gdgallery')
            ),
            'pagination_nearby_pages_justified' => array(
                'type' => 'select',
                'label' => __('Nearby Pages', 'gdgallery'),
                'options' => array(
                    'All' => __('All', 'gdgallery'),
                    '1' => "1",
                    '2' => "2",
                    '3' => "3",
                    '4' => "4",
                    '5' => "5",
                ),
                'section' => 'pagination_justified',
                'help' => __('Nearby Pages', 'gdgallery')
            ),


            /****************** tiles options *******************/
            'show_title_tiles' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Show / Hide Title')
            ),
            'margin_tiles' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Element Margin')
            ),
            'width_tiles' => array(
                'type' => 'number',
                'label' => __('Row height', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Element width')
            ),
            'load_more_text_tiles' => array(
                'type' => 'text',
                'label' => __('Load more text', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Load more text')
            ),
            'load_more_position_tiles' => array(
                'type' => 'select',
                'label' => __('Load more position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'load_more_tiles',
                'help' => __('Load more position')
            ),
            'load_more_font_size_tiles' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Font size')
            ),

            'pagination_position_tiles' => array(
                'type' => 'select',
                'label' => __('Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'pagination_tiles',
                'help' => __('Pagination position')
            ),
            'pagination_font_size_tiles' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Font size')
            ),

            /*****************  carousel options  ******************/
            'show_title_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Show / Hide Title')
            ),
            'margin_carousel' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Element Margin')
            ),
            'width_carousel' => array(
                'type' => 'number',
                'label' => __('Element width', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Element width')
            ),
            'height_carousel' => array(
                'type' => 'number',
                'label' => __('Element height', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Element height')
            ),
            'icons_carousel' => array(
                'type' => 'select',
                'label' => __('Icons style', 'gdgallery'),
                'options' => array(
                    '0' => __('style 1', 'gdgallery'),
                    '1' => __('style 2', 'gdgallery'),
                    '2' => __('style 3', 'gdgallery'),
                ),
                'section' => 'components_carousel',
                'help' => __('Icons style')
            ),
            /********* Slider options ************/
            'show_title_slider' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Show / Hide Title')
            ),
            'icons_slider' => array(
                'type' => 'select',
                'label' => __('Icons style', 'gdgallery'),
                'options' => array(
                    '0' => __('style 1', 'gdgallery'),
                    '1' => __('style 2', 'gdgallery'),
                    '2' => __('style 3', 'gdgallery'),
                ),
                'section' => 'components_slider',
                'help' => __('Icons style')
            ),
            /********************  Grid options  ***********************/
            'show_title_grid' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Show / Hide Title')
            ),
            'margin_grid' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Element Margin')
            ),
            'height_grid' => array(
                'type' => 'number',
                'label' => __('Element height', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Element height')
            ),
            'width_grid' => array(
                'type' => 'number',
                'label' => __('Element width', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Element width')
            ),
            'load_more_text_grid' => array(
                'type' => 'text',
                'label' => __('Load more text', 'gdgallery'),
                'section' => 'load_more_grid',
                'help' => __('Load more text')
            ),
            'load_more_position_grid' => array(
                'type' => 'select',
                'label' => __('Load more position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'load_more_grid',
                'help' => __('Load more position')
            ),
            'load_more_font_size_grid' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'load_more_grid',
                'help' => __('Font size')
            ),
            'pagination_position_grid' => array(
                'type' => 'select',
                'label' => __('Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'pagination_grid',
                'help' => __('Pagination position')
            ),
            'pagination_font_size_grid' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'pagination_grid',
                'help' => __('Font size')
            ),

            /********* One_and_others options ************/
            'show_title_one_and_others' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_one_and_others',
                'help' => __('Show / Hide Title')
            ),
            'icons_one_and_others' => array(
                'type' => 'select',
                'label' => __('Icons style', 'gdgallery'),
                'options' => array(
                    '0' => __('style 1', 'gdgallery'),
                    '1' => __('style 2', 'gdgallery'),
                    '2' => __('style 3', 'gdgallery'),
                ),
                'section' => 'components_one_and_others',
                'help' => __('Icons style')
            ),
        ));

        $builder->render();
        //$options = $builder->getOptions();
        // $this->setOption($options);
    }

    public function setOption($options)
    {
        $this->options = $options;
    }

    public function getOption()
    {
        return $this->options;
    }

    /**
     * Save settings
     */
    public static function save()
    {

        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'gdgallery_settings')) {
            die(0);
        }

        if (!isset($_POST['settings']) || empty($_POST['settings']) || !is_array($_POST['settings'])) {
            die(0);
        }

        foreach ($_POST['settings'] as $key => $value) {
            \GDGallery()->settings->setOption($key, $value);
        }

        echo 'ok';
        die;
    }

}