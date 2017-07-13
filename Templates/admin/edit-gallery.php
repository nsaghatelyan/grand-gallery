<?php
/**
 * Template for edit gallery page
 * @var $gallery \GDGallery\Models\Gallery
 */

use GDGallery\Controllers\Frontend\FormPreviewController as Preview;

global $wpdb;


$items = $gallery->getItems();

$gallery_data = $gallery->getGallery();

$id = $gallery->getId();

$gallery_settings_link = admin_url('admin.php?page=gdfrm&task=edit_form_settings&id=' . $gallery->getId());

$gallery_settings_link = wp_nonce_url($gallery_settings_link, 'gdfrm_edit_form_settings_' . $gallery->getId());

$save_data_nonce = wp_create_nonce('gdgallery_nonce_save_data' . $id);

?>
<form action="admin.php?page=gdgallery&id=<?php echo $row->id; ?>&save_data_nonce=<?php echo $save_data_nonce; ?>"
      method="post" name="gdgallery_images_form" id="gdgallery_images_form">
    <div class="wrap gdfrm_edit_form_container">
        <div class="gdfrm_nav">
            <div class="form_title_div">
                <input type="text" id="form_name" name="gdgallery_name" value="<?php echo $gallery->getName(); ?>">
                <input type="hidden" id="gdgallery_id_gallery" name="gdgallery_id_gallery" value="<?php echo $id ?>">
                <input type="submit" value="Save"
                       id="gdgallery-save-buttom"
                       class="gdgallery-save-buttom">
                <span class="spinner"></span>
            </div>

            <div id="tabs">
                <h3>Gallery settings</h3>
                <a href="#" id="settings_container_switcher" data-status="show"><img
                            src="<?= GDGALLERY_IMAGES_URL ?>icons/triangle.png"></a>
                <div style="clear: both"></div>
                <div class="settings-toogled-container">
                    <ul>
                        <li>
                            <a href="#gdgallery_general_settings"><?php _e('General Settings'); ?></a>
                        </li>
                        <li>
                            <a href="#gdgallery_gallery_style"><?php _e('Gallery Style'); ?></a>
                        </li>
                        <li>
                            <a href="#gdgallery_custom_css"><?php _e('Custom CSS'); ?></a>
                        </li>
                        <li>
                            <a href="#gdgallery_get_shortcode"><?php _e('Get shortcode'); ?></a>
                        </li>
                    </ul>
                    <div id="gdgallery_general_settings">
                        <ul cass="gdgallery_general_settings">
                            <li>
                                <h4>Description</h4>
                                <?php
                                wp_editor($gallery_data->description, "gdgallery_description", array(
                                    'media_buttons' => false,
                                    'textarea_rows' => 5,
                                    'tabindex' => 4
                                ));
                                ?>
                            </li>
                            <li>
                                <h4>Display Type</h4>
                                <select name="gdgallery_display_type" id="gdgallery_display_type_<?= $id ?>">
                                    <option value="0">Show All</option>
                                    <option value="1">Load more</option>
                                    <option value="2">Pagination</option>
                                </select>
                            </li>
                            <li>
                                <h4>Hover effect</h4>
                                <select name="gdgallery_hover_effect"
                                        id="gdgallery_hover_effect_<?= $id ?>">
                                    <option value="0">effect 1</option>
                                    <option value="1">effect 2</option>
                                    <option value="2">effect 3</option>
                                </select>
                            </li>
                            <li>
                                <h4>Position</h4>
                                <select name="gdgallery_position"
                                        id="gdgallery_position_<?= $id ?>">
                                    <option value="0">left</option>
                                    <option value="1">center</option>
                                    <option value="2">right</option>
                                </select>
                            </li>
                        </ul>


                    </div>
                    <div id="gdgallery_gallery_style">
                        <?php foreach ($gallery->getViewStyles() as $key => $view): ?>
                            <div class="gdgallery_view_item">
                                <label>
                                    <input type="radio" <?php if ($gallery_data->view_type == $key) echo "checked" ?>
                                           name="gdgallery_view_type" value="<?= $key ?>"/>
                                    <img src="<?= $view[1] ?>">
                                    <p><?= $view[0] ?></p>
                                </label>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <div id="gdgallery_custom_css">
                        <h4>For Gallery Container</h4>
                        <textarea cols="8" name="gdgallery_gallery_container_css"></textarea>
                        <h4>For Single Item</h4>
                        <textarea cols="8" name="gdgallery_single_item_css"></textarea>
                    </div>
                    <div id="gdgallery_get_shortcode">
                        <div class="gdgallery_shortcode_types">
                            <div class="gdgallery_example">
                                <h3>Shortcode</h3>
                                <p>Copy and paste this shortcode into your posts or pages.</p>
                                <div class="gdgallery_highlighted">
                                    [gdgallery_gallery id=<?= $id ?>]
                                </div>
                            </div>
                            <div class="gdgallery_example">
                                <h3>Page or Post</h3>
                                <p>Insert it into an existing post with the icon</p>
                                <div class="gdgallery_highlighted">
                                    image here
                                </div>
                            </div>
                            <div class="gdgallery_example">
                                <h3>PHP Code</h3>
                                <p>Paste the PHP code into your template file</p>
                                <div class="gdgallery_highlighted">
                                    &lt;?php <br>
                                    echo do_shortcode('[gdgallery_gallery id=<?= $id ?>]'); <br>
                                    ?&gt;
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="gdgallery_items_section">
                <h3>Gallery Content</h3>
                <?php if (!empty($items)) { ?><a href="#" class="gdgallery_edit_gallery_images">quick edit</a><?php } ?>
                <div class="gdgallery_clearfix"></div>
                <div class="gdgallery_items_list">
                    <div class="gdgallery_add_new gdgallery_add_new_image" id="_unique_name_button">
                        <div class="gdgallery_add_new_plus"></div>
                        <p>NEW IMAGE</p>
                    </div>
                    <div class="gdgallery_add_new gdgallery_add_new_video">
                        <div class="gdgallery_add_new_plus"></div>
                        <p>NEW VIDEO</p>
                    </div>
                    <?php
                    if (!empty($items)) {
                        foreach ($items as $item): ?>
                            <div class="gdgallery_item">
                                <img src="<?= $item->url; ?>"/>
                                <p class="gdgallery_item_title"><?= $item->name ?></p>
                                <div class="gdgallery_item_overlay">
                                    <input type="checkbox" name="item" val="<?= $item->id_image; ?>"/>
                                    <div class="gdgallery_item_edit">
                                        <a href="#">EDIT</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    } else {
                        echo "No items in this gallery";
                    } ?>
                </div>
            </div>
        </div>
    </div>
</form>
<?php \GDGallery\Helpers\View::render('admin/add-video.php'); ?>
<?php \GDGallery\Helpers\View::render('admin/edit-images.php', array('items' => $items, 'id_gallery' => $id, "save_data_nonce" => $save_data_nonce)); ?>


<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->

<script>
    /* $(function () {
     $(".gdgallery_items_list").sortable();
     $(".gdgallery_items_list").disableSelection()
     }*/

</script>


<script>
    jQuery('#tabs')
        .tabs()
        .addClass('ui-tabs-vertical ui-helper-clearfix');
</script>

