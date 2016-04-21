<?php
require_once(JS_INCLUDES_ADMIN_CLASS_DIR . DS . 'jobclass.php');
$objMem = new jobClass();
$addme = $_POST["addme"];
$act = $_REQUEST["act"];
$recid = "";
$header = "Add New Job";
if ($act == "upd") {
  $recid = $_REQUEST["job_id"];
  $arrresult = $objMem->select_job_table($recid);
print_r($arrresult);
  if (count($arrresult) > 0) {
    $header = "Edit Job";
    $job_title = $arrresult['job_title'];
    $job_title_ar = $arrresult['job_title_ar'];
    $job_phone_no = $arrresult['job_phone_no'];
    $job_location = $arrresult['job_location'];
    $job_location_ar = $arrresult['job_location_ar'];
    $job_description = $arrresult['job_description'];
    $job_description_ar = $arrresult['job_description_ar'];
    $job_display_to_date = $arrresult['job_display_to_date'];
    $job_hr_email = $arrresult['job_hr_email'];
    $imageurl = $arrresult['imageurl'];
    if ($job_display_to_date != "0000-00-00") {
      $job_display_to_date = str_replace('-', '/', $job_display_to_date);
      $job_display_to_date = date('m-d-Y', strtotime($job_display_to_date));
    } else {
      $job_display_to_date = "";
    }
    $file = $val->file;
    $website_id = $arrresult['website_id'];
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
  $job_hr_email = '';
  $hidval = 1;
}
$job_id = $_GET['job_id'];
?> 

<style>
  .error{
    color:red;
  }
</style>
<div  class="wrap nosubsub">

  <div class="wrap">
    <?php screen_icon('plugins'); ?>
    <h2 ><?php echo $header; ?></h2><form class="validate" action="admin.php?page=job_add" method="post" enctype="multipart/form-data" id="addtag">
      <br/>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><label>Job Title English:</label><span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="job_title" id="job_title" value="<?php echo $job_title; ?>" size="45" class="required" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Job Title Arabic:</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="job_title_ar" id="job_title_ar" value="<?php echo $job_title_ar; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Job Location English:</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="job_location" id="job_location" value="<?php echo $job_location; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Job Location Arabic:</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="job_location_ar" id="job_location_ar" value="<?php echo $job_location_ar; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Job Description English</label></th>
          <td>
            <?php
            $args = array("textarea_rows" => 5, 'media_buttons' => true,
                "textarea_name" => "job_description", "editor_class" => "my_editor_custom", 'tinymce' => array(
                    'theme_advanced_disable' => 'charmap,wp_help,blockquote,wp_more,pastetext,pasteword,bullist'
            ));
            wp_editor($job_description, "my_editor_1", $args);
            ?>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Job Description Arabic</label></th>
          <td>
            <?php
            $args = array("textarea_rows" => 5, 'media_buttons' => true, 'quicktags' => true,
                "textarea_name" => "job_description_ar", "editor_class" => "my_editor_custom", 'tinymce' => array(
                    'theme_advanced_disable' => 'charmap,wp_help,blockquote,wp_more,pastetext,pasteword,bullist'
            ));
            wp_editor($job_description_ar, "my_editor_2", $args);
            ?>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>Add Image</label></th>
          <td>
            <input type="file" class="required" name="image_url" id="image_url" value="<?php echo $imageurl; ?>"/>
            <p>Uploaded Image: <img src="<?php echo plugins_url().'/fhg-job/includes/uploads/'.$imageurl?>" alt="careers"></p>
        </td>
        </tr>
        <tr valign="top">
          <th scope="row"><label >Display Till Date:</label></th><td><input type="text" name="job_display_to_date" id="job_display_to_date" readonly="true" autocomplete="off" value="<?php echo $job_display_to_date; ?>" size="45" /><br/><br/></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label>HR Email:</label> <span class="error">*</span></th>
          <td>
            <input type="text" maxlength="100" class="required" name="job_hr_email" id="job_hr_email" value="<?php echo $job_hr_email; ?>" size="45" />
          </td>
        </tr>
        <tr valign="top">
          <td>
            <input type="submit" class="button-secondary" value="<?php echo $btn; ?>" class="button" id="add_jobs_submit" name="submit"/>
            <input type="submit" class="button-secondary" name="cancel" id="cancel" value="Cancel" />
            <?php
            if ($act == "upd") {
              ?>
              <input type="submit" class="button-secondary" name="delete_data" id="delet" value="Delete" onclick="return confirm('Are you sure you want to delete?');" />
              <?php
            }
            ?>
            <?php
            if ($act != "upd") {
              ?>
              <input type="reset" class="button-secondary" value="Reset" class="button" id="reset_jobs" name="reset"/>
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