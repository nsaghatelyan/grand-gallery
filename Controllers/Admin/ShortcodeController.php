<?php

namespace GDGallery\Controllers\Admin;

use GDGallery\Helpers\View;

class ShortcodeController
{

    public static function showInlinePopup()
    {
        View::render('admin/inline-popup.php');
    }

    public static function showEditorMediaButton($context)
    {
        $img = untrailingslashit(\GDGallery()->pluginUrl()) . "/assets/images/forms_logo.png";
        $container_id = 'gdgallery';
        $title = __('Select Grand Form to insert into post', GDGALLERY_TEXT_DOMAIN);
        $button_text = __('Grand Form', GDGALLERY_TEXT_DOMAIN);
        $context .= '<a class="button thickbox" title="' . $title . '"    href="#TB_inline?width=400&inlineId=' . $container_id . '">
		<span class="wp-media-buttons-icon" style="background: url(' . $img . '); background-repeat: no-repeat; background-position: left bottom;background-size: 18px 18px;"></span>' . $button_text . '</a>';

        return $context;
    }

}