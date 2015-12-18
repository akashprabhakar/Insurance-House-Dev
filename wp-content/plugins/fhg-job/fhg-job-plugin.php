<?php

/*
  Plugin Name: Manage Jobs
  Description: This plugin is used for adding, editing, deleting and listing the job module at admin the interface.
  Author:Annet Technologies
 */
//require(ABSPATH.'wp-load.php');
require(ABSPATH . 'wp-includes/pluggable.php');
include(ABSPATH . 'wp-content/plugins/fhg-job/config/config.php');
include(JS_INCLUDES_ADMIN_CLASS_DIR . DS . 'jobclass.php');
include(JS_INCLUDES_ADMIN_CLASS_DIR . DS . 'applicationclass.php');
include(ABSPATH . 'wp-content/plugins/fhg-job/includes/php/applicationfrontend_class.php');
include(ABSPATH . 'wp-content/plugins/fhg-job/includes/php/custom_login.php');

$objMem = new jobClass();
$objApp = new applicationClass();



/* Runs when plugin is activated */

function jobs_plugin_activate() {
  global $wpdb;

  $sql = "CREATE TABLE IF NOT EXISTS " . JS_TABLENAME . " (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(100) DEFAULT NULL,
  `job_title_ar` varchar(100) DEFAULT NULL,
  `job_phone_no` varchar(50) DEFAULT NULL,
  `job_location` varchar(100) DEFAULT NULL,
  `job_location_ar` varchar(100) DEFAULT NULL,
  `job_description` varchar(1000) DEFAULT NULL,
  `job_description_ar` varchar(1000) DEFAULT NULL,
  `job_display_to_date` date DEFAULT NULL,
  `job_hr_email` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`job_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";


  $sql_app = "CREATE TABLE IF NOT EXISTS " . APP_TABLENAME . " (
  `applicationid` int(11) NOT NULL AUTO_INCREMENT,
  `application_title` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `application_firstname` varchar(100) DEFAULT NULL,
  `application_lastname` varchar(18) DEFAULT NULL,
  `application_email` varchar(100) DEFAULT NULL,
  `application_mobileno` varchar(100) DEFAULT NULL,
  `application_education` varchar(100) DEFAULT NULL,
  `application_experience` varchar(100) DEFAULT NULL,
  `application_source` varchar(100) DEFAULT NULL,
  `application_linkedinurl` text,
  `application_c_letter` text,
  `application_resume_filename` varchar(100) DEFAULT NULL,
  `application_status` varchar(50) DEFAULT 'New',
  `job_id` int(11) DEFAULT NULL,
  `date_time_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`applicationid`),
  KEY `applicationid` (`applicationid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
  require_once(ABSPATH . "wp-admin/includes/upgrade.php");
  dbDelta($sql);
  
  dbDelta($sql_app);
}

/* Hook Plugin */
register_activation_hook(__FILE__, 'jobs_plugin_activate');


/* Runs on plugin deactivation */
register_deactivation_hook(__FILE__, 'jobs_plugin_deactivate');

function jobs_plugin_deactivate() {
  remove_action('admin_menu', 'job_Menu');
  // remove_shortcode($job-section);
}

function my_scripts() {
  if (!is_admin()) {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui.js', JS_INCLUDES_JS . DS . "jquery-ui.js", '');
    wp_enqueue_script('job_common.js', JS_INCLUDES_JS . DS . "job_common.js", array('jquery'));
  }
}

add_action('wp_head', 'my_scripts');

/* Creating Menus */

function job_Menu() {

  /* Adding menus */
  add_menu_page(__('Jobs List'), 'Jobs', 8, 'myplug/fhg-job-plugin.php', 'job_list', '', 102);

  /* Adding Sub menus */
  add_submenu_page('myplug/fhg-job-plugin.php', 'View / Edit Jobs', 'View / Edit Jobs', 8, 'myplug/fhg-job-plugin.php', 'job_list', '', 102);

  if (isset($_REQUEST['job_id'])) {
    add_submenu_page('myplug/fhg-job-plugin.php', 'Edit Job', 'Add New Job', 8, 'job_add', 'job_add', '', 102);
  } else {
    add_submenu_page('myplug/fhg-job-plugin.php', 'Add Job', 'Add New Job', 8, 'job_add', 'job_add', '', 102);
  }

  add_submenu_page('myplug/fhg-job-plugin.php', 'Applications', 'Applications', 8, 'myplug/fhg-application-plugin.php', 'application_list', '', 102);

  if (isset($_REQUEST['application_id'])) {
    add_submenu_page('myplug/fhg-application-plugin.php', 'Edit Application', 'Add New Application', 8, 'application_add', 'application_add', '', 102);
  }

  /* Adding Sub menus */
  $rd = $_SERVER['REQUEST_URI'];
  $site_name = explode("=", $rd);
  //print_r($site_name);
  $site_name = $site_name[1];
  if ($site_name == 'job_add' || $site_name == 'myplug/fhg-job-plugin.php' || $site_name == 'job_add&act') {
    wp_enqueue_script('jquery-ui-1.9.1.custom.min.js', JS_INCLUDES_JS . DS . "jquery-ui-1.9.1.custom.min.js", array('jquery'));
    wp_enqueue_script('jquery-ui.js', JS_INCLUDES_JS . DS . "jquery-ui.js");
    wp_enqueue_style('jquery-ui.css', JS_INCLUDES_CSS . DS . "jquery-ui.css");
    wp_enqueue_style('pagination.css', JS_INCLUDES_CSS . DS . "pagination.css");
    wp_enqueue_script('jquery.validate.js', JS_INCLUDES_JS . DS . "jquery.validate.js", array('jquery'));
    wp_enqueue_script('job_common.js', JS_INCLUDES_JS . DS . "job_common.js", array('jquery'));
  }
}

add_action('admin_menu', 'job_Menu');

// View list of jobs
function job_list() {
  include(JS_INCLUDES_ADMIN_DIR . DS . 'joblist.php');
}

function application_list() {
  include(JS_INCLUDES_ADMIN_DIR . DS . 'applicationlist.php');
}

// Add a new Job
function job_add() {
  include(JS_INCLUDES_ADMIN_DIR . DS . 'job-new.php');
}

function application_add() {
  include(JS_INCLUDES_ADMIN_DIR . DS . 'application-new.php');
}

if (isset($_POST["submit"])) {

  if ($_POST["addme"] == "1") {
    $objMem->addNewJob(JS_TABLENAME, $_POST);
    header("Location:admin.php?page=myplug/fhg-job-plugin.php&info=saved");
    exit;
  } else if ($_POST["addme"] == "2") {

    $objMem->updJob(JS_TABLENAME, $_POST);
    header("Location:admin.php?page=myplug/fhg-job-plugin.php&info=upd");
    exit;
  }
}

//add_action('asdasd','addupd');
function addupd($objApp) {

  if ($_POST["addme"] == "2") {

    $added = $objApp->updApplication_sendmail(APP_TABLENAME, $_POST);
  }
  return $added;
}

function sendmail() {
  $attachments = "";
  $headers = 'Content-type: text/html;charset=utf-8' . "\r\n";
  $headers .= 'From: Admin <admin@dispostable.com>' . "\r\n";
  $subject = 'CAPM Job Application Details';
  $message = '<p>Dear ' . $_POST['application_firstname'] . ',</p>';
  if ($_POST['application_status'] != 'On Hold') {
    $message .= 'We have reviewed your job application and based on the same we have ' . $_POST['application_status'] . ' your application.';
  } else {
    $message .= 'We have reviewed your job application and based on the same we have put your application on hold.';
  }
  $message .= '<p>Thank You </p>';
  $message .= '<p>CAPM</p>';
  $mailconfirm = wp_mail($_POST['application_email'], $subject, $message, $headers, $attachments);
  header("Location:admin.php?page=myplug/fhg-application-plugin.php&info=upd");
  exit;
}

if (isset($_POST["application"])) {
  //$objApp = new applicationClass;
  $add = addupd($objApp);
  //echo $add;
  if ($add) {
    add_action('init', 'sendmail', 999);
  }
}
//add_action( 'plugins_loaded', 'sendmail',9999 );



if (isset($_POST['delete_data'])) {
  echo $delid = $_POST['record_id'];
  $objMem->delete_job_table($delid);
  header("Location:admin.php?page=myplug/fhg-job-plugin.php");
}

if (isset($_POST['deleteapp_data'])) {
  echo $delid = $_POST['record_id'];
  $objMem->delete_application_table($delid);
  header("Location:admin.php?page=myplug/fhg-job-plugin.php");
}

if (isset($_POST['cancel'])) {
  header("Location:admin.php?page=myplug/fhg-job-plugin.php");
}

// Frontend apply now form view
function applynow() {
  //wp_register('', '');
  $job = new JobApplication;

  $insert = $job->insertjobdetails();


  if (is_user_logged_in()) {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $jobdetails1 = $job->getjobdetails($id);
    } else {
      $jobdetails1 = '';
    }
     // $job->logout(); 
    $job->displayform($jobdetails1);
  } else {
    echo '<div id="login_form">';
    echo do_shortcode('[login_form]');
    echo '</div>';
    echo '<div id="register_form">';
    echo do_shortcode('[register_form]');
    echo '</div>';
  }
}

add_shortcode('applynow', 'applynow');

function getapplicationstatus() {
  //wp_register('', '');

  $job = new JobApplication;

  //wp_login_form(); 
  if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $username = $current_user->display_name;
    $userapplications = $job->displayuserapp($username);
     $job->logout();
    if (count($userapplications) > 0) {
      $job->displayapps($userapplications);
    }
  } else {
    echo '<div id="login_form">';
    echo do_shortcode('[login_form]');
    echo '</div>';
    echo '<div id="register_form">';
    echo do_shortcode('[register_form]');
    echo '</div>';
  }
}

add_shortcode('applicationstatus', 'getapplicationstatus');

//SHOW JOB DESCRIPTION CONTENT
function show_job_desc() {
  $objMem1 = new jobClass();
  $arrresult = $objMem1->get_career_single();
  $job_id = $arrresult[0]->job_id;
  $job_title = $arrresult[0]->job_title;
  $job_title_ar = $arrresult[0]->job_title_ar;
  $job_location = $arrresult[0]->job_location;
  $job_location_ar = $arrresult[0]->job_location_ar;
  $job_description = $arrresult[0]->job_description;
  $job_description_ar = $arrresult[0]->job_description_ar;
  $url = get_url();

  $display_carrer = '<div class="container">';
  $display_carrer .= '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
  $display_carrer .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent careers cjoblisting">';
  $display_carrer .= '<div class="careersDetailsCont">';
  $display_carrer .= '<div class="careersDetailBox">';
  $display_carrer .= '<div class="topborder">&nbsp;</div>';
  $display_carrer .= '<div class="careersPosition">' . custom_translate($job_title, $job_title_ar) . '</div>';
  $display_carrer .= '<div class="openingLocation">' . custom_translate($job_location, $job_location_ar) . '</div>';
  $display_carrer .= '<span class="'.custom_translate("glyphicon glyphicon-menu-left","glyphicon glyphicon-menu-right").'">';
  $display_carrer .= '<a href="' . $url . custom_translate('careers', 'فرص-العمل') . '">' . custom_translate('Back to Job Listing', 'عودة إلى قائمة الوظائف') . '</a></span>';
  $display_carrer .= '</div>';
  $display_carrer .= '</div>';
  $display_carrer .= '</div>';  
  $display_carrer .= '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
  $display_carrer .= '</div>';
  

  $display_carrer .= '<div class="container">';
  $display_carrer .= '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
  $display_carrer .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-16  careersDetailResponsibilities">';

  $display_carrer .= custom_translate($job_description, stripslashes($job_description_ar));
  
  // $display_carrer .= '<div  name="' . $job_id . '"' . 'id="' . $job_id . '"' . 'class="apply_now text-center"><a href="#" onclick="return false;" id="appnowbtn">' . custom_translate('Apply Now', 'دخول') . '</a></div>';
  $display_carrer .= '</div>';
  $display_carrer .= '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
  $display_carrer .= '</div>';
  echo $display_carrer;

  echo '<div class="container">';
  echo'<div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
  echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 innerpageContent careers">';
  echo do_shortcode('[applynow]');
  echo'</div>';
  echo'<div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
  echo'</div>';
  

}

add_shortcode('show_job_desc_sc', 'show_job_desc');

//SHOW JOB LISTING
function show_job_listing() {
  $objMem2 = new jobClass();
  

  $arrresult = $objMem2->get_career_description();
  if(count($arrresult) > 0){
    ?>
     <div class="careersOpeningCont">
     <h1><?php echo custom_translate('Current openings','الوظائف الشاغرة');?></h1>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
    <?php
    $counter = 0; 
    foreach ($arrresult as $key => $val) {
    $job_id = $val->job_id;
    $job_title = $val->job_title;
    $job_title_ar = $val->job_title_ar;
    $job_location = $val->job_location;
    $job_location_ar = $val->job_location_ar;

      if($counter==0) {?>
     
      
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 careersOpeningleft">

                  <div class="careersOpeningDetail">
            <div class="topborder">&nbsp;</div>
            <div class="careersPosition">
            <?php 
              $url = get_url();             
              echo '<a href="' . $url . custom_translate('careers-description', 'مهن-ويرد-وصف') . '/?id=' . $job_id . '">' . custom_translate($job_title, $job_title_ar) . '</a>';
              ?></div>
            <div class="openingLocation"><?php echo custom_translate($job_location, $job_location_ar); ?> </div>
            <a class="careerArrow" href="#"></a> </div>
                </div>

                <?php $counter= 1; }else if($counter== 1) { ?> 
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 careersOpeningRight">
                  <div class="careersOpeningDetail">
            <div class="topborder">&nbsp;</div>
            <div class="careersPosition">
            <?php 
              $url = get_url();
              echo '<a href="' . $url . custom_translate('careers-description', 'مهن-ويرد-وصف') . '/?id=' . $job_id . '">' . custom_translate($job_title, $job_title_ar) . '</a>';
             ?></div>
            <div class="openingLocation"><?php echo custom_translate($job_location, $job_location_ar); ?></div>
            <a class="careerArrow" href="#"></a></div>
                </div>
                
  
    <?php 
$counter= 0;
        }
    }?>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
            </div> 
  <?php }
}
add_shortcode('show_job_listing_sc', 'show_job_listing');
?>