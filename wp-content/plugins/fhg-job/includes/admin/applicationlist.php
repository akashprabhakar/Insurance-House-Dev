<?php
include(JS_INCLUDES_ADMIN_CLASS_DIR . DS . 'paginations.class.php');
$objMem = new applicationClass();
$objMem->fetch_applicationlist_data();
?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('#joblist').DataTable({
      columnDefs: [{
          targets: [0],
          orderData: [0, 1]
        }, {
          targets: [1],
          orderData: [1, 0]
        }, {
          targets: [4],
          orderData: [4, 0]
        }]
    });
  });
</script>
<div class="wrap">
  <h2>Applications List</h2>
  <table class="widefat" class="form-table" id="joblist" cellspacing="0"><thead><tr><tr>

        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Application Title</strong>
        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Name</strong>
        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Education</strong>
        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Resume</strong>
        <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Action</strong>

      </tr></tr>
    </thead><tbody>
<?php
$limit = LIMIT;
$obj_pagination = new pagination_job();
$page_no = $_REQUEST['pg_no'];
$arrresult = $objMem->applicationlist_query();
$pages = $obj_pagination->calculate_pages(count($arrresult), $limit, $page_no);
$limit_text = $obj_pagination->get_limit_text($pages);
$arrresult = $objMem->applicationlist_query($limit_text);
if (count($arrresult) > 0) {
  ?>
        <?php
        foreach ($arrresult as $key => $val) {
          $application_id = $val->applicationid;
          $application_title = $val->application_title;
          $application_firstname = $val->application_firstname;
          $application_lastname = $val->application_lastname;
          $application_name = $application_firstname . ' ' . $application_lastname;
          $application_education = $val->application_education;
          $application_resume_filename = $val->application_resume_filename;
          ?>
          <tr class='alternate' valign='top'>
            <td class='column-columnname'>
          <?php echo wordwrap(stripslashes($application_title), 40, "<br>\n", true); ?>
            </td>
            <td class='column-columnname'>
              <?php echo $application_name; ?>
            </td>
            <td class='column-columnname'>
              <?php echo $application_education; ?>
            </td>
            <td class='column-columnname'><a href="<?php echo DOCUMENT_UPLOADS_URL . DS . $application_resume_filename; ?>" >
              <?php echo $application_resume_filename; ?></a>
            </td>
            <td><a href="admin.php?page=application_add&act=upd&application_id=<?php echo $application_id; ?>">Edit</a>&nbsp;&nbsp;<a href="admin.php?page=myplug/fhg-application-plugin.php&info=del&did=<?php echo $application_id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
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