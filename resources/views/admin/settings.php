<?php
/**
 * Template for Grand Forms Settings Page
 */
global $wpdb;
?>

    <div class="wrap" id="gdgallery-settings">

        <div class="gdgallery_content">

            <div class="gdfrm-list-header">
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
                            <label class="switcher switch-checkbox" for="remove-tables-uninstall">Remove all data on
                                plugin uninstall<input type="hidden" name="RemoveTablesUninstall" value="off"/><input
                                        type="checkbox"
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