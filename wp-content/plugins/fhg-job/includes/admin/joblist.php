<?php
include(JS_INCLUDES_ADMIN_CLASS_DIR . DS . 'paginations.class.php');
$objMem = new jobClass();
$objMem->fetch_joblist_data();
?>

<div class="wrap">
  <h2>Jobs List</h2>
  <table class="widefat" class="form-table" id="joblist" cellspacing="0"><thead><tr><tr>

        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Job Title</strong>
        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Location</strong>
        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Display Till Date</strong>
        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Action</strong>

      </tr></tr>
    </thead><tbody>
      <?php
      $limit = LIMIT;
      $obj_pagination = new pagination_job();
      $page_no = $_REQUEST['pg_no'];
      $arrresult = $objMem->joblist_query();
      $pages = $obj_pagination->calculate_pages(count($arrresult), $limit, $page_no);
      $limit_text = $obj_pagination->get_limit_text($pages);
      $arrresult = $objMem->joblist_query($limit_text);
      if (count($arrresult) > 0) {
        ?>
        <?php
        foreach ($arrresult as $key => $val) {
          $job_id = $val->job_id;
          $job_title = $val->job_title;
          $job_location = $val->job_location;
          $job_display_to_date = $val->job_display_to_date;
          if ($job_display_to_date != "0000-00-00") {
            $job_display_to_date = str_replace('-', '/', $job_display_to_date);
            $job_display_to_date = date('m-d-Y', strtotime($job_display_to_date));
          } else {
            $job_display_to_date = "-";
          }
          ?>
          <tr class='alternate' valign='top'>
            <td class='column-columnname'>
              <?php echo wordwrap(stripslashes($job_title), 40, "<br>\n", true); ?>
            </td>
            <td class='column-columnname'>
              <?php echo $job_location; ?>
            </td>
            <td class='column-columnname'>
              <?php echo $job_display_to_date; ?>
            </td>
            <td><a href="admin.php?page=job_add&act=upd&job_id=<?php echo $job_id; ?>">Edit</a>&nbsp;&nbsp;<a href="admin.php?page=myplug/fhg-job-plugin.php&info=del&did=<?php echo $job_id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
          </tr>
          <?php
        }
        $pagi = '';
        $page_links = $obj_pagination->page_links;
        if ($page_links) {
          $pagi .= "<div class='page_count'><ul>";
          $pg_no_prev = $obj_pagination->pg_no_prev;
          $pg_no_next = $obj_pagination->pg_no_next;
          $pagi.='<li><a href="' . $pg_no_prev . '"  class="pre">Previous</a></li>';
          $pagi.=$page_links;
          $pagi.='<li><a class="nxt" href="' . $pg_no_next . '">Next</a></li>';
          $pagi .= "</ul></div>";
        }
        echo $pagi;
      } else {
        ?>
        <tr>
          <td>No Record Found!</td>
        <tr>
        <?php } ?>
    </tbody>
    <tfoot>
    <br/>
    </tfoot>
  </table>
</div>