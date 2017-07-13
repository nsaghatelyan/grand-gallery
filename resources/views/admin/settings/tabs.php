<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/13/2017
 * Time: 2:13 PM
 */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="settings-wrap">
    <div class="settings-sections-wrap">
        <form id="settings_form" action="admin.php?page=gdgallery_styles&action=save_settings" method="post">
            <?php if (!empty($title)): ?>
                <div class="settings-head">
                    <h1><?php echo $title; ?></h1>
                    <div class="settings-save-head">
                        <input type="submit" class="settings-save" value="<?php _e('Save Settings', 'gdgallery'); ?>"/>
                        <span class="spinner"></span>
                    </div>
                </div>

            <?php endif; ?>
            <input type="hidden" name="action" value="save_gd_lightbox_settings"/>
            <?php wp_nonce_field('gdgallery_settings'); ?>
            <div id="settings_tab">
                <ul>
                    <?php foreach ($tabs as $key => $tab): ?>
                        <li><a href="#<?= $key ?>"><?= $tab["title"] ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php foreach ($tabs as $id => $tab): ?>
                    <?php \GDGallery\Helpers\View::render('admin/settings/styles.php', compact('sections', 'id', 'fields')); ?>
                <?php endforeach; ?>
            </div>
            <div class="settings-save-wrap">
                <input type="submit" class="settings-save" value="<?php _e('Save Settings', 'gdgallery'); ?>"/>
                <span class="spinner"></span>
            </div>
        </form>

    </div>
</div>


<script type="text/javascript">
    $("#settings_tab").tabs();
</script>
