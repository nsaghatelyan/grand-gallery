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
            'lightbox_justified' => array(
                'title' => __('Lightbox Styles', 'gdgallery'),
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
            'lightbox_tiles' => array(
                'title' => __('Lightbox Styles', 'gdgallery'),
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
                'title' => __('Element Styles and Settings', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "carousel"
            ),
            'lightbox_carousel' => array(
                'title' => __('Lightbox Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "carousel"
            ),
            'components_carousel' => array(
                'title' => __('Navigation Settings', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "carousel"
            ),
            'element_style_slider' => array(
                'title' => __('Element Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "slider"
            ),
            'components_slider' => array(
                'title' => __('Navigation Settings', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "slider"
            ),
            'element_style_grid' => array(
                'title' => __('Element Styles', 'gdgallery'),
                'description' => __('Choose whether to show thumbnails. Change thumbnails sizes and their positioning. ', 'gdgallery'),
                "tab" => "grid"
            ),
            'components_grid' => array(
                'title' => __('Navigation Styles', 'gdgallery'),
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
                'type' => 'select',
                'label' => __('Show Title', 'gdgallery'),
                'options' => array(
                    '0' => __('Always on', 'gdgallery'),
                    '1' => __('On hover', 'gdgallery'),
                    '2' => __('Disable', 'gdgallery')
                ),
                'section' => 'element_style_justified',
                'help' => __('Show / Hide Title', 'gdgallery')
            ),
            'title_position_justified' => array(
                'type' => 'select',
                'label' => __('Title Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery')
                ),
                'section' => 'element_style_justified',
                'help' => __('Title Horisontal Position', 'gdgallery')
            ),
            'title_vertical_position_justified' => array(
                'type' => 'select',
                'label' => __('Title Vertical Position', 'gdgallery'),
                'options' => array(
                    'inside_top' => __('Top', 'gdgallery'),
                    'inside_bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'element_style_justified',
                'help' => __('Title Vertical Position', 'gdgallery')
            ),
            'title_appear_type_justified' => array(
                'type' => 'select',
                'label' => __('Title On Hover Appear Type', 'gdgallery'),
                'options' => array(
                    'slide' => __('Slide', 'gdgallery'),
                    'fade' => __('Fade', 'gdgallery'),
                ),
                'section' => 'element_style_justified',
                'help' => __('Title On Hover Appear Type', 'gdgallery')
            ),
            'title_color_justified' => array(
                'type' => 'color',
                'label' => __('Title color', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Choose Title Color', 'gdgallery')
            ),
            'title_background_color_justified' => array(
                'type' => 'color',
                'label' => __('Title Background color', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Choose  Title Background Color', 'gdgallery')
            ),
            'title_background_opacity_justified' => array(
                'type' => 'number',
                'label' => __('Title Background opacity (%)', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Choose Title Background Opacity', 'gdgallery')
            ),
            'margin_justified' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Element Margin', 'gdgallery')
            ),
            'border_width_justified' => array(
                'type' => 'number',
                'label' => __('Border Width', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Border Width', 'gdgallery')
            ),
            'border_color_justified' => array(
                'type' => 'color',
                'label' => __('Border Color', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Border Color', 'gdgallery')
            ),
            'border_radius_justified' => array(
                'type' => 'number',
                'label' => __('Roundness of corners', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Roundness of corners', 'gdgallery')
            ),
            'on_hover_overlay_justified' => array(
                'type' => 'checkbox',
                'label' => __('On hover overlay', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('On hover overlay', 'gdgallery')
            ),
            'show_icons_justified' => array(
                'type' => 'checkbox',
                'label' => __('Show Icons', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Show Icons', 'gdgallery')
            ),
            'show_link_icon_justified' => array(
                'type' => 'checkbox',
                'label' => __('Show Link Icon', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Show Link Icon', 'gdgallery')
            ),
            'item_as_link_justified' => array(
                'type' => 'checkbox',
                'label' => __('Image as Link', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Image as Link (disable Lightbox)', 'gdgallery')
            ),
            'link_new_tab_justified' => array(
                'type' => 'checkbox',
                'label' => __('Open link in new Tab', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Open link in new Tab', 'gdgallery')
            ),
            'image_hover_effect_justified' => array(
                'type' => 'select',
                'label' => __('Hover effect for Image', 'gdgallery'),
                'options' => array(
                    'blur' => __('none', 'gdgallery'),
                    'bw' => __('Black and White', 'gdgallery'),
                    'sepia' => __('Sepia', 'gdgallery')
                ),
                'section' => 'element_style_justified',
                'help' => __('Hover effect for Image', 'gdgallery')
            ),
            'image_hover_effect_reverse_justified' => array(
                'type' => 'checkbox',
                'label' => __('On Hover Reversed effect for Image', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('On Hover Reversed effect for Image', 'gdgallery')
            ),
            'shadow_justified' => array(
                'type' => 'checkbox',
                'label' => __('Shadow', 'gdgallery'),
                'section' => 'element_style_justified',
                'help' => __('Shadow', 'gdgallery')
            ),


            'lightbox_type_justified' => array(
                'type' => 'select',
                'label' => __('Lightbox Type', 'gdgallery'),
                'options' => array(
                    'wide' => __('Wide', 'gdgallery'),
                    'compact' => __('Compact', 'gdgallery')
                ),
                'section' => 'lightbox_justified',
                'help' => __('Lightbox Type', 'gdgallery')
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
            'load_more_vertical_padding_justified' => array(
                'type' => 'number',
                'label' => __('Vertical Padding', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Vertical Padding', 'gdgallery')
            ),
            'load_more_horisontal_padding_justified' => array(
                'type' => 'number',
                'label' => __('Horisontal Padding', 'gdgallery'),
                'section' => 'pagination_justified',
                'help' => __('Horisontal Padding', 'gdgallery')
            ),
            'load_more_border_width_justified' => array(
                'type' => 'number',
                'label' => __('Border Width', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Border Width', 'gdgallery')
            ),
            'load_more_border_radius_justified' => array(
                'type' => 'number',
                'label' => __('Roundness of corners', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Roundness of corners', 'gdgallery')
            ),
            'load_more_border_color_justified' => array(
                'type' => 'color',
                'label' => __('Border Color', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Border Color', 'gdgallery')
            ),
            'load_more_color_justified' => array(
                'type' => 'color',
                'label' => __('Color', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Color', 'gdgallery')
            ),
            'load_more_background_color_justified' => array(
                'type' => 'color',
                'label' => __('Background Color', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Background Color', 'gdgallery')
            ),
            'load_more_font_family_justified' => array(
                'type' => 'select',
                'label' => __('Font Type', 'gdgallery'),
                'options' => array(
                    'monospace' => __('monospace', 'gdgallery'),
                    'cursive' => __('cursive', 'gdgallery'),
                    'fantasy' => __('fantasy', 'gdgallery'),
                    'sans-serif' => __('sans-serif', 'gdgallery'),
                    'serif' => __('serif', 'gdgallery'),
                ),
                'section' => 'load_more_justified',
                'help' => __('Font Type', 'gdgallery')
            ),
            'load_more_hover_border_color_justified' => array(
                'type' => 'color',
                'label' => __('On Hover Border Color', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Border Color', 'gdgallery')
            ),
            'load_more_hover_color_justified' => array(
                'type' => 'color',
                'label' => __('On Hover Color', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Color', 'gdgallery')
            ),
            'load_more_hover_background_color_justified' => array(
                'type' => 'color',
                'label' => __('On Hover Background Color', 'gdgallery'),
                'section' => 'load_more_justified',
                'help' => __('Background Color', 'gdgallery')
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
                'type' => 'select',
                'label' => __('Show Title', 'gdgallery'),
                'options' => array(
                    '0' => __('Always on', 'gdgallery'),
                    '1' => __('On hover', 'gdgallery'),
                    '2' => __('Disable', 'gdgallery')
                ),
                'section' => 'element_style_tiles',
                'help' => __('Show / Hide Title', 'gdgallery')
            ),
            'title_position_tiles' => array(
                'type' => 'select',
                'label' => __('Title Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery')
                ),
                'section' => 'element_style_tiles',
                'help' => __('Title Horisontal Position', 'gdgallery')
            ),
            'title_vertical_position_tiles' => array(
                'type' => 'select',
                'label' => __('Title Vertical Position', 'gdgallery'),
                'options' => array(
                    'inside_top' => __('Top', 'gdgallery'),
                    'inside_bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'element_style_tiles',
                'help' => __('Title Vertical Position', 'gdgallery')
            ),
            'title_appear_type_tiles' => array(
                'type' => 'select',
                'label' => __('Title On Hover Appear Type', 'gdgallery'),
                'options' => array(
                    'slide' => __('Slide', 'gdgallery'),
                    'fade' => __('Fade', 'gdgallery'),
                ),
                'section' => 'element_style_tiles',
                'help' => __('Title On Hover Appear Type', 'gdgallery')
            ),
            'title_color_tiles' => array(
                'type' => 'color',
                'label' => __('Title color', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Choose Title Color', 'gdgallery')
            ),
            'title_background_color_tiles' => array(
                'type' => 'color',
                'label' => __('Title Background color', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Choose  Title Background Color', 'gdgallery')
            ),
            'title_background_opacity_tiles' => array(
                'type' => 'number',
                'label' => __('Title Background opacity (%)', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Choose Title Background Opacity', 'gdgallery')
            ),
            'margin_tiles' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Element Margin', 'gdgallery')
            ),
            'col_width_tiles' => array(
                'type' => 'number',
                'label' => __('Image Width', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Image Width', 'gdgallery')
            ),
            'min_col_tiles' => array(
                'type' => 'number',
                'label' => __('Minimal Columns', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Minimal Columns', 'gdgallery')
            ),
            'border_width_tiles' => array(
                'type' => 'number',
                'label' => __('Border Width', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Border Width', 'gdgallery')
            ),
            'border_color_tiles' => array(
                'type' => 'color',
                'label' => __('Border Color', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Border Color', 'gdgallery')
            ),
            'border_radius_tiles' => array(
                'type' => 'number',
                'label' => __('Roundness of corners', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Roundness of corners', 'gdgallery')
            ),
            'on_hover_overlay_tiles' => array(
                'type' => 'checkbox',
                'label' => __('On hover overlay', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('On hover overlay', 'gdgallery')
            ),
            'show_icons_tiles' => array(
                'type' => 'checkbox',
                'label' => __('Show Icons', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Show Icons', 'gdgallery')
            ),
            'show_link_icon_tiles' => array(
                'type' => 'checkbox',
                'label' => __('Show Link Icon', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Show Link Icon', 'gdgallery')
            ),
            'item_as_link_tiles' => array(
                'type' => 'checkbox',
                'label' => __('Image as Link', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Image as Link (disable Lightbox)', 'gdgallery')
            ),
            'link_new_tab_tiles' => array(
                'type' => 'checkbox',
                'label' => __('Open link in new Tab', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Open link in new Tab', 'gdgallery')
            ),
            'image_hover_effect_tiles' => array(
                'type' => 'select',
                'label' => __('Hover effect for Image', 'gdgallery'),
                'options' => array(
                    'blur' => __('none', 'gdgallery'),
                    'bw' => __('Black and White', 'gdgallery'),
                    'sepia' => __('Sepia', 'gdgallery')
                ),
                'section' => 'element_style_tiles',
                'help' => __('Hover effect for Image', 'gdgallery')
            ),
            'image_hover_effect_reverse_tiles' => array(
                'type' => 'checkbox',
                'label' => __('On Hover Reversed effect for Image', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('On Hover Reversed effect for Image', 'gdgallery')
            ),
            'shadow_tiles' => array(
                'type' => 'checkbox',
                'label' => __('Shadow', 'gdgallery'),
                'section' => 'element_style_tiles',
                'help' => __('Shadow', 'gdgallery')
            ),


            'lightbox_type_tiles' => array(
                'type' => 'select',
                'label' => __('Lightbox Type', 'gdgallery'),
                'options' => array(
                    'wide' => __('Wide', 'gdgallery'),
                    'compact' => __('Compact', 'gdgallery')
                ),
                'section' => 'lightbox_tiles',
                'help' => __('Lightbox Type', 'gdgallery')
            ),
            'load_more_text_tiles' => array(
                'type' => 'text',
                'label' => __('Load more text', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Load more text', 'gdgallery')
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
                'help' => __('Load more position', 'gdgallery')
            ),
            'load_more_font_size_tiles' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Font size', 'gdgallery')
            ),
            'load_more_vertical_padding_tiles' => array(
                'type' => 'number',
                'label' => __('Vertical Padding', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Vertical Padding', 'gdgallery')
            ),
            'load_more_horisontal_padding_tiles' => array(
                'type' => 'number',
                'label' => __('Horisontal Padding', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Horisontal Padding', 'gdgallery')
            ),
            'load_more_border_width_tiles' => array(
                'type' => 'number',
                'label' => __('Border Width', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Border Width', 'gdgallery')
            ),
            'load_more_border_radius_tiles' => array(
                'type' => 'number',
                'label' => __('Roundness of corners', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Roundness of corners', 'gdgallery')
            ),
            'load_more_border_color_tiles' => array(
                'type' => 'color',
                'label' => __('Border Color', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Border Color', 'gdgallery')
            ),
            'load_more_color_tiles' => array(
                'type' => 'color',
                'label' => __('Color', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Color', 'gdgallery')
            ),
            'load_more_background_color_tiles' => array(
                'type' => 'color',
                'label' => __('Background Color', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Background Color', 'gdgallery')
            ),
            'load_more_font_family_tiles' => array(
                'type' => 'select',
                'label' => __('Font Type', 'gdgallery'),
                'options' => array(
                    'monospace' => __('monospace', 'gdgallery'),
                    'cursive' => __('cursive', 'gdgallery'),
                    'fantasy' => __('fantasy', 'gdgallery'),
                    'sans-serif' => __('sans-serif', 'gdgallery'),
                    'serif' => __('serif', 'gdgallery'),
                ),
                'section' => 'load_more_tiles',
                'help' => __('Font Type', 'gdgallery')
            ),
            'load_more_hover_border_color_tiles' => array(
                'type' => 'color',
                'label' => __('On Hover Border Color', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Border Color', 'gdgallery')
            ),
            'load_more_hover_color_tiles' => array(
                'type' => 'color',
                'label' => __('On Hover Color', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Color', 'gdgallery')
            ),
            'load_more_hover_background_color_tiles' => array(
                'type' => 'color',
                'label' => __('On Hover Background Color', 'gdgallery'),
                'section' => 'load_more_tiles',
                'help' => __('Background Color', 'gdgallery')
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
                'help' => __('Pagination position', 'gdgallery')
            ),
            'pagination_font_size_tiles' => array(
                'type' => 'number',
                'label' => __('Font size', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Font size', 'gdgallery')
            ),
            'pagination_vertical_padding_tiles' => array(
                'type' => 'number',
                'label' => __('Vertical Padding', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Vertical Padding', 'gdgallery')
            ),
            'pagination_horisontal_padding_tiles' => array(
                'type' => 'number',
                'label' => __('Horisontal Padding', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Horisontal Padding', 'gdgallery')
            ),
            'pagination_margin_tiles' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Margin', 'gdgallery')
            ),
            'pagination_border_width_tiles' => array(
                'type' => 'number',
                'label' => __('Border Width', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Border Width', 'gdgallery')
            ),
            'pagination_border_radius_tiles' => array(
                'type' => 'number',
                'label' => __('Roundness of corners', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Roundness of corners', 'gdgallery')
            ),
            'pagination_border_color_tiles' => array(
                'type' => 'color',
                'label' => __('Border Color', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Border Color', 'gdgallery')
            ),
            'pagination_color_tiles' => array(
                'type' => 'color',
                'label' => __('Color', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Color', 'gdgallery')
            ),
            'pagination_background_color_tiles' => array(
                'type' => 'color',
                'label' => __('Background Color', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Background Color', 'gdgallery')
            ),
            'pagination_font_family_tiles' => array(
                'type' => 'select',
                'label' => __('Font Type', 'gdgallery'),
                'options' => array(
                    'monospace' => __('monospace', 'gdgallery'),
                    'cursive' => __('cursive', 'gdgallery'),
                    'fantasy' => __('fantasy', 'gdgallery'),
                    'sans-serif' => __('sans-serif', 'gdgallery'),
                    'serif' => __('serif', 'gdgallery'),
                ),
                'section' => 'pagination_tiles',
                'help' => __('Font Type', 'gdgallery')
            ),
            'pagination_hover_border_color_tiles' => array(
                'type' => 'color',
                'label' => __('On Hover Border Color', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Border Color', 'gdgallery')
            ),
            'pagination_hover_color_tiles' => array(
                'type' => 'color',
                'label' => __('On Hover Color', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Color', 'gdgallery')
            ),
            'pagination_hover_background_color_tiles' => array(
                'type' => 'color',
                'label' => __('On Hover Background Color', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Background Color', 'gdgallery')
            ),
            'pagination_nav_type_tiles' => array(
                'type' => 'select',
                'label' => __('Navigation Type', 'gdgallery'),
                'options' => array(
                    '0' => __('Arrows', 'gdgallery'),
                    '1' => __('Text', 'gdgallery'),
                    '2' => __('Only Numbers', 'gdgallery')
                ),
                'section' => 'pagination_tiles',
                'help' => __('Navigation Type', 'gdgallery')
            ),
            'pagination_nav_text_tiles' => array(
                'type' => 'text',
                'label' => __('Navigation Text', 'gdgallery'),
                'section' => 'pagination_tiles',
                'help' => __('Navigation Text (with comma separetion)', 'gdgallery')
            ),
            'pagination_nearby_pages_tiles' => array(
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
                'section' => 'pagination_tiles',
                'help' => __('Nearby Pages', 'gdgallery')
            ),

            /*****************  carousel options  ******************/
            'show_title_carousel' => array(
                'type' => 'select',
                'label' => __('Show Title', 'gdgallery'),
                'options' => array(
                    '0' => __('Always on', 'gdgallery'),
                    '1' => __('On hover', 'gdgallery'),
                    '2' => __('Disable', 'gdgallery')
                ),
                'section' => 'element_style_carousel',
                'help' => __('Show / Hide Title', 'gdgallery')
            ),
            'title_position_carousel' => array(
                'type' => 'select',
                'label' => __('Title Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery')
                ),
                'section' => 'element_style_carousel',
                'help' => __('Title Horisontal Position', 'gdgallery')
            ),
            'title_vertical_position_carousel' => array(
                'type' => 'select',
                'label' => __('Title Vertical Position', 'gdgallery'),
                'options' => array(
                    'inside_top' => __('Top', 'gdgallery'),
                    'inside_bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'element_style_carousel',
                'help' => __('Title Vertical Position', 'gdgallery')
            ),
            'title_appear_type_carousel' => array(
                'type' => 'select',
                'label' => __('Title On Hover Appear Type', 'gdgallery'),
                'options' => array(
                    'slide' => __('Slide', 'gdgallery'),
                    'fade' => __('Fade', 'gdgallery'),
                ),
                'section' => 'element_style_carousel',
                'help' => __('Title On Hover Appear Type', 'gdgallery')
            ),
            'title_color_carousel' => array(
                'type' => 'color',
                'label' => __('Title color', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Choose Title Color', 'gdgallery')
            ),
            'title_background_color_carousel' => array(
                'type' => 'color',
                'label' => __('Title Background color', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Choose  Title Background Color', 'gdgallery')
            ),
            'title_background_opacity_carousel' => array(
                'type' => 'number',
                'label' => __('Title Background opacity (%)', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Choose Title Background Opacity', 'gdgallery')
            ),
            'width_carousel' => array(
                'type' => 'number',
                'label' => __('Width', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Element Width', 'gdgallery')
            ),
            'height_carousel' => array(
                'type' => 'number',
                'label' => __('height', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Element Height', 'gdgallery')
            ),
            'margin_carousel' => array(
                'type' => 'number',
                'label' => __('Margin', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Element Margin', 'gdgallery')
            ),
            'position_carousel' => array(
                'type' => 'select',
                'label' => __('Position', 'gdgallery'),
                'options' => array(
                    'left' => __('left', 'gdgallery'),
                    'center' => __('center', 'gdgallery'),
                    'right' => __('right', 'gdgallery'),
                ),
                'section' => 'element_style_carousel',
                'help' => __('Position', 'gdgallery')
            ),
            'show_background_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Enable Background', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Enable Background', 'gdgallery')
            ),
            'background_color_carousel' => array(
                'type' => 'color',
                'label' => __('Background Color', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Background Color', 'gdgallery')
            ),
            'border_width_carousel' => array(
                'type' => 'number',
                'label' => __('Border Width', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Border Width', 'gdgallery')
            ),
            'border_color_carousel' => array(
                'type' => 'color',
                'label' => __('Border Color', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Border Color', 'gdgallery')
            ),
            'border_radius_carousel' => array(
                'type' => 'number',
                'label' => __('Roundness of corners', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Roundness of corners', 'gdgallery')
            ),
            'on_hover_overlay_carousel' => array(
                'type' => 'checkbox',
                'label' => __('On hover overlay', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('On hover overlay', 'gdgallery')
            ),
            'show_icons_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Show Icons', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Show Icons', 'gdgallery')
            ),
            'show_link_icon_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Show Link Icon', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Show Link Icon', 'gdgallery')
            ),
            'item_as_link_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Image as Link', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Image as Link (disable Lightbox)', 'gdgallery')
            ),
            'link_new_tab_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Open link in new Tab', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Open link in new Tab', 'gdgallery')
            ),
            'image_hover_effect_carousel' => array(
                'type' => 'select',
                'label' => __('Hover effect for Image', 'gdgallery'),
                'options' => array(
                    'blur' => __('none', 'gdgallery'),
                    'bw' => __('Black and White', 'gdgallery'),
                    'sepia' => __('Sepia', 'gdgallery')
                ),
                'section' => 'element_style_carousel',
                'help' => __('Hover effect for Image', 'gdgallery')
            ),
            'image_hover_effect_reverse_carousel' => array(
                'type' => 'checkbox',
                'label' => __('On Hover Reversed effect for Image', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('On Hover Reversed effect for Image', 'gdgallery')
            ),
            'shadow_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Shadow', 'gdgallery'),
                'section' => 'element_style_carousel',
                'help' => __('Shadow', 'gdgallery')
            ),


            'lightbox_type_carousel' => array(
                'type' => 'select',
                'label' => __('Lightbox Type', 'gdgallery'),
                'options' => array(
                    'wide' => __('Wide', 'gdgallery'),
                    'compact' => __('Compact', 'gdgallery')
                ),
                'section' => 'lightbox_carousel',
                'help' => __('Lightbox Type', 'gdgallery')
            ),


            'nav_num_carousel' => array(
                'type' => 'number',
                'label' => __('number of navigated elements ', 'gdgallery'),
                'section' => 'components_carousel',
                'help' => __('number of elements to scroll when user clicks on next/prev button', 'gdgallery')
            ),
            'scroll_duration_carousel' => array(
                'type' => 'number',
                'label' => __('duration of scrolling (miliseconds)', 'gdgallery'),
                'section' => 'components_carousel',
                'help' => __('duration of scrolling (miliseconds)', 'gdgallery')
            ),
            'autoplay_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Autoplay', 'gdgallery'),
                'section' => 'components_carousel',
                'help' => __('autoplay of the carousel on start', 'gdgallery')
            ),
            'autoplay_timeout_carousel' => array(
                'type' => 'number',
                'label' => __('Autoplay Timeout (miliseconds)', 'gdgallery'),
                'section' => 'components_carousel',
                'help' => __('Autoplay Timeout (miliseconds)', 'gdgallery')
            ),
            'autoplay_direction_carousel' => array(
                'type' => 'select',
                'label' => __('Autoplay Direction', 'gdgallery'),
                'options' => array(
                    'left' => __('left', 'gdgallery'),
                    'right' => __('right', 'gdgallery')
                ),
                'section' => 'components_carousel',
                'help' => __('Autoplay Direction', 'gdgallery')
            ),
            'autoplay_pause_hover_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Autoplay Pause On Hover', 'gdgallery'),
                'section' => 'components_carousel',
                'help' => __('Autoplay Pause On Hover', 'gdgallery')
            ),
            'enable_nav_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Enable Navigation', 'gdgallery'),
                'section' => 'components_carousel',
                'help' => __('Enable Navigation', 'gdgallery')
            ),
            'nav_vertical_position_carousel' => array(
                'type' => 'select',
                'label' => __('Navigation vertical Position', 'gdgallery'),
                'options' => array(
                    'top' => __('Top', 'gdgallery'),
                    'bottom' => __('Bottom', 'gdgallery')
                ),
                'section' => 'components_carousel',
                'help' => __('Navigation vertical Position', 'gdgallery')
            ),
            'nav_horisontal_position_carousel' => array(
                'type' => 'select',
                'label' => __('Navigation Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery')
                ),
                'section' => 'components_carousel',
                'help' => __('Navigation Horisontal Position', 'gdgallery')
            ),
            'paly_icon_carousel' => array(
                'type' => 'checkbox',
                'label' => __('Show Play/Pause Icon', 'gdgallery'),
                'section' => 'components_carousel',
                'help' => __('Show Play/Pause Icon', 'gdgallery')
            ),
            'icon_space_carousel' => array(
                'type' => 'number',
                'label' => __('Space Between Icons', 'gdgallery'),
                'section' => 'components_carousel',
                'help' => __('Space Between Icons', 'gdgallery')
            ),


            /********* Slider options ************/
            'width_slider' => array(
                'type' => 'number',
                'label' => __('Slider Width', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Slider Width')
            ),
            'height_slider' => array(
                'type' => 'number',
                'label' => __('Slider Width', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Slider Height')
            ),
            'autoplay_slider' => array(
                'type' => 'checkbox',
                'label' => __('Autoplay', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Autoplay')
            ),
            'play_interval_slider' => array(
                'type' => 'number',
                'label' => __('Play Interval (miliseconds)', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Play Interval (miliseconds)')
            ),
            'pause_on_hover_slider' => array(
                'type' => 'checkbox',
                'label' => __('Pause On Hover', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Pause On Hover')
            ),
            'scale_mode_slider' => array(
                'type' => 'select',
                'label' => __('Scale Mode', 'gdgallery'),
                'options' => array(
                    'fit' => __('Fit', 'gdgallery'),
                    'fill' => __('Fill', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Scale Mode', 'gdgallery')
            ),
            'transition_slider' => array(
                'type' => 'select',
                'label' => __('Transition', 'gdgallery'),
                'options' => array(
                    'slide' => __('Slide', 'gdgallery'),
                    'fade' => __('Fade', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Transition', 'gdgallery')
            ),
            'transition_speed_slider' => array(
                'type' => 'number',
                'label' => __('Transition Speed (miliseconds)', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Transition Speed (miliseconds)')
            ),
            'zoom_slider' => array(
                'type' => 'checkbox',
                'label' => __('Control Zoom', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Control Zoom', 'gdgallery')
            ),
            'loader_type_slider' => array(
                'type' => 'select',
                'label' => __('Loader Type', 'gdgallery'),
                'options' => array(
                    '1' => __('type 1', 'gdgallery'),
                    '2' => __('type 2', 'gdgallery'),
                    '3' => __('type 3', 'gdgallery'),
                    '4' => __('type 4', 'gdgallery'),
                    '5' => __('type 5', 'gdgallery'),
                    '6' => __('type 6', 'gdgallery'),
                    '7' => __('type 7', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Loader Type', 'gdgallery')
            ),
            'loader_color_slider' => array(
                'type' => 'select',
                'label' => __('Loader Color', 'gdgallery'),
                'options' => array(
                    'white' => __('white', 'gdgallery'),
                    'black' => __('black', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Loader Color', 'gdgallery')
            ),
            'bullets_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Bullets', 'gdgallery'),
                'section' => 'components_slider',
                'help' => __('Enable Bullets')
            ),
            'bullets_horisontal_position_slider' => array(
                'type' => 'select',
                'label' => __('Bullets Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'components_slider',
                'help' => __('Bullets Horisontal Position', 'gdgallery')
            ),
            'bullets_vertical_position_slider' => array(
                'type' => 'select',
                'label' => __('Bullets Vertical Position', 'gdgallery'),
                'options' => array(
                    'top' => __('Top', 'gdgallery'),
                    'bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'components_slider',
                'help' => __('Bullets Vertical Position', 'gdgallery')
            ),
            'arrows_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Arrows', 'gdgallery'),
                'section' => 'components_slider',
                'help' => __('Enable Arrows', 'gdgallery')
            ),
            'progress_indicator_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Progress Indicator', 'gdgallery'),
                'section' => 'components_slider',
                'help' => __('Enable Progress Indicator')
            ),
            'progress_indicator_type_slider' => array(
                'type' => 'select',
                'label' => __('Progress Indicator Type', 'gdgallery'),
                'options' => array(
                    'pie' => __('Pie', 'gdgallery'),
                    'bar' => __('Bar', 'gdgallery'),
                ),
                'section' => 'components_slider',
                'help' => __('Progress Indicator Type', 'gdgallery')
            ),
            'progress_indicator_horisontal_position_slider' => array(
                'type' => 'select',
                'label' => __('Progress Indicator Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'components_slider',
                'help' => __('Progress Indicator Horisontal Position', 'gdgallery')
            ),
            'progress_indicator_vertical_position_slider' => array(
                'type' => 'select',
                'label' => __('Progress Indicator Vertical Position', 'gdgallery'),
                'options' => array(
                    'top' => __('Top', 'gdgallery'),
                    'bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'components_slider',
                'help' => __('Progress Indicator Vertical Position', 'gdgallery')
            ),
            'play_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Play Button', 'gdgallery'),
                'section' => 'components_slider',
                'help' => __('Enable Play Button', 'gdgallery')
            ),
            'play_horizontal_position_slider' => array(
                'type' => 'select',
                'label' => __('Play Button Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'components_slider',
                'help' => __('Play Button Horisontal Position', 'gdgallery')
            ),
            'play_vertical_position_slider' => array(
                'type' => 'select',
                'label' => __('Play Button Vertical Position', 'gdgallery'),
                'options' => array(
                    'top' => __('Top', 'gdgallery'),
                    'bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'components_slider',
                'help' => __('Play Button Vertical Position', 'gdgallery')
            ),
            'fullscreen_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Fullscreen Button', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Enable Fullscreen Button', 'gdgallery')
            ),
            'fullscreen_horisontal_position_slider' => array(
                'type' => 'select',
                'label' => __('Fullscreen Button Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Fullscreen Button Horisontal Position', 'gdgallery')
            ),
            'fullscreen_vertical_position_slider' => array(
                'type' => 'select',
                'label' => __('Fullscreen Button Vertical Position', 'gdgallery'),
                'options' => array(
                    'top' => __('Top', 'gdgallery'),
                    'bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Fullscreen Button Vertical Position', 'gdgallery')
            ),
            'zoom_panel_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Zoom Panel', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Enable Zoom Panel', 'gdgallery')
            ),
            'zoom_horisontal_panel_position_slider' => array(
                'type' => 'select',
                'label' => __('Zoom Panel Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Zoom Panel Horisontal Position', 'gdgallery')
            ),
            'zoom_vertical_panel_position_slider' => array(
                'type' => 'select',
                'label' => __('Zoom Panel Vertical Position', 'gdgallery'),
                'options' => array(
                    'top' => __('Top', 'gdgallery'),
                    'bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Zoom Panel Vertical Position', 'gdgallery')
            ),
            'controls_always_on_slider' => array(
                'type' => 'checkbox',
                'label' => __('Controls Always On', 'gdgallery'),
                'section' => 'components_slider',
                'help' => __('Controls Always On', 'gdgallery')
            ),
            'video_play_type_slider' => array(
                'type' => 'select',
                'label' => __('Video Play Button Type', 'gdgallery'),
                'options' => array(
                    'round' => __('Round', 'gdgallery'),
                    'square' => __('Square', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Video Play Button Type', 'gdgallery')
            ),
            'text_panel_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Text Panel', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Enable Text Panel', 'gdgallery')
            ),
            'text_panel_always_on_slider' => array(
                'type' => 'checkbox',
                'label' => __('Text Panel Always On', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Text Panel Always On', 'gdgallery')
            ),
            'text_title_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Title', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Enable Title', 'gdgallery')
            ),
            'text_description_slider' => array(
                'type' => 'checkbox',
                'label' => __('Enable Description', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Enable Description', 'gdgallery')
            ),
            'text_panel_bg_slider' => array(
                'type' => 'checkbox',
                'label' => __('Text Panel background', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Text Panel background', 'gdgallery')
            ),
            'carousel_slider' => array(
                'type' => 'checkbox',
                'label' => __('Gallery Carousel', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('next button on last image goes to first image.', 'gdgallery')
            ),
            'text_panel_bg_color_slider' => array(
                'type' => 'color',
                'label' => __('Text Panel background Color', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Text Panel background Color', 'gdgallery')
            ),
            'text_panel_bg_opacity_slider' => array(
                'type' => 'number',
                'label' => __('Text Panel background Opacity (%)', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Text Panel background Opacity (%)', 'gdgallery')
            ),
            'text_panel_title_color_slider' => array(
                'type' => 'color',
                'label' => __('Text Panel Title Color', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Text Panel Title Color', 'gdgallery')
            ),
            'text_panel_desc_color_slider' => array(
                'type' => 'color',
                'label' => __('Text Panel Description Color', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Text Panel Description Color', 'gdgallery')
            ),
            'carousel_slider' => array(
                'type' => 'checkbox',
                'label' => __('Gallery Carousel', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('next button on last image goes to first image.', 'gdgallery')
            ),
            'playlist_slider' => array(
                'type' => 'checkbox',
                'label' => __('Show Play list', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Show Play list', 'gdgallery')
            ),
            'playlist_pos_slider' => array(
                'type' => 'select',
                'label' => __('Playlist Position', 'gdgallery'),
                'options' => array(
                    'right' => __('Right', 'gdgallery'),
                    'left' => __('Left', 'gdgallery'),
                    'bottom' => __('Bottom', 'gdgallery'),
                    'top' => __('Top', 'gdgallery'),
                ),
                'section' => 'element_style_slider',
                'help' => __('Playlist Position', 'gdgallery')
            ),
            'thumb_width_slider' => array(
                'type' => 'number',
                'label' => __('Thumbnail width', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Thumbnail width', 'gdgallery')
            ),
            'thumb_height_slider' => array(
                'type' => 'number',
                'label' => __('Thumbnail Height', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Thumbnail Height', 'gdgallery')
            ),
            'playlist_bg_slider' => array(
                'type' => 'color',
                'label' => __('Playlist panel background color', 'gdgallery'),
                'section' => 'element_style_slider',
                'help' => __('Playlist panel background color', 'gdgallery')
            ),


            /********************  Grid options  ***********************/
            'width_grid' => array(
                'type' => 'number',
                'label' => __('Element Width', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Element Width')
            ),
            'height_grid' => array(
                'type' => 'number',
                'label' => __('Element Height', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Element Height')
            ),
            'space_cols_grid' => array(
                'type' => 'number',
                'label' => __('Space between Columns', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Space between Columns')
            ),
            'space_rows_grid' => array(
                'type' => 'number',
                'label' => __('Space between Rows', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Space between Rows')
            ),
            'gallery_width_grid' => array(
                'type' => 'number',
                'label' => __('Gallery Width (%)', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Gallery Width (%)')
            ),
            'gallery_bg_grid' => array(
                'type' => 'checkbox',
                'label' => __('Show Gallery Background', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Show Gallery Background')
            ),
            'gallery_bg_color_grid' => array(
                'type' => 'color',
                'label' => __('Gallery Background color', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Gallery Background color')
            ),
            'num_rows_grid' => array(
                'type' => 'number',
                'label' => __('Gallery Rows number', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Gallery Rows number')
            ),
            'show_title_grid' => array(
                'type' => 'select',
                'label' => __('Show Title', 'gdgallery'),
                'options' => array(
                    '0' => __('Always On', 'gdgallery'),
                    '1' => __('On Hover', 'gdgallery'),
                    '2' => __('Never', 'gdgallery')
                ),
                'section' => 'element_style_grid',
                'help' => __('Show Title', 'gdgallery')
            ),
            'title_position_grid' => array(
                'type' => 'select',
                'label' => __('Title Horisontal Position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery')
                ),
                'section' => 'element_style_grid',
                'help' => __('Title Horisontal Position', 'gdgallery')
            ),
            'title_vertical_position_grid' => array(
                'type' => 'select',
                'label' => __('Title Vertical Position', 'gdgallery'),
                'options' => array(
                    'inside_top' => __('Top', 'gdgallery'),
                    'inside_bottom' => __('Bottom', 'gdgallery'),
                ),
                'section' => 'element_style_grid',
                'help' => __('Title Vertical Position', 'gdgallery')
            ),
            'title_appear_type_grid' => array(
                'type' => 'select',
                'label' => __('Title On Hover Appear Type', 'gdgallery'),
                'options' => array(
                    'slide' => __('Slide', 'gdgallery'),
                    'fade' => __('Fade', 'gdgallery'),
                ),
                'section' => 'element_style_grid',
                'help' => __('Title On Hover Appear Type', 'gdgallery')
            ),
            'title_color_grid' => array(
                'type' => 'color',
                'label' => __('Title color', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Choose Title Color', 'gdgallery')
            ),
            'title_background_color_grid' => array(
                'type' => 'color',
                'label' => __('Title Background color', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Choose  Title Background Color', 'gdgallery')
            ),
            'title_background_opacity_grid' => array(
                'type' => 'number',
                'label' => __('Title Background opacity (%)', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Choose Title Background Opacity', 'gdgallery')
            ),
            'border_width_grid' => array(
                'type' => 'number',
                'label' => __('Border Width', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Border Width', 'gdgallery')
            ),
            'border_color_grid' => array(
                'type' => 'color',
                'label' => __('Border Color', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Border Color', 'gdgallery')
            ),
            'border_radius_grid' => array(
                'type' => 'number',
                'label' => __('Roundness of corners', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Roundness of corners', 'gdgallery')
            ),
            'on_hover_overlay_grid' => array(
                'type' => 'checkbox',
                'label' => __('On hover overlay', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('On hover overlay', 'gdgallery')
            ),
            'show_icons_grid' => array(
                'type' => 'checkbox',
                'label' => __('Show Icons', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Show Icons', 'gdgallery')
            ),
            'show_link_icon_grid' => array(
                'type' => 'checkbox',
                'label' => __('Show Link Icon', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Show Link Icon', 'gdgallery')
            ),
            'item_as_link_grid' => array(
                'type' => 'checkbox',
                'label' => __('Image as Link', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Image as Link (disable Lightbox)', 'gdgallery')
            ),
            'link_new_tab_grid' => array(
                'type' => 'checkbox',
                'label' => __('Open link in new Tab', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Open link in new Tab', 'gdgallery')
            ),
            'image_hover_effect_grid' => array(
                'type' => 'select',
                'label' => __('Hover effect for Image', 'gdgallery'),
                'options' => array(
                    'blur' => __('none', 'gdgallery'),
                    'bw' => __('Black and White', 'gdgallery'),
                    'sepia' => __('Sepia', 'gdgallery')
                ),
                'section' => 'element_style_grid',
                'help' => __('Hover effect for Image', 'gdgallery')
            ),
            'image_hover_effect_reverse_grid' => array(
                'type' => 'checkbox',
                'label' => __('On Hover Reversed effect for Image', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('On Hover Reversed effect for Image', 'gdgallery')
            ),
            'shadow_grid' => array(
                'type' => 'checkbox',
                'label' => __('Shadow', 'gdgallery'),
                'section' => 'element_style_grid',
                'help' => __('Shadow', 'gdgallery')
            ),


            'nav_type_grid' => array(
                'type' => 'select',
                'label' => __('Navigation Type', 'gdgallery'),
                'options' => array(
                    'bullets' => __('Bullets', 'gdgallery'),
                    'arrows' => __('Arrows', 'gdgallery'),
                ),
                'section' => 'components_grid',
                'help' => __('Navigation Type', 'gdgallery')
            ),
            'bullets_margin_grid' => array(
                'type' => 'number',
                'label' => __('Bullets margin', 'gdgallery'),
                'section' => 'components_grid',
                'help' => __('Bullets margin', 'gdgallery')
            ),
            'bullets_color_grid' => array(
                'type' => 'select',
                'label' => __('Bullets color', 'gdgallery'),
                'options' => array(
                    'gray' => __('Gray', 'gdgallery'),
                    'blue' => __('Blue', 'gdgallery'),
                    'brown' => __('Brown', 'gdgallery'),
                    'green' => __('Green', 'gdgallery'),
                    'red' => __('Red', 'gdgallery'),
                ),
                'section' => 'components_grid',
                'help' => __('Bullets color', 'gdgallery')
            ),
            'bullets_space_between_grid' => array(
                'type' => 'number',
                'label' => __('Bullets Between Space', 'gdgallery'),
                'section' => 'components_grid',
                'help' => __('Bullets Between Space', 'gdgallery')
            ),
            'arrows_margin_grid' => array(
                'type' => 'number',
                'label' => __('Arrows margin', 'gdgallery'),
                'section' => 'components_grid',
                'help' => __('Arrows margin', 'gdgallery')
            ),
            'arrows_space_between_grid' => array(
                'type' => 'number',
                'label' => __('Arrows Between Space', 'gdgallery'),
                'section' => 'components_grid',
                'help' => __('Arrows Between Space', 'gdgallery')
            ),
            'nav_position_grid' => array(
                'type' => 'select',
                'label' => __('Navigation position', 'gdgallery'),
                'options' => array(
                    'left' => __('Left', 'gdgallery'),
                    'center' => __('Center', 'gdgallery'),
                    'right' => __('Right', 'gdgallery')
                ),
                'section' => 'components_grid',
                'help' => __('Navigation position', 'gdgallery')
            ),
            'nav_offset_greed' => array(
                'type' => 'number',
                'label' => __('Navigation Offset', 'gdgallery'),
                'section' => 'components_grid',
                'help' => __('Navigation Offset', 'gdgallery')
            ),


            /********* One_and_others options ************/
            'show_title_one_and_others' => array(
                'type' => 'checkbox',
                'label' => __('Show Title', 'gdgallery'),
                'section' => 'element_style_one_and_others',
                'help' => __('Show / Hide Title')
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