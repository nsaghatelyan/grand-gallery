<?php
/**
 * Template for gallery list
 */
global $wpdb;

$new_gallery_link = admin_url('admin.php?page=gdgallery&task=create_new_gallery');

$new_gallery_link = wp_nonce_url($new_gallery_link, 'gdgallery_create_new_gallery');

$form_templates_link = admin_url('admin.php?page=gdfrm&task=choose_form_template');

$form_templates_link = wp_nonce_url($form_templates_link, 'gdfrm_choose_form_template');

?>

<div class="wrap gdfrm_list_container ">

    <div class="gdfrm_content">

        <div class="gdfrm-list-header">
            <div>
                <a href="<?php echo $new_gallery_link; ?>" id="gdgallery-new-gallery">New Gallery</a>
            </div>

        </div>

        
        <table class="widefat striped fixed forms_table">
            <thead>
            <tr>
                <th scope="col" id="header-id" style="width:10px"><span><input type="checkbox"
                                                                               id="select-all"></span></span></th>
                <th scope="col" id="header-name" style="width:85px"><span><?php _e('Name', GDFRM_TEXT_DOMAIN); ?></span>
                </th>
                <th scope="col" id="header-fields" style="width:85px">
                    <span><?php _e('Items', GDFRM_TEXT_DOMAIN); ?></span></th>

                <th scope="col" id="header-shortcode" style="width:85px">
                    <span><?php _e('Shortcode', GDFRM_TEXT_DOMAIN); ?></span></th>
                <th style="width:60px"><?php _e('Actions', GDFRM_TEXT_DOMAIN); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php

            //            $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;

            $galleries = \GDGallery\Models\Gallery::get();
            if (!empty($galleries)) {
                foreach ($galleries as $gallery) {
                    \GDGallery\Helpers\View::render('admin/galleries-list-single-item.php', array('gallery' => $gallery));
                }
            } else {
                \GDGallery\Helpers\View::render('admin/galleries-list-no-items.php');
            }
            ?>
            </tbody>

            <tfoot>
            <tr>
                <th scope="col" class="footer-id" style="width:30px"></th>
                <th scope="col" class="footer-name" style="width:85px">
                    <span><?php _e('Name', GDFRM_TEXT_DOMAIN); ?></span></th>
                <th scope="col" class="footer-fields" style="width:85px">
                    <span><?php _e('Items', GDFRM_TEXT_DOMAIN); ?></span></th>
                <th scope="col" class="footer-shortcode" style="width:85px">
                    <span><?php _e('Shortcode', GDFRM_TEXT_DOMAIN); ?></span></th>
                <th style="width:60px"><?php _e('Actions', GDFRM_TEXT_DOMAIN); ?></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>