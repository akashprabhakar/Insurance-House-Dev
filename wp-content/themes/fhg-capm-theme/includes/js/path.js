var protocol = window.location.protocol;
var hostname = window.location.hostname;
var port = window.document.location.port;
var full_pathname = window.location.pathname;
var split_pathname = full_pathname.split('/');

//CHANGE THE SERVER VARIABLE HERE TO 'Development', 'UAT' OR 'Live'.

var server = "Development";
switch (server) {
    case "Development":
        var pathname = split_pathname[1];
        var pagename = split_pathname[2];
        var pagename_2 = split_pathname[3];
        var base_url = protocol + "//" + hostname + "/" + pathname;
        break;
    case "UAT":
        var pathname = split_pathname[1];
        var pagename = split_pathname[2];
        var pagename_2 = split_pathname[3];
        var base_url = protocol + "//" + hostname + ":" + port  + "/" + pathname;
        console.log(base_url);
        console.log(full_pathname);
        break;
    case "Live":
        var pathname = split_pathname[0];
        var pagename = split_pathname[1];
        var pagename_2 = split_pathname[2];
        var base_url = protocol + "//" + hostname;
        break;
}

var fpath_ar = window.location.href;
var split_pathname_ar = fpath_ar.split('?');
var pathname_ar = split_pathname_ar[1];

var base_url1 = protocol + "//" + hostname + "/" + pathname + "/" + pagename + "/" + pagename_2;
var base_url_main = protocol + "//" + hostname + "/" + pathname;
var js_base_home = protocol + "//" + hostname + "/" + pathname + "/" + pagename

/*Define required paths*/
var theme_url = base_url + "/wp-content/themes/fhg-capm-theme";
var img_path = theme_url + "/includes/images";
var jspath = theme_url + "/includes/js";
var css_path = theme_url + "/includes/css";
var plugin_url_js = protocol + "//" + hostname + "/" + pathname + "/" + "wp-content/plugins";

