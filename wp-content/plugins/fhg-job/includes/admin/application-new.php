<?php
require_once(JS_INCLUDES_ADMIN_CLASS_DIR . DS . 'applicationclass.php');
$objMem = new applicationClass();

// if(isset($_POST['application'])){
//   echo "asdasdasd";
// }
$addme = $_POST["addme"];
$act = $_REQUEST["act"];
$recid = "";
$header = "Add New Job";
if ($act == "upd") {
  $recid = $_REQUEST["application_id"];
  $arrresult = $objMem->select_application_table($recid);
  if (count($arrresult) > 0) {
    $header = "Edit Application";
    $application_title = $arrresult['application_title'];
    $application_firstname = $arrresult['application_firstname'];
    $application_lastname = $arrresult['application_lastname'];
    $application_email = $arrresult['application_email'];
    $application_mobileno = $arrresult['application_mobileno'];
    $application_education = $arrresult['application_education'];
    $application_experience = $arrresult['application_experience'];
    $application_source = $arrresult['application_source'];
    $application_linkedinurl = $arrresult['application_linkedinurl'];
    $application_c_letter = $arrresult['application_c_letter'];
    $application_resume_filename = $arrresult['application_resume_filename'];
    $application_status = $arrresult['application_status'];
    
    $file = $val->file;
    $job_id = $arrresult['job_id'];
    $btn = "Update";
    $hidval = 2;
  }
} else {
  $btn = "Add";
  $job_id = "";
  $job_title = "";
  $job_title_ar = "";
  $job_phone_no = "";
  $job_location = "";
  $job_location_ar = "";
  $job_description = "";
  $job_description_ar = "";
  $job_display_to_date = "";
  $hidval = 1;
}
$application_id = $_GET['application_id'];
?> 

<style>
  .error{
    color:red;
  }
</style>
<div  class="wrap nosubsub">

  <div class="wrap">
<?php screen_icon('plugins'); ?>
    <h2 ><?php echo $header; ?></h2><form class="validate" action="admin.php?page=application_add" method="post" enctype="multipart/form-data" id="addapptag">
      <br/>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label>Title :</label><span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_title" id="application_title" value="<?php echo $application_title; ?>" size="45" class="required" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>First Name :</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_firstname" id="application_firstname" value="<?php echo $application_firstname; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Last Name :</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_lastname" id="application_lastname" value="<?php echo $application_lastname; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Email :</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_email" id="application_email" value="<?php echo $application_email; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Mobile Number :</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_mobileno" id="application_mobileno" value="<?php echo $application_mobileno; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Education :</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_education" id="application_education" value="<?php echo $application_education; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Experience :</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_experience" id="application_experience" value="<?php echo $application_experience; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Source :</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_source" id="application_source" value="<?php echo $application_source; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>LinkedinUrl :</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_linkedinurl" id="application_linkedinurl" value="<?php echo $application_linkedinurl; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Cover Letter </label></th>
          <td>
<?php
$args = array("textarea_rows" => 5, 'media_buttons' => true,
    "textarea_name" => "application_c_letter", "editor_class" => "my_editor_custom", 'tinymce' => array(
        'theme_advanced_disable' => 'charmap,wp_help,blockquote,wp_more,pastetext,pasteword,bullist'
        ));
wp_editor($application_c_letter, "my_editor_1", $args);
?>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Resume Filename:</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="application_resume_filename" id="application_resume_filename" value="<?php echo $application_resume_filename; ?>" size="45" readonly="readonly" />
            <a href="<?php echo DOCUMENT_UPLOADS_URL . DS . $application_resume_filename; ?>" target="_blank" >Download File</a>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Status :</label> <span class="error">*</span></th>
          <td>
            <select name="application_status" id="application_status" value="" class="form-control btn btn-default dropdown-toggle">                
              <option value="New" <?php if($application_status == 'New'){echo 'selected="selected"';} ?>>New</option>
              <option value ="Selected" <?php if($application_status == 'Selected'){echo 'selected="selected"';} ?>>Selected</option>
              <option value ="Rejected" <?php if($application_status == 'Rejected'){echo 'selected="selected"';} ?>>Rejected</option>
              <option value ="On Hold" <?php if($application_status == 'On Hold'){echo 'selected="selected"';} ?>>On Hold</option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Send Status Mail :</label> <span class="error">*</span></th>
          <td>
            <div class="checkbox">
              <label><input type="checkbox" name="statusmail" id="statusmail" value="statusmail" checked></label>
            </div>
          </td>
        </tr>



        <tr valign="top">
          <td>
            <input type="submit" class="button-secondary" value="<?php echo $btn; ?>" class="button" id="add_applications_submit" name="application"/>
            <input type="submit" class="button-secondary" name="cancel" id="cancel" value="Cancel" />
<?php
if ($act == "upd") {
  ?>
              <input type="submit" class="button-secondary" name="deleteapp_data" id="deletapp" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
              <?php
            }
            ?>
            <?php
            if ($act != "upd") {
              ?>
              <input type="reset" class="button-secondary" value="Reset" class="button" id="reset_application" name="reset"/>
              <?php
            }
            ?>
            <input type="hidden" name="addme" value=<?php echo $hidval; ?> />
            <input type="hidden" name="website_id" value="<?php echo $website_id = WEBSITE_ID; ?>"/>
            <input type="hidden" name="id" value=<?php echo $job_id; ?> />
            <input type="hidden" name="record_id" value=<?php echo $recid; ?> />
            <input type="hidden" maxlength="200" name="file_value" value="<?php echo $file; ?>" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>