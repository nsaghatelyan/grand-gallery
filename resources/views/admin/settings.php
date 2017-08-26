<?php
/**
 * Template for Grand Forms Settings Page
 */
global $wpdb;
?>

    <div class="wrap gdgallery_list_container " id="gdgallery-settings">

        <div class="gdgallery_content" style="padding:0px;">

            <div class="gdgallery-list-header">
                <button id="save-form-button"><?php _e('Save'); ?></button>
            </div>

            <form id="grand-gallery">


                <div class="one-third">
                    <div class="setting-block">
                        <div class="setting-block-title">
                            <img src="<?php echo GDGALLERY_IMAGES_URL . 'icons/uninstall.png'; ?>">
                            <?php _e('Uninstall', GDGALLERY_TEXT_DOMAIN); ?>
                        </div>

                        <div class="setting-row">
                            <label class="switcher switch-checkbox" for="remove-tables-uninstall"><?php _e('Remove all data on
                                plugin deactivation', GDGALLERY_TEXT_DOMAIN); ?>
                                <input type="hidden"
                                       name="RemoveTablesUninstall"
                                       value="off"/>
                                <input type="checkbox"
                                       class="switch-checkbox" <?php checked('on', \GDGallery()->settings->getOption('RemoveTablesUninstall')) ?>
                                       name="RemoveTablesUninstall" id="remove-tables-uninstall"><span
                                        class="switch"></span></label>
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
<?php
?>