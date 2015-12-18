<?php

class jobClass {

  //Function for Job Add
  function addNewJob($table_name, $meminfo) {
    global $wpdb;
    $count = sizeof($meminfo);
    if ($count > 0) {
      $job_id = 0;
      $job_title = $meminfo['job_title'];
      $job_title_ar = $meminfo['job_title_ar'];
      $job_phone_no = $meminfo['job_phone_no'];
      $job_location = $meminfo['job_location'];
      $job_location_ar = $meminfo['job_location_ar'];
      $job_description = $meminfo['job_description'];
      $job_description_ar = $meminfo['job_description_ar'];
      $job_display_to_date = $meminfo['job_display_to_date'];
      $job_hr_email = $meminfo['job_hr_email'];
      if ($job_display_to_date) {
        $job_display_to_date = str_replace('-', '/', $job_display_to_date);
        $job_display_to_date = date('Y-m-d', strtotime($job_display_to_date));
      }
      $sql = "  INSERT INTO " . JS_TABLENAME . "
                            (
                                `job_title`,`job_title_ar`,`job_phone_no`,
                                `job_location`,`job_location_ar`,`job_description`,
                                `job_description_ar`, `job_display_to_date`, `job_hr_email`
                            )
                            VALUES
                            (
                                '$job_title','$job_title_ar','$job_phone_no',
                                '$job_location','$job_location_ar','$job_description',
                                '$job_description_ar','$job_display_to_date', '$job_hr_email'
                            ) ";

      $wpdb->query($sql);

      return true;
    } else {
      return false;
    }
  }

  //Function for Job Update
  function updJob($table_name, $meminfo) {
    global $wpdb;

    $recid = $_POST['record_id'];
    $count = sizeof($meminfo);

    if ($count > 0) {
      $meminfo['file'] = $file_name;
      $job_title = $meminfo['job_title'];
      $job_title_ar = $meminfo['job_title_ar'];
      $job_phone_no = $meminfo['job_phone_no'];
      $job_location = $meminfo['job_location'];
      $job_location_ar = $meminfo['job_location_ar'];
      $job_description = $meminfo['job_description'];
      $job_description_ar = $meminfo['job_description_ar'];
      $job_display_to_date = $meminfo['job_display_to_date'];
      $job_hr_email = $meminfo['job_hr_email'];
      if ($job_display_to_date) {
        $job_display_to_date = str_replace('-', '/', $job_display_to_date);
        $job_display_to_date = date('Y-m-d', strtotime($job_display_to_date));
      }
      $sql = "   UPDATE
                            " . JS_TABLENAME . "
                        SET
                            `job_title`='$job_title',`job_title_ar`='$job_title_ar',`job_phone_no`='$job_phone_no',
                            `job_location`='$job_location',`job_location_ar`='$job_location_ar', `job_description`='$job_description',
                            `job_description_ar`='$job_description_ar', `job_display_to_date`='$job_display_to_date', `job_hr_email` = '$job_hr_email'
                        WHERE
                            `job_id`='$recid'";

      $wpdb->query($sql);
      return true;
    } else {
      return false;
    }
  }

  function fetch_joblist_data() {

    global $wpdb;
    $obj_pagination = new pagination_job();
    $info = $_REQUEST["info"];

    if ($info == "saved") {
      echo "<div class='updated' id='message'><p><strong>Job Added</strong>.</p></div>";
    }

    if ($info == "upd") {
      echo "<div class='updated' id='message'><p><strong>Job Record Updated</strong>.</p></div>";
    }

    if ($info == "del") {
      $delid = $_GET["did"];
      $sql = "DELETE FROM   " . JS_TABLENAME . " WHERE `job_id`=$delid";
      $wpdb->query($sql);
      echo "<div class='updated' id='message'><p><strong>Job Record Deleted.</strong>.</p></div>";
    }
  }

  function joblist_query($limit = null) {
    global $wpdb;

    $sql = "select * from " . JS_TABLENAME . " order by job_id desc";
    if ($limit) {
      $sql .= " $limit";
    }
    $result = $wpdb->get_results($sql);
    return $result;
  }

  function delete_attachments($recid) {
    global $wpdb;
    $delete_attachment = "update " . JS_TABLENAME . " set file='' where job_id=$recid";
    $wpdb->query($delete_attachment);
  }

  function select_job_table($recid) {
    global $wpdb;
    $sql = "select * from " . JS_TABLENAME . " where job_id =$recid";
    $arrresult = $wpdb->get_row($sql, ARRAY_A);
    return $arrresult;
  }

  function delete_job_table($delid) {
    global $wpdb;
    echo $delete_data = "delete from " . JS_TABLENAME . " where job_id=$delid";
    $wpdb->query($delete_data);
  }

  function get_career_single() {
    global $wpdb;
    if (isset($_REQUEST['id'])) {
      $get_job_id = $_REQUEST['id'];
    }
    $date = date('Y' . '-' . 'm' . '-' . 'd');
    $sql = "select * from " . JS_TABLENAME . " WHERE job_id = " . $get_job_id;
    $arrresult = $wpdb->get_results($sql);
    return $arrresult;
  }

  function get_career_description() {
    global $wpdb;
    $date = date('Y' . '-' . 'm' . '-' . 'd');
    $sql = "select * from " . JS_TABLENAME . " WHERE job_display_to_date >= " . $date . " OR job_display_to_date = 0000-00-00";
    $arrresult = $wpdb->get_results($sql);
    return $arrresult;
  }

}

?>