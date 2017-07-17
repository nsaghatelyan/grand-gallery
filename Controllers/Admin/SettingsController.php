<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/13/2017
 * Time: 10:00 AM
 */

namespace GDGALLERY\Controllers\Admin;

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
            "grid" => array('title' => __('Grid', 'gdgallery'))
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


        ));

        $builder->addFields(array(
            /*********** Justify options  ****************/
            'show_title_justified' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Show / Hide Title')
            ),
            'margin_justified' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Element Margin')
            ),
            'row_height_justified' => array(
                'type' => 'number',
                'label' => __('Row height', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Row height')
            ),
            'load_more_text_justified' => array(
                'type' => 'text',
                'label' => __('Load more text', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Load more text')
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
                'help' => __('Load more position')
            ),
            'load_more_font_size_justified' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Font size')
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
                'help' => __('Pagination position')
            ),
            'pagination_font_size_justified' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Font size')
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
            \GDLightbox()->settings->setOption($key, $value);
        }

        echo 'ok';
        die;
    }

}