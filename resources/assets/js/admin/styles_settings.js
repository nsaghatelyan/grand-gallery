jQuery(document).ready(function () {


    /* var switcher = jQuery("#realtimepreview").data("enable");
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
     })*/


    var load_type = jQuery(".show_loader .input-wrap select")
    var load_color = jQuery("#loader_color_slider .input-wrap select");

    // jQuery(".show_loader .input-wrap").append("<div  class='loader-" + load_color.val() + load_type.val() + "' style='position: absolute; right: 150px;'></div>");
    showLoader(load_type, load_color);

    function showLoader(type, color) {
        jQuery(".show_loader .input-wrap").append("<div id='show_loader' style='position: absolute; right: 150px;'><div  class='loader-" + color.val() + type.val() + "' ></div></div>");
        type.change(function () {
            type = jQuery(this).val();
            color = jQuery("#loader_color_slider .input-wrap select").val();
            jQuery("#show_loader").empty();
            jQuery(".show_loader .input-wrap #show_loader").append("<div  class='loader-" + color + type + "' ></div>");
        });

        color.change(function () {
            color = jQuery(this).val();
            type = jQuery(".show_loader .input-wrap select").val();
            jQuery("#show_loader").empty();
            jQuery(".show_loader .input-wrap #show_loader").append("<div  class='loader-" + color + type + "' ></div>");
        });
    }

    var link_j = jQuery("#item_as_link_justified input[type=checkbox]");
    var link_t = jQuery("#item_as_link_tiles input[type=checkbox]");
    var link_c = jQuery("#item_as_link_carousel input[type=checkbox]");
    var link_g = jQuery("#item_as_link_grid input[type=checkbox]");
    disableFiled(link_j, "justified");
    disableFiled(link_t, "tiles");
    disableFiled(link_c, "carousel");
    disableFiled(link_g, "grid");


    function disFiled(em, view) {
        if (em.prop("checked") === true) {
            jQuery("#show_icons_" + view).addClass("disabled_option");
        }
        else {
            jQuery("#show_icons_" + view).removeClass("disabled_option");
        }
    }

    function disableFiled(em, view) {
        disFiled(em, view);
        em.change(function () {
            disFiled(em, view);
        })
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