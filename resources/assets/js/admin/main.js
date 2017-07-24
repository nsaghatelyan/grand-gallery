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

    jQuery("#gdgallery_settings_section").click(function (e) {
        e.preventDefault();

        jQuery('.settings-toogled-container').animate({height: 'toggle'}, 200);
        if (jQuery(this).data("status") == "show") {
            gdgalleryAnimateRotate(180, 0);
            jQuery(this).data("status", "hide");
        }
        else {
            gdgalleryAnimateRotate(0, 180);
            jQuery(this).data("status", "show");
        }
    });

    function gdgalleryAnimateRotate(d1, d2) {
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
        var selected_images = [];
        custom_uploader.on('select', function () {
            attachments = custom_uploader.state().get('selection').toJSON();
            for (var key in attachments) {
                jQuery("#gdgallery_images_name[" + id + "]").val(attachments[key].url + ';;;' + jQuery("#" + id).val());
                selected_images.push({
                    id: attachments[key].id,
                    url: attachments[key].url,
                    name: attachments[key].title
                });
            }

            console.log(selected_images);
            gdgalleryAddItem(selected_images, "image");

        });
        custom_uploader.open();
    });

    jQuery("#gdgallery_add_video_form").submit(function (e) {
        e.preventDefault();

        var form = jQuery(gdgallery_add_video_form),
            submitBtn = form.find('input[type=submit]'),
            general_data = form.serialize();


        gdgalleryAddItem(general_data, "video");

    })

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

    jQuery(".gdgallery_edit_gallery_images").click(function (e) {
        e.preventDefault();
        gdgalleryModalGallery.show('gdgallery-editimages-modal');
    });

    function galleryImgSubmitButton(pressbutton) {
        if (!document.getElementById('name').value) {
            alert("Name is required.");
            return;
        }

        if (!((jQuery('#huge_it_sl_effects').val() == 1) || (jQuery('#huge_it_sl_effects').val() == 3))) if (jQuery('#content_per_page').val() < 1) {
            alert("Images Per Page must be greater than 0.");
            return;
        }

        document.getElementById("adminForm").action = document.getElementById("adminForm").action + "&task=" + pressbutton;
        document.getElementById("adminForm").submit();
    }

})


jQuery(document).ready(function () {
    var doingAjax = false;
    jQuery('#gdgallery_images_form').on('submit', function (e) {
        e.preventDefault();

        if (doingAjax) return false;

        var form = jQuery('#gdgallery_images_form'),
            submitBtn = form.find('input[type=submit]'),
            formData = form.serialize(),
            general_data = {
                action: "gdgallery_save_gallery",
                nonce: gallerySave.nonce,
                gallery_id: jQuery("input[name=gdgallery_id_gallery]").val(),
                gallery_name: jQuery("input[name=gdgallery_name]").val(),
                formdata: formData
            };

        jQuery.ajax({
            url: ajaxurl,
            method: 'post',
            data: general_data,
            dataType: 'text',
            beforeSend: function () {
                doingAjax = true;
                submitBtn.attr("disabled", 'disabled');
                submitBtn.parent().find(".spinner").css("visibility", "visible");
            }
        }).always(function () {
            doingAjax = false;
            submitBtn.removeAttr("disabled");
            submitBtn.parent().find(".spinner").css("visibility", "hidden");
        }).done(function (response) {
            if (response == 1) {
                toastr.success('Saved Successfully');
            } else {
                toastr.error('Error while saving');
            }
        }).fail(function () {
            toastr.error('Error while saving');
        });

        return false;
    });

    jQuery('.settings-section-heading').on('click', function () {
        var section = jQuery(this).closest('.settings-section-wrap');
        section.toggleClass('active');
    });

    jQuery('#gdgallery_edited_images_form').on('submit', function (e) {
        e.preventDefault();
        var form = jQuery('#gdgallery_edited_images_form'),
            submitBtn = form.find('input[type=submit]'),
            formData = form.serialize(),
            general_data = {
                action: "gdgallery_save_gallery_images",
                nonce: gallerySave.nonce,
                gallery_id: jQuery("input[name=gdgallery_id_gallery]").val(),
                formdata: formData
            };


        jQuery.ajax({
            url: ajaxurl,
            method: 'post',
            data: general_data,
            dataType: 'text',
            beforeSend: function () {
                doingAjax = true;
                submitBtn.attr("disabled", 'disabled');
                submitBtn.parent().find(".spinner").css("visibility", "visible");
            }
        }).always(function () {
            doingAjax = false;
            submitBtn.removeAttr("disabled");
            submitBtn.parent().find(".spinner").css("visibility", "hidden");
        }).done(function (response) {
            if (response == 1) {
                toastr.success('Saved Successfully');
            } else {
                toastr.error('Error while saving');
            }
        }).fail(function () {
            toastr.error('Error while saving');
        });

        return false;
    });

    jQuery(".gdgallery_item_overlay input[type=checkbox]").change(function () {
        if (jQuery(this).is(':checked')) {
            /* jQuery(this).parent().parent().css({
             "border": "2px solid #2279e0"
             });*/
            jQuery(this).parent().addClass("active_item");
        }
        else {
            /*jQuery(this).parent().parent().css({
             "border": "0px"
             });*/
            jQuery(this).parent().removeClass("active_item");

        }
    })


    jQuery(".gdgallery_remove_selected_images").click(function (e) {
        e.preventDefault();
        var checked_items = [];
        jQuery(".gdgallery_item input:checked").each(function (key, item) {
            checked_items.push(jQuery(this).val());
        })

        general_data = {
            action: "gdgallery_remove_gallery_items",
            nonce: gallerySave.nonce,
            gallery_id: jQuery("input[name=gdgallery_id_gallery]").val(),
            formdata: checked_items
        };

        jQuery.ajax({
            url: ajaxurl,
            method: 'post',
            data: general_data,
            dataType: 'text',
            beforeSend: function () {
                doingAjax = true;
                jQuery(".gdgallery_remove_selected_images").addClass("disabled_remove_link");
            }
        }).always(function () {
            doingAjax = false;
        }).done(function (response) {
            if (response == 1) {
                toastr.success('Selected Items Removed Successfully');
                jQuery(".gdgallery_remove_selected_images").removeClass("disabled_remove_link");
                window.setTimeout('location.reload()', 500)
            } else {
                toastr.error('Error while removing items');
            }
        }).fail(function () {
            toastr.error('Error while removing items');
        });


    });

    jQuery(".items_checkbox").change(function () {
        var count = jQuery(".gdgallery_item input:checked").length;
        if (count > 0) {
            jQuery(".gdgallery_remove_selected_images").show();
            jQuery("input[name=select_all_items]").prop("checked", true);
        }
        else {
            jQuery(".gdgallery_remove_selected_images").hide();
            jQuery("input[name=select_all_items]").prop("checked", false);
        }
    });

    jQuery("#gdgallery_select_all_items").change(function () {
        if (jQuery(this).attr("checked") == 'checked') {
            jQuery(".gdgallery_item input[type='checkbox']").attr("checked", "checked");
            jQuery(".gdgallery_item_overlay").addClass("active_item");
            jQuery(".gdgallery_remove_selected_images").show();
        }
        else {
            jQuery(".gdgallery_item input[type='checkbox']").removeAttr("checked");
            jQuery(".gdgallery_item_overlay").removeClass("active_item");
            jQuery(".gdgallery_remove_selected_images").hide();
        }
    })
});

jQuery(document).ready(function ($) {
    var fixHelperModified = function (e, tr) {
            tr.css("background", "#f5f1f1");
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function (index) {
                $(this).width($originals.eq(index).width())
            });
            tr.css("background", "#fff");
            return $helper;
        },
        updateIndex = function (e, ui) {

            $('td.index', ui.item.parent()).each(function (i) {
                $(this).find("input").val(i + 1);
            });
        };

    $("#sort tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();

    jQuery("#gdgallery_display_type").change(function () {
        if (jQuery(this).val() == 0) {
            jQuery(".gdgallery_items_per_page_section").addClass("gdgallery_hidden");
        }
        else {
            jQuery(".gdgallery_items_per_page_section").removeClass("gdgallery_hidden");
        }
    });

    jQuery("input[name=gdgallery_view_type]").change(function () {
        var grid_arr = ['0', '1', '4'];
        if (jQuery.inArray(jQuery(this).val(), grid_arr) !== -1) {
            jQuery(".gdgallery_display_type_section").removeClass("gdgallery_hidden");
            jQuery(".gdgallery_items_per_page_section").removeClass("gdgallery_hidden");
            jQuery(".gdgallery_hover_effect_section").removeClass("gdgallery_hidden");
        }
        else {
            jQuery(".gdgallery_display_type_section").addClass("gdgallery_hidden");
            jQuery(".gdgallery_items_per_page_section").addClass("gdgallery_hidden");
            jQuery(".gdgallery_hover_effect_section").addClass("gdgallery_hidden");
        }
    });

    jQuery(".gdgallery_item_edit").click(function (e) {
        e.preventDefault();

        var post_id = jQuery(this).data("post-id");
        wp.media.editor.open(post_id);
    })
})

function gdgalleryAddItem(data, type) {
    var form, submitBtn;
    if (type == "video") {
        form = jQuery('#gdgallery_add_video_form');
        submitBtn = form.find('input[type=submit]');
    }
    var general_data = {
        action: "gdgallery_add_gallery_" + type,
        nonce: gallerySave.nonce,
        gallery_id: jQuery("input[name=gdgallery_id_gallery]").val(),
        formdata: data
    };


    jQuery.ajax({
        url: ajaxurl,
        method: 'post',
        data: general_data,
        dataType: 'text',
        beforeSend: function () {
            doingAjax = true;
            if (type == "video") {
                submitBtn.attr("disabled", 'disabled');
                submitBtn.parent().find(".spinner").css("visibility", "visible");
            }
        }
    }).always(function () {
        doingAjax = false;
        if (type == "video") {
            submitBtn.removeAttr("disabled");
            submitBtn.parent().find(".spinner").css("visibility", "hidden");
        }
    }).done(function (response) {
        if (response == 1) {
            toastr.success(' Added Successfully');
            window.setTimeout('location.reload()', 500)
        } else {
            toastr.error('Error while saving');
        }
    }).fail(function () {
        toastr.error('Error while saving');
    });
}




