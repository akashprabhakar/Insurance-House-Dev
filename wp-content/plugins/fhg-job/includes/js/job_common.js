
$ = jQuery.noConflict();
$(document).ready(function() {

    //$('#my_editor_1-html').hide();
    //$('#my_editor_2-html').hide();


    $('#reset_jobs').click(function() {
        $("label.error").hide();
    });

    $("#job_display_to_date").datepicker({
        dateFormat: "mm-dd-yy",
        minDate: 0,
        //showOn:'button'
        showButtonPanel: true
                //clearText:'Clear'

    });

    // Enable the today button in datepicker

    $.datepicker._gotoToday = function(id) {
        var target = $(id);
        var inst = this._getInst(target[0]);
        if (this._get(inst, 'gotoCurrent') && inst.currentDay) {
            inst.selectedDay = inst.currentDay;
            inst.drawMonth = inst.selectedMonth = inst.currentMonth;
            inst.drawYear = inst.selectedYear = inst.currentYear;
        }
        else {
            var date = new Date();
            inst.selectedDay = date.getDate();
            inst.drawMonth = inst.selectedMonth = date.getMonth();
            inst.drawYear = inst.selectedYear = date.getFullYear();
            // the below two lines are new
            this._setDateDatepicker(target, date);
            this._selectDate(id, this._getDateDatepicker(target));
        }
        this._notifyChange(inst);
        this._adjustDate(target);
    }



    $('#reset_jobs').click(function() {
        $(".validate").find('.hidden').css('display', 'none');
    });


    $('#add_jobs_submit').click(function() {
        $('#addtag').validate();
        $file_val = $('#file').val();
        if ($file_val) {
            $file_val = $file_val.toLowerCase();
            $file_extn = $file_val.indexOf(".pdf");
            if ($file_extn >= 0) {
                return true;
            } else {
                $('.hidden').css('display', 'inline-block');
                return false;
            }
        }

    });


});


