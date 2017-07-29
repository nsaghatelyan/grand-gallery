<?php
/**
 * Template for edit gallery page
 * @var $gallery \GDGallery\Models\Gallery
 */

use GDGallery\Controllers\Frontend\GalleryPreviewController as Preview;

global $wpdb;


$items = $gallery->getItems();

$gallery_data = $gallery->getGallery();

$list = $gallery->getGalleriesUrl();

$new_gallery_link = admin_url('admin.php?page=gdgallery&task=create_new_gallery');

$new_gallery_link = wp_nonce_url($new_gallery_link, 'gdgallery_create_new_gallery');

$id = $gallery->getId();


$gallery_settings_link = admin_url('admin.php?page=gdfrm&task=edit_form_settings&id=' . $gallery->getId());

$gallery_settings_link = wp_nonce_url($gallery_settings_link, 'gdfrm_edit_form_settings_' . $gallery->getId());

$save_data_nonce = wp_create_nonce('gdgallery_nonce_save_data' . $id);

if (in_array($gallery_data->view_type, array(0, 1))) {

}

$display_opt = (in_array($gallery_data->view_type, array(0, 1))) ? "" : "gdgallery_hidden";

?>
<ul class="switch_gallery">
    <?php foreach ($list as $val): ?>
        <li <?php if ($val["id_gallery"] == $id) echo "class='active_gallery'" ?>>
            <a href="<?= $val["url"] ?>"><?= $val["name"] ?></a>
        </li>
    <?php endforeach; ?>
    <li class="add_gallery_li">
        <a href="<?= $new_gallery_link ?>">ADD GALLERY <i class="fa fa-plus" aria-hidden="true"></i></a>
    </li>
</ul>
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
                <div style="clear: both"></div>
                <div class="settings-toogled-container">

                    <ul>
                        <li>
                            <a href="#gdgallery_gallery_style"><?php _e('Gallery Style'); ?></a>
                        </li>
                        <li>
                            <a href="#gdgallery_general_settings"><?php _e('General Settings'); ?></a>
                        </li>
                        <li>
                            <a href="#gdgallery_custom_css"><?php _e('Custom CSS'); ?></a>
                        </li>
                        <li>
                            <a href="#gdgallery_get_shortcode"><?php _e('Get shortcode'); ?></a>
                        </li>
                        <a href="<?php echo \GDGallery\Controllers\Frontend\GalleryPreviewController::previewUrl($gallery->getId(), false); ?>"
                           class="single_gallery_preview"><?php _e('Preview Changes'); ?></a>

                    </ul>
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
                    <div id="gdgallery_general_settings">
                        <ul class="gdgallery_general_settings">
                            <li class="gdgallery_display_type_section <?= $display_opt ?>">
                                <h4>Display Type</h4>
                                <select name="gdgallery_display_type" id="gdgallery_display_type">
                                    <option value="0" <?php if ($gallery_data->display_type == 0) echo "selected" ?>>
                                        Show All
                                    </option>
                                    <option value="1" <?php if ($gallery_data->display_type == 1) echo "selected" ?>>
                                        Load more
                                    </option>
                                    <option value="2" <?php if ($gallery_data->display_type == 2) echo "selected" ?>>
                                        Pagination
                                    </option>
                                </select>
                            </li>
                            <li class="gdgallery_items_per_page_section <?php if ($gallery_data->display_type == 0) echo "gdgallery_hidden" ?>  <?= $display_opt ?>">
                                <h4>Items Per Page</h4>
                                <input type="number" min="0" max="100" name="gdgallery_items_per_page"
                                       id="gdgallery_items_per_page" class="gdgallery_items_per_page"
                                       value="<?= $gallery_data->items_per_page ?>">
                            </li>

                        </ul>


                    </div>

                    <div id="gdgallery_custom_css">
                        <div class="custom_css_col">
                            <h4>For Gallery Container</h4>
                            <textarea cols="8" name="gdgallery_gallery_container_css"></textarea>
                        </div>
                        <div class="custom_css_col">
                            <h4>For Single Item</h4>
                            <textarea cols="8" name="gdgallery_single_item_css"></textarea>
                        </div>
                    </div>
                    <div id="gdgallery_get_shortcode">
                        <div class="gdgallery_shortcode_types">
                            <div class="gdgallery_example">
                                <h3>Shortcode</h3>
                                <p>Copy and paste this shortcode into your posts or pages.</p>
                                <div class="gdgallery_highlighted">
                                    [gdgallery_gallery id_gallery=<?= $id ?>]
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
                                    echo do_shortcode('[gdgallery_gallery id_gallery=<?= $id ?>]'); <br>
                                    ?&gt;
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="gdgallery_items_section">
                <h3>Gallery Content</h3>

                <?php if (!empty($items)) { ?>
                    <p class="gdgallery_select_all_items">
                        <label for="gdgallery_select_all_items">Select All</label> <input type="checkbox"
                                                                                          id="gdgallery_select_all_items"
                                                                                          name="select_all_items"/>
                    </p>
                    <a href="#" class="gdgallery_remove_selected_images gdfrm_delete_form">Remove selected items <i
                                class="fa fa-times"
                                aria-hidden="true"></i></a>
                    <a href="#" class="gdgallery_edit_gallery_images">Quick edit <i class="fa fa-pencil"
                                                                                    aria-hidden="true"></i></a>
                <?php } ?>
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
                        foreach ($items as $item):
                            $icon = ($item->type == "youtube") ? "fa-youtube-play" : (($item->type == "vimeo") ? "fa-vimeo" : "fa-picture-o");
                            ?>

                            <div class="gdgallery_item" style="background-image: url('<?= $item->url ?>');">

                                <p class="gdgallery_item_title"><?= $item->name ?>
                                    <i class="fa <?= $icon ?>" aria-hidden="true"></i></p>
                                <div class="gdgallery_item_overlay">
                                    <input type="checkbox" name="items[]"
                                           value="<?= $item->id_image; ?>" class="items_checkbox"/>
                                    <div class="gdgallery_item_edit">
                                        <a href="<?php echo ($item->id_post != 0) ? admin_url() . "post.php?post=" . $item->id_post . "&action=edit&image-editor" : "#"; ?>"
                                           target="_blank" data-post-id="<?= $item->id_post ?>">EDIT</a>
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
</form>
<?php \GDGallery\Helpers\View::render('admin/add-video.php'); ?>
<?php \GDGallery\Helpers\View::render('admin/edit-images.php', array('items' => $items, 'id_gallery' => $id, "save_data_nonce" => $save_data_nonce)); ?>


<script>
    jQuery('#tabs')
        .tabs()
        .addClass('ui-tabs-vertical ui-helper-clearfix');

    jQuery(document).ready(function () {

        jQuery(function () {
            jQuery(".gdgallery_items_list").sortable();
            jQuery(".gdgallery_items_list").disableSelection();

        });
    });
</script>

