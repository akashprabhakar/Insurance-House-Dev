

/* <![CDATA[ */
jQuery(document).ready(function() {
    //jQuery('#joblist').dataTable();
    //jQuery('#mytable').dataTable();
    jQuery("#Display_Till_Date").datepicker({
        dateFormat: "yy-mm-dd"
    });
    $('#submit').click(function() {
        jQuery('#addtag').validate();
    });
});
/* ]]> */


