jQuery(document).ready(function () {


    jQuery('#grand_form_insert').on('click', function () {
        var id = jQuery('#grand_form_select option:selected').val();
        window.send_to_editor('[gdgallery_gallery id_gallery="' + id + '"]');
        tb_remove();
        var name = jQuery("#map_name").val();
        id = jQuery('#grand_form_select option:selected').val();
        var data = {
            action: "gdgallery_save_shortcode_options",
            nonce: inlinePopup.nonce,
            form_id: id,
            name: name,
        };
        jQuery.post(ajaxurl, data, function (response) {
        }, "json");
        return false;
    });

    jQuery("#gdfrm_select").on("change", function () {
        var name = jQuery("#form_name").val();
        id = jQuery('#gdfrm_select option:selected').val();
        var data = {
            action: "gdgallery_shortcode_change_gallery",
            nonce: inlinePopup.nonce,
            form_id: id,
            name: name,
        };
        jQuery.post(ajaxurl, data, function (response) {
            if (response.success) {
                jQuery("#form_name").val(response.name);

            }
        }, "json")
        return false;
    });
});