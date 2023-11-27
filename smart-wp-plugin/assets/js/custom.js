(function(so, $) {
    'use strict';

    var p = so.ap = {};
    p.image_frame = null;

    p.init = function() {

        var $body = $('body');

        $body.on('click', '.addGalleryImages', function(e) {
            var $this = $(e.currentTarget);
            p.$parent = $this.parent();

            if (p.image_frame) {
                p.image_frame.open();
                return false;
            }

            if (!p.image_frame) {
                p.image_frame = wp.media({
                    title: 'Select Gallery Images',
                    multiple: 'add',
                    library: {
                        type: 'image',
                    }
                });

                p.image_frame.on('close', function() {
                    var selection = p.image_frame.state().get('selection');
                    let template = '';
                    if (selection) {
                        selection.map(function(attachment) {
                            attachment = attachment.toJSON();
                            template += gallerTemplate(attachment.id, attachment.url)
                        });
                    }
                    $("#gallery_row").append(template);
                });

                p.image_frame.open();
            }
            return false;
        });
        $body.on('click', '#imageUpload', function(e) {
            if (p.feature_frame) {
                p.feature_frame.open();
                return false;
            }

            if (!p.feature_frame) {
                p.feature_frame = wp.media({
                    title: 'Select Employee Image',
                    multiple: false,
                    library: {
                        type: 'image',
                    }
                });

                p.feature_frame.on('close', function() {
                    var selection = p.feature_frame.state().get('selection');
                    let template = '';
                    if (selection) {
                        var json = selection.toJSON();
                        jQuery('#imagePreview').css('background-image', 'url(' + json[0].url + ')');
                        jQuery('#imagePreview').hide();
                        jQuery('#imagePreview').fadeIn(650);
                        jQuery("#imageUpload").val(json[0].id);

                    }
                });

                p.feature_frame.open();
            }
            return false;
        });
        $body.on('click', '#imageUpload1', function(e) {
            if (p.feature_frame) {
                p.feature_frame.open();
                return false;
            }

            if (!p.feature_frame) {
                p.feature_frame = wp.media({
                    multiple: false,
                    library: {
                        type: 'image',
                    }
                });

                p.feature_frame.on('close', function() {
                    var selection = p.feature_frame.state().get('selection');
                    let template = '';
                    if (selection) {
                        var json = selection.toJSON();
                        jQuery('#imagePreview1').css('background-image', 'url(' + json[0].url + ')');
                        jQuery('#imagePreview1').hide();
                        jQuery('#imagePreview1').fadeIn(650);
                        jQuery("#imageUpload1").val(json[0].id);

                    }
                });

                p.feature_frame.open();
            }
            return false;
        });
    }
    p.getPetImagesHTML = function(i) {
        return '<div class="jitem p10" data-index="' + i + '">\
                <button class="button vm upload_image">Add Image</button>\
                <img class="vm" width="150px" height="150px" src="' + so.ap_url + '/admin/images/placeholder.png" alt="">\
                <input name="image_gallary[]" type="hidden" >\
            <button class="button fr btn-delete">x</button>\
        </div>';
    }
    jQuery("#SmartWpPlugin-preloader").hide();
})(window.so = window.so || {}, jQuery);

jQuery(document).ready(so.ap.init);

function deleteRow(element) {
    jQuery(element).parent('.gallery-cols').remove();
}

function showModal(modal, formid, title, ids = null) {
    if (ids != null) {
        jQuery.each(ids, (i, el) => {

            if (jQuery(el).is("select")) {
                jQuery(el).val(null).trigger('change');
            } else {
                jQuery(el).val('');
                jQuery(el).html('');
            }
        })
    }
    jQuery(".ServiceList").removeAttr('checked');

    jQuery("#" + formid).trigger('reset');
    jQuery("#" + formid).children("input[name='id']").val('');

    if (jQuery('#home-tab').length > 0) {
        jQuery("#home-tab").trigger('click');
    }
    if (jQuery('#imagePreview').length > 0) {

        jQuery('#imagePreview').hide();
        jQuery('#imagePreview').fadeIn(650);
    }
    jQuery("#" + modal + "-title").text(title);
    jQuery("label.error").remove();
    jQuery("#lbl-duplicate-email").addClass('d-none');
    jQuery("#" + modal).modal("show");

}

function showOnlyModal(modal, title) {
    jQuery("#" + modal + "-title").text(title);
    jQuery("label.error").remove();
    jQuery("#lbl-duplicate-email").addClass('d-none');
    jQuery("#" + modal).modal("show");
}


function resetForm(formid, ids = null) {

    if (ids != null) {
        jQuery.each(ids, (i, el) => {

            if (jQuery(el).is("select")) {
                jQuery(el).val(null).trigger('change');
            } else {
                jQuery(el).val('');
                jQuery(el).html('');
            }
        })
    }
    jQuery(".ServiceList").removeAttr('checked');
    jQuery("#" + formid).trigger('reset');
    jQuery("#" + formid).children("input[name='id']").val('');
    jQuery("#home-tab").trigger('click');
    jQuery("#lbl-duplicate-email").addClass('d-none');
    jQuery("label.error").remove();
}

function closeModal(modal) {
    jQuery("#" + modal).modal("toggle");
}

function gallerTemplate(id, url) {
    let template = `<div id="${id}" class="gallery-cols col-md-3">
        <button onclick="deleteRow(this)" type="button" id="x">
            X
        </button>
        <img src="${url}"
            class="img-fluid rounded"/>
        <input type="hidden" value="${id}" name="gallery_image[]" />
    </div>`;
    return template;
}

function workHourTemplate(day, id, type, from, to) {
    let template = `<div data-day="${day}" class="row">
                <div class="col-md-10">`;
    if (type == 'break')
        template += `<span class="text-danger">${from}-${to}</span>`;
    else
        template += `<span>${from}-${to}</span>`;
    template += `</div>
                <div class="col-md-2">
                
                <a data-day="${day}" href="javascript:void(0)" class="DeleteTimingButton text-right float-right mr-1">
                    <i class="fa fa-minus text-danger customIcon"></i>
                </a>
                <a data-day="${day}" href="javascript:void(0)"
                    class="EditTimingButton text-right float-right ml-1">
                    <i class="fa fa-pencil text-info customIcon"></i>
                </a>
                    <input class="formIdValue" data-day="${day}" type="hidden" name="workhour[id][]" value="${id}">
                    <input class="formTypeValue" data-day="${day}" type="hidden" name="workhour[type][]" value="${type}">
                    <input class="formDayValue" data-day="${day}" type="hidden" name="workhour[day][]" value="${day}">
                    <input class="formFromTimeValue" data-day="${day}" type="hidden" name="workhour[start_time][]" value="${from}">
                    <input class="formToTimeValue" data-day="${day}" type="hidden" name="workhour[end_time][]" value="${to}">
                </div>
                <hr class="w-100">
            </div>`;
    jQuery(".AppendView-" + day).append(template);
    jQuery(".fromTime-" + day).val('');
    jQuery(".toTime-" + day).val('');
    jQuery(".addView-" + day).addClass('d-none');
}

function daysOffTemplate(id, name, date, description) {
    let template = `
    <div data-date="${date}" class="HolidayDataRow row w-100 mx-auto">
        <input type="hidden" name="holiday_id[]" value="${id}"/>
        <input type="hidden" name="holiday_name[]" value="${name}"/>
        <input type="hidden" name="holiday_date[]" value="${date}"/>
        <input type="hidden" name="holiday_description[]" value="${description}"/>
        <div class="col-md-4">
        ${name}
        </div>
        <div class="col-md-4">
        ${date}
        </div>
        <div class="col-md-4">
            <a  href="javascript:void(0)"
                class="DeleteDaysoffButton text-right float-right ml-2">
                <i class="fa fa-minus text-danger customIcon"></i>
            </a>
            <a  href="javascript:void(0)"
                class="EditDaysOffButton text-right float-right ml-2">
                <i class="fa fa-pencil text-info customIcon"></i>
            </a>
        </div>
        <hr class="col-md-12 w-100">
    </div>`;
    return template;
}

function EmployeedaysOffTemplate(id, date) {
    let template = `
    <div data-date="${date}" class="HolidayDataRow row w-100 mx-auto">
        <input type="hidden" name="holiday_id[]" value="${id}"/>
        
        <input type="hidden" name="holiday_date[]" value="${date}"/>
        <div class="col-md-6">
        ${date}
        </div>
        <div class="col-md-6">
            <a  href="javascript:void(0)"
                class="DeleteDaysoffButton text-right float-right ml-2">
                <i class="fa fa-minus text-danger customIcon"></i>
            </a>
            <a  href="javascript:void(0)"
                class="EditDaysOffButton text-right float-right ml-2">
                <i class="fa fa-pencil text-info customIcon"></i>
            </a>
        </div>
        <hr class="col-md-12 w-100">
    </div>`;
    return template;
}
function getDisabledRanges(day){

    let prev_from_array = [];
    let prev_to_array = [];
    let disabled_ranges = [];
    jQuery(".AppendView-" + day ).find(".row").not(".InEditMode").find("input[name='workhour[start_time][]']").map(function () {
        prev_from_array.push((this).value);
    });
    jQuery(".AppendView-" + day ).find(".row").not(".InEditMode").find("input[name='workhour[end_time][]']").map(function () {
        prev_to_array.push((this).value);
    });
    for (let i = 0; i < prev_from_array.length; i++) {
        disabled_ranges.push([prev_from_array[i],prev_to_array[i]]);
    }
    return disabled_ranges;
}
jQuery(document).ready(function() {
    jQuery('.myselect2').select2({
        placeholder: "Select Items",
        width: "100%",
    });
    jQuery(".SmartWpPlugin-note").click(function() {
        jQuery("#SmartWpPlugin-detailed-note-head").text(jQuery(this).data('service'));
        jQuery("#SmartWpPlugin-detailed-note-body").html(`<p>${jQuery(this).data('note')}</p>`);
        jQuery('#SmartWpPlugin-detailed-note').modal('toggle');
     });
});
jQuery(document).ready(function() {
    // CKEDITOR.replace('editor', {});
    if (window.jQuery().datetimepicker) {
        jQuery('.datepicker').datetimepicker({
            // Formats
            // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
            minDate: new Date(),
            format: 'DD-MM-YYYY',
            // Your Icons
            // as Bootstrap 4 is not using Glyphicons anymore
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });
    }
});
jQuery("#calendar").hide();
jQuery("#loadStep3").hide();

function validate(form) {
    jQuery("#" + form).validate({
        submitHandler: function(form) {
            jQuery("#SmartWpPlugin-preloader").show();
            form.submit();
        }
    });
}

function loadDataTable(tableId) {
    jQuery(tableId).DataTable({
         "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5 mt-4'i><'col-sm-12 col-md-2 mt-4'p>>",
       
        "ordering": false,
        'language': {

        'paginate': {
            'previous': '<i class="fa fa-arrow-left"></i>',
            'next': '<span class="fa fa-arrow-right"></span>'
          }
        }
    });
}
window.addEventListener("load", function() {

	// store tabs variables
	var tabs = document.querySelectorAll("ul.nav-tabs > li");

	for (i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();
		
		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}

});
