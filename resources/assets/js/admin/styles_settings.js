jQuery(document).ready(function () {

    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() >= 100) {
            if (jQuery(".settings-save-head").hasClass("settings-save-fixed") === false) {
                jQuery(".settings-save-head").addClass("settings-save-fixed");
            }
        }
        else {
            if (jQuery(".settings-save-head ").hasClass("settings-save-fixed")) {
                jQuery(".settings-save-head").removeClass("settings-save-fixed");
            }
        }
    });

    var doingAjax = false;
    jQuery('#settings_form').on('submit', function (e) {
        e.preventDefault();

        if (doingAjax) return false;

        var form = jQuery('#settings_form'),
            submitBtn = form.find('input[type=submit]'),
            formData = form.serialize(),
            general_data = {
                action: "gdgallery_save_settings",
                formdata: formData
            };

        console.log(formData);

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
            if (response === 'ok') {
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

});