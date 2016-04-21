var protocol = window.location.protocol;
var hostname = window.location.hostname;
var port = window.document.location.port;
var full_pathname = window.location.pathname;
var split_pathname = full_pathname.split('/');

//CHANGE THE SERVER VARIABLE HERE TO 'Development', 'UAT' OR 'Live'.

var server = "Live";
switch (server) {
    case "Development":
        var pathname = split_pathname[1];
        var pagename = split_pathname[2];
        var pagename_2 = split_pathname[3];
		var pagename_4 = split_pathname[5];
        var base_url = protocol + "//" + hostname + "/" + pathname;
        google_site_key = '6Lfiyw0TAAAAABAlh3YF-ar8TjfV9z8ESozNwSMI';
		break;
    case "UAT":
        var pathname = split_pathname[1];
        var pagename = split_pathname[2];
        var pagename_2 = split_pathname[3];
		var pagename_3 = split_pathname[4];
		var pagename_4 = split_pathname[5];
        var base_url = protocol + "//" + hostname + ":" + port  + "/" + pathname;
		
        // console.log(base_url);
        //console.log(split_pathname);
        //console.log("pagename " + pagename + " pagename_2 " + pagename_2 +  " pagename_3 " + pagename_3 + " pagename_4 " + pagename_4 );
        google_site_key = '6LfA1w0TAAAAAIrHYoGsZ0Nty-pnYcT3EcMZwsIo';
        break;
    case "Live":
        var pathname = split_pathname[0];
        var pagename = split_pathname[1];
        var pagename_2 = split_pathname[2];
		var pagename_3 = split_pathname[3];
		var pagename_4 = split_pathname[4];
		var pagename_5 = split_pathname[5];
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
var theme_url = base_url + "/wp-content/themes/fhg_theme";
var img_path = theme_url + "/images";
var jspath = theme_url + "/js";
var css_path = theme_url + "/css";
var plugin_url_js = protocol + "//" + hostname + "/" + pathname + "/" + "wp-content/plugins";

