<?php

//add_action( 'plugins_loaded', 'updApplication_sendmail', 9999 );
// $objApp->sendmail($_POST);
class applicationClass {

  //Function for Job Update
  function updApplication_sendmail($table_name, $meminfo) {
    global $wpdb;

    $recid = $_POST['record_id'];
    $count = sizeof($meminfo);
    //print_r($meminfo);die;

    if ($count > 0) {
      $application_title = sanitize_text_field($meminfo['application_title']);
      $application_firstname = sanitize_text_field($meminfo['application_firstname']);
      $application_lastname = sanitize_text_field($meminfo['application_lastname']);
      $application_email = sanitize_text_field($meminfo['application_email']);
      $application_mobileno = sanitize_text_field($meminfo['application_mobileno']);
      $application_education = sanitize_text_field($meminfo['application_education']);
      $application_experience = sanitize_text_field($meminfo['application_experience']);
      $application_source = sanitize_text_field($meminfo['application_source']);
      $application_linkedinurl = sanitize_text_field($meminfo['application_linkedinurl']);
      $application_c_letter = sanitize_text_field($meminfo['application_c_letter']);
      $application_resume_filename = sanitize_text_field($meminfo['application_resume_filename']);
      $application_status = sanitize_text_field($meminfo['application_status']);
      $statusmail = sanitize_text_field($meminfo['statusmail']);

      $sql = "   UPDATE
                            " . APP_TABLENAME . "
                        SET
                            `application_title`='$application_title',
                            `application_firstname`='$application_firstname',
                            `application_lastname`='$application_lastname',
                            `application_email`='$application_email',
                            `application_mobileno`='$application_mobileno', 
                            `application_education`='$application_education',
                            `application_experience`='$application_experience', 
                            `application_source`='$application_source',
                            `application_linkedinurl`='$application_linkedinurl',
                            `application_c_letter`='$application_c_letter',
                            `application_resume_filename`='$application_resume_filename',
                            `application_status`='$application_status'
                        WHERE
                            `applicationid`='$recid'";
      //echo $sql;

      $wpdb->query($sql);

      return true;
    } else {
      return false;
    }
  }

  function fetch_applicationlist_data() {

    global $wpdb;
    $obj_pagination = new pagination_job();
    $info = $_REQUEST["info"];

    if ($info == "saved") {
      echo "<div class='updated' id='message'><p><strong>Application Added</strong>.</p></div>";
    }

    if ($info == "upd") {
      echo "<div class='updated' id='message'><p><strong>Application Record Updated</strong>.</p></div>";
    }

    if ($info == "del") {
      $delid = $_GET["did"];
      $sql = "DELETE FROM   " . APP_TABLENAME . " WHERE `applicationid`=$delid";
      $wpdb->query($sql);
      echo "<div class='updated' id='message'><p><strong>Application Record Deleted.</strong>.</p></div>";
    }
  }

  function applicationlist_query($limit = null) {
    global $wpdb;

    $sql = "select * from " . APP_TABLENAME . " order by applicationid desc";
    if ($limit) {
      $sql .= " $limit";
    }


    $result = $wpdb->get_results($wpdb->prepare($sql));


    return $result;
  }

  function select_application_table($recid) {
    global $wpdb;
    $sql = "select * from " . APP_TABLENAME . " where applicationid =$recid";
    $arrresult = $wpdb->get_row($sql, ARRAY_A);
    return $arrresult;
  }

  function select_settings_table($recid) {
    global $wpdb;
    $sql = "select * from " . SETTINGS_TABLENAME;
    $arrresult = $wpdb->get_row($sql, ARRAY_A);
    return $arrresult;
  }

  function delete_application_table($delid) {
    global $wpdb;
    $delete_data = "delete from " . APP_TABLENAME . " where applicationid=$delid";
    $wpdb->query($delete_data);
  }

  function update_settings_table($data){
    global $wpdb;
    $hr_email_address = $data['hr_email'];
    $hr_id = $data['hr_id'];

     $sql = "UPDATE " . SETTINGS_TABLENAME . " SET `hr_email`='$hr_email_address' WHERE  `id`='$hr_id'";
     $insert = $wpdb->query($sql);
     if($insert){
      return true;
    }
  }

}

?>