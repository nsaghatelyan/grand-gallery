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
            'show_title' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Show / Hide Title')
            )
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

}