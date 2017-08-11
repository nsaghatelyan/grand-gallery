jQuery(document).ready(function () {
    var link = jQuery("#item_as_link_justified input[type=checkbox]");
    disableFiled(link);

    var switcher = jQuery("#realtimepreview").data("enable");
    jQuery("#realtimepreview").click(function (e) {
        e.preventDefault();

        if (switcher == "off") {
            switcher = "on";
            jQuery(this).html("Real Time preview ON");
            jQuery(".iframe_section").show();
            jQuery(".ui-tabs-panel").css("width", "35%");
        }
        else {

            switcher = "off";
            jQuery(this).html("Real Time preview OFF");
            jQuery(".iframe_section").hide();
            jQuery(".ui-tabs-panel").css("width", "auto");
        }
    })


    jQuery("#item_as_link_justified input[type=checkbox]").change(function () {
        disableFiled(this);
    });

    function disableFiled(em) {
        if (em.checked) {
            jQuery("#show_icons_justified").addClass("disabled_option");
            jQuery("#show_icons_justified .slider").hide();
        }
        else {
            jQuery("#show_icons_justified").removeClass("disabled_option");
            jQuery("#show_icons_justified .slider").show();
        }
    }

    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() >= 300) {
            if (jQuery(".settings-save-head").hasClass("settings-save-fixed") === false) {
                jQuery(".settings-save-head").addClass("settings-save-fixed");
            }
            jQuery(".iframe_section").css("top", "15%");
            $('.gdgallery_scrollup').fadeIn();
        }
        else {
            if (jQuery(".settings-save-head ").hasClass("settings-save-fixed")) {
                jQuery(".settings-save-head").removeClass("settings-save-fixed");
            }
            jQuery(".iframe_section").css("top", "43%");
            $('.gdgallery_scrollup').fadeOut();
        }
    });

    $('.gdgallery_scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
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
                FrameID = "test_frame";
                document.getElementById(FrameID).contentDocument.location.reload(true);
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