jQuery(function () {
    jQuery("#fields-list").sortable({
        connectWith: "div",
    });

});

jQuery(function () {
    jQuery(".options").sortable({
        connectWith: ".option",
    });

});


jQuery('.gdfrm_delete_form').on('click', function () {
    if (!confirm("Are you sure you want to delete this item?")) {
        return false;
    }
});


//jQuery( ".datepicker" ).datepicker();

jQuery('body').on('focus', ".datepicker", function () {
    jQuery(this).datepicker({dateFormat: "dd-mm-yy"});
})

jQuery('input#select-all').on('change', function () {
    if (this.checked) {
        jQuery('input.item-checkbox').prop('checked', true);
    } else {
        jQuery('input.item-checkbox').prop('checked', false);
    }
});

jQuery(document).ready(function () {
    /* remove,read checked forms */
    jQuery('#doaction').on('click tap', function (e) {
        e.preventDefault();

        var action = jQuery('#bulk-action-selector-top').val();

        var items = jQuery('input.item-checkbox:checked');

        items.each(function () {
            var id = jQuery(this).val();
            var row = jQuery(this).closest('tr');
            var _this = jQuery(this);

            if (action == 'trash') {
                var data = {
                    action: "gdfrm_remove_form",
                    nonce: form.removeNonce,
                    id: id
                };
                jQuery.post(ajaxurl, data, function (response) {
                    if (response.success) {
                        row.remove();
                    } else {
                        alert('not done');
                    }
                }, "json");
            }
        })

        return false;
    })


    jQuery(document).on('change', '.switch-checkbox.mask-switch', function () {
        if (this.checked) {
            jQuery(this).closest('.setting-row').find('.description').removeClass('readonly');
            jQuery(this).closest('.settings-block').find('.setting-row.setting-default').addClass('readonly');
            jQuery(this).closest('.settings-block').find('.setting-row.setting-placeholder').addClass('readonly');
        } else {
            jQuery(this).closest('.setting-row').find('.description').addClass('readonly');
            jQuery(this).closest('.settings-block').find('.setting-row.setting-placeholder').removeClass('readonly');
            jQuery(this).closest('.settings-block').find('.setting-row.setting-default').removeClass('readonly');
        }
    });

    jQuery("#settings_container_switcher").click(function (e) {
        e.preventDefault();

        jQuery('.settings-toogled-container').animate({height: 'toggle'}, 200);
        if (jQuery(this).data("status") == "show") {
            AnimateRotate(0, 180);
            jQuery(this).data("status", "hide");
        }
        else {
            AnimateRotate(180, 0);
            jQuery(this).data("status", "show");
        }
    });

    function AnimateRotate(d1, d2) {
        var elem = jQuery("#settings_container_switcher img");

        jQuery({deg: d1}).animate({deg: d2}, {
            duration: 200,
            step: function (now) {
                elem.css({
                    transform: "rotate(" + now + "deg)"
                });
            }
        });
    }


    var custom_uploader;
    jQuery('#watermark_image_btn_new').click(function (e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose file',
            button: {
                text: 'Choose file'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function () {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            jQuery("#watermark_image_new").attr("src", attachment.url);
            jQuery('#img_watermark_hidden_new').attr('value', attachment.url);
        });
        custom_uploader.open();
    });

    jQuery('.remove-image-container a').on('click', function () {
        var galleryId = jQuery(this).data('gallery-id');
        var imageId = jQuery(this).data('image-id');
        var removeNonce = jQuery(this).data('nonce-value');
        jQuery('#adminForm').attr('action', 'admin.php?page=galleries_huge_it_gallery&task=edit_cat&id=' + galleryId + '&removeslide=' + imageId + '&save_data_nonce=' + removeNonce);
        galleryImgSubmitButton('apply');
    });

    var _custom_media = true,
        _orig_send_attachment = wp.media.editor.send.attachment;

    jQuery('.gdgallery_add_new_image').click(function (e) {
        e.preventDefault();
        var button = jQuery(this);
        var id = button.attr('id').replace('_button', '');
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Insert Into Gallery',
            button: {
                text: 'Insert Into Gallery'
            },
            multiple: true
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function () {
            attachments = custom_uploader.state().get('selection').toJSON();
            for (var key in attachments) {
                jQuery("#" + id).val(attachments[key].url + ';;;' + jQuery("#" + id).val());
            }
            jQuery("#save-buttom").click();
        });
        custom_uploader.open();
    });

    jQuery('.add_media').on('click', function () {
        _custom_media = false;

    });

    jQuery(".wp-media-buttons-icon").click(function () {
        jQuery(".media-menu .media-menu-item").css("display", "none");
        jQuery("" +
            ":first").css("display", "block");
        jQuery(".separator").next().css("display", "none");
        jQuery('.attachment-filters').val('image').trigger('change');
        jQuery(".attachment-filters").css("display", "none");
    });

    jQuery(".gdgallery_add_new_video").click(function () {
        gdgalleryModalGallery.show('gdgallery-addvideo-modal');
    });

})


