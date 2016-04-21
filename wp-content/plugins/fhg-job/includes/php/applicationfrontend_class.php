<?php

require_once(JS_INCLUDES_ADMIN_CLASS_DIR . DS . 'applicationclass.php');


class JobApplication {

  public function insertjobdetails() {
    if (isset($_POST['apply']) && !empty($_POST['apply'])) {
      $objMem = new applicationClass();
      $data = array();
      $errors = array();
      $title = sanitize_text_field($_POST['title']);
      $firstname = sanitize_text_field($_POST['firstname']);
      $lastname = sanitize_text_field($_POST['lastname']);
      $email = sanitize_text_field($_POST['email']);
      $mobileno = sanitize_text_field($_POST['mobileno']);
      $education = sanitize_text_field($_POST['education']);
      $experience = sanitize_text_field($_POST['experience']);
      $source = sanitize_text_field($_POST['source']);
      $linkedinurl = sanitize_text_field($_POST['linkedinurl']);
      $c_letter = sanitize_text_field($_POST['c_letter']);

      $job_id = sanitize_text_field($_POST['job_id']);
      $username = sanitize_text_field($_POST['username']);


      if (isset($_FILES["resume_filename"]["type"])) {

        $validextensions = array("pdf", "doc", "docx");
        $temporary = explode(".", $_FILES["resume_filename"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["resume_filename"]["type"] == "application/pdf") || ($_FILES["resume_filename"]["type"] == "application/msword") || ($_FILES["resume_filename"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")) && ($_FILES["resume_filename"]["size"] < 10000000000000000) && in_array($file_extension, $validextensions)) {
          if ($_FILES["resume_filename"]["error"] > 0) {
            echo "Return Code: " . $_FILES["resume_filename"]["error"] . "<br/><br/>";
          } else {
            // if (file_exists( DOCUMENT_UPLOADS.DS . $_FILES["resume_filename"]["name"])) {
            //  echo $_FILES["resume_filename"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
            // }

            $sourcePath = $_FILES['resume_filename']['tmp_name'];
            $targetPath = DOCUMENT_UPLOADS . DS . $_FILES["resume_filename"]["name"];
            // echo $targetPath;
            // echo $sourcePath;// Target path where file is to be stored
            if (move_uploaded_file($sourcePath, $targetPath)) { // Moving Uploaded file
              $resume_filename = $_FILES["resume_filename"]["name"];
            } else {
              echo "<h1>File could not be uploaded .Check File Permissions</h1>";
            }
          }
        } else {
          echo "<span id='invalid'>***Please upload pdf and doc files only.***<span>";
        }
      }

      if (isset($resume_filename) && !empty($resume_filename)) {

        global $wpdb;
        $reg_table_name = APP_TABLENAME;

        $insertdata = $wpdb->insert(
                $reg_table_name, //table
                array('application_title' => $title, 'username' => $username, 'application_firstname' => $firstname, 'application_lastname' => $lastname, 'application_email' => $email, 'application_mobileno' => $mobileno, 'application_education' => $education, 'application_experience' => $experience, 'application_source' => $source, 'application_linkedinurl' => $linkedinurl, 'application_c_letter' => $c_letter, 'application_resume_filename' => $resume_filename, 'job_id' => $job_id), //data
                array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d') //data format      
        );
      }

      if ($insertdata) {

        $message = "<p>Dear HR,</p>";
        if(isset($_GET['id'])){
          $message .= "<p>We have recieved an job application for the " . $title . " position. Mentioned below are the details regarding the application.</p>";
          $message .= "<p>Job Title :" . $title . "</p>";
        }else{
          $message .= "<p>We have recieved an job application. Mentioned below are the details regarding the application.</p>";
        }
        $message .= "<p>First Name :" . $firstname . "</p>";
        $message .= "<p>Last Name :" . $lastname . "</p>";
        $message .= "<p>Email :" . $email . "</p>";
        $message .= "<p>Mobile no :" . $mobileno . "</p>";
        $message .= "<p>Education :" . $education . "</p>";
        $message .= "<p>Experience :" . $experience . "</p>";
        $message .= "<p>Linkedin Url :" . $linkedinurl . "</p>";
        $message .= "<p>Cover Letter :" . $c_letter . "</p>";
        $message .= "<p>CAPM</p>";

        //echo $message;
        //echo $job_id;
        if(isset($_GET['id'])){
        $jobdetails = $this->getjobdetails($job_id);
        $hrmail = $jobdetails[0];
        $hremail = $hrmail->job_hr_email;
        }else{
          $get_settings = $objMem->select_settings_table(); 
          $hremail = $get_settings['hr_email'];
        }
        // print_r($jobdetails);
        $attachments = array(DOCUMENT_UPLOADS . DS . $resume_filename);

        $headers = 'Content-type: text/html;charset=utf-8' . "\r\n";
        $headers .= 'From: Admin <admin@dispostable.com>' . "\r\n";
        $subject = 'CAPM Job Application Details';
        $mailconfirm = wp_mail($hremail, $subject, $message, $headers, $attachments);

        if ($mailconfirm) {
           
          
          // //echo $this->application_success_msg();
          // // echo '<div class="container">';
          // // echo '<p>Track your application status <a href="' . SITE_URL. DS . 'careers" >here</a></p></div>';
         
          echo '<script type="text/javascript">';
          echo "console.log('mail sent');";
          echo "$('.hidecontent').hide();$('.showcontent').show();";
          echo "</script>";
          // echo "Asdasd";
        }
      }
    } //end of if statement
  }

  

// end of function insertjobdetails()

  public function displayform($jobdetails1) {

    $singlejob = $jobdetails1[0];
    $job_title = $singlejob->job_title;
    $job_title_ar = $singlejob->job_title_ar;
    $jobtitle = custom_translate($job_title, $job_title_ar);
    $current_user = wp_get_current_user();
    $username = $current_user->display_name;
    $jbid = $singlejob->job_id;
    ?>
	  <!--Remove Apply Now Button -->

	  <!--Remove Apply Now Button -->
    <div id="applyformid">
    <p class="widFull"><?php echo custom_translate('Successful submission of your Registration Form requires completion of all boxes marked with an asterisk (*).', 'لإتمام نجاح عملية تقديم "استمارة التسجيل"، يرجى تعبئة كافة البيانات الضرورية المطلوبة (*) '); ?></p>
    <div class="error_box"></div>
      <form method="POST" action="#" enctype="multipart/form-data" name="sendresume" id="careersvalform">
       
          

  
    <?php if (isset($_GET['id'])) { ?>
          
           
             <p> <input type="text" placeholder="<?php echo custom_translate('Title', 'عنوان'); ?>*" id="title" name="title" value="<?php echo $jobtitle; ?>" class="form-control" readonly="readonly"  >
          </p>
          
        
    <?php } ?>
       
       
            <p><input type="text" placeholder="<?php echo custom_translate('First Name', 'الاسم الأول'); ?>*" id="firstname" name="firstname" data-rule-required="true" data-msg-required="<?php echo custom_translate('Please fill in the required field.','يرجى ملء في الميدان المطلوبة.'); ?>" class="form-control">
            <small class="errorText">    </small></p>
           <!--  //<span id="name-format" class="help">Format: firstname </span> -->
    
          
           <p> <input type="text" placeholder="<?php echo custom_translate('Last Name', 'اسم العائلة'); ?>*" id="lastname" name="lastname" data-rule-required="true" data-msg-required="<?php echo custom_translate('Please fill in the required field.','يرجى ملء في الميدان المطلوبة.'); ?>" class="form-control mrgleft_25" >
                        <small class="errorText"></small></p>
       
     

      
            <p><input type="email" placeholder="<?php echo custom_translate('Email', 'البريد الإلكتروني'); ?>*" id="email" name="email" data-rule-required="true" data-rule-email="true" data-msg-required="<?php echo custom_translate('Please fill in the required field.','يرجى ملء في الميدان المطلوبة.'); ?>" data-msg-email="<?php echo custom_translate('Please enter a valid email address','رجاء قم بإدخال بريد الكتروني صحيح'); ?>" class="form-control" ></p>
          
        
            <p><input type="tel" placeholder="<?php echo custom_translate('Mobile', 'الهاتف المتحرك'); ?>*" id="mobileno" name="mobileno" data-rule-required="true" data-msg-required="<?php echo custom_translate('Please fill in the required field.','يرجى ملء في الميدان المطلوبة.'); ?>" class="form-control mrgleft_25" data-rule-maxlength="true" data-msg-maxlength="<?php echo custom_translate('Please enter no more than 10 characterss','الرجاء إدخال ما لا يزيد عن 10 حرفا'); ?>"></p>
          
      
            <p><input type="text" placeholder="<?php echo custom_translate('Education', 'تعليم'); ?>*" id="education"  name="education" class="form-control" data-rule-required="true" data-msg-required="<?php echo custom_translate('Please fill in the required field.','يرجى ملء في الميدان المطلوبة.'); ?>"></p>
        
         
            <p><input type="tel" placeholder="<?php echo custom_translate('Years of Experience', 'عدد سنوات الخبرة'); ?>*" id="experience" name="experience" data-rule-required="true" data-msg-required="<?php echo custom_translate('Please fill in the required field.','يرجى ملء في الميدان المطلوبة.'); ?>" class="form-control mrgleft_25" data-rule-maxlength="true" data-msg-maxlength="<?php echo custom_translate('Please enter no more than 2 characterss','الرجاء إدخال ما لا يزيد عن 2 حرفا'); ?>"></p>
     
     
           <p> <input type="text" placeholder="<?php echo custom_translate('Where did you hear about this position?', 'كيف علمت بهذه الوظيفة'); ?>" id="source" name="source" class="form-control "></p>
        

         
            <p><input type="url" placeholder="<?php echo custom_translate('LinkedIn Profile Url', 'رابط صفحتكم الشخصية عبر لينكدإن'); ?>" id="linkedinurl" name="linkedinurl" class="form-control mrgleft_25" data-rule-url="true" data-msg-url="<?php echo custom_translate('Please enter a valid url','الرجاء إدخال رابط صحيح'); ?>"></p>
     

      
          <textarea placeholder="<?php echo custom_translate('Cover Letter', 'غطاء الرسالة'); ?>" id="c_letter" name="c_letter" rows="3" class="form-control"></textarea>
     

      
          <!-- <p>Please <a href="#" data-toggle="modal" data-target="#myModal" onclick="return false;" id="legaldis" >click here</a> to read and accept the disclaimer before uploading your CV/Resume. -->
          <!-- <input type="Upload Resume (pdf, doc)" placeholder="Upload Resume (pdf, doc) *" id="exampleInputEmail1" class="form-control1"> 
          <input type="file" value"Choose File" id="resume_filename" name="resume_filename" class="btn btn-warning dropdown-toggle">  -->
          <div class="uploadclass">
            <input id="uploadFile" class="form-control1" placeholder="<?php echo custom_translate('Upload Resume (pdf, doc)', 'يرجى تحميل السيرة الذاتية الخاصة بك(pdf, doc)'); ?>*"/>
            <div class="uploadbtn">
              <input type="file" name="resume_filename" class="btn btn-warning" id="resume_filename">
              <div class="submitbtnContainer1">
                <input class="btn btn-warning SubmitButton1 oneregibtn1" id="filebtn" type="button" value="<?php echo custom_translate('Choose File', 'اختر الملف'); ?>">
              </div>
            </div>
          </div>

   


        <div class="careersApplyBtnSection">
          <!-- Modal Section -->
<!--           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Legal Disclaimer</h4>
                </div>
                <div class="modal-body">
                  <p><?php echo apply_filters('the_content', get_post_field('post_content', custom_translate(253, 464))); ?>
                  <div class="checkbox"><label><input type="checkbox" id="checklegal"> Click here to accept our terms and conditions.</label></div>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Done</button>
                </div>
              </div>
            </div>
          </div> -->
          <!-- Modal Section End -->
          <input type="hidden" name="job_id" value="<?php echo $jbid ?>">
          <input type="hidden" name="username" value="<?php echo $username ?>">
          <input type="submit" name="apply" value="<?php echo custom_translate('Submit', 'عرض'); ?>" id="submit_form" class="btn btn-warning dropdown-toggle">
        </div>
      </form>
    </div>
   

  <?php
  }


  function getjobdetails($jobid) {

    global $wpdb;
    $sql = "SELECT * FROM " . JS_TABLENAME . " WHERE job_id = $jobid";
    $result = $wpdb->get_results($sql);
    return $result;
  }

//end of class  

  function displayuserapp($username) {
    global $wpdb;
    $sql = "SELECT * FROM " . APP_TABLENAME . " WHERE username = '$username'";
    $result = $wpdb->get_results($sql);

    return $result;
  }

  function logout() {
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') ===
            FALSE ? 'http' : 'https';            // Get protocol HTTP/HTTPS
    $host = $_SERVER['HTTP_HOST'];   // Get  www.domain.com
    $script = $_SERVER['REQUEST_URI'];
    // Get folder/file.php
    if (!empty($_SERVER['QUERY_STRING'])) {
      $params = '?' . $_SERVER['QUERY_STRING']; // Get Parameters occupation=odesk&name=ashik
    } else {
      $params = '';
    }
    $currentUrl = custom_translate(SITE_URL, str_replace('/capm_production', '', SITE_URL)) . $script . $params; // Adding all
    echo '<a class="logoutlink" href="' . wp_logout_url($currentUrl) . '">' . custom_translate('Logout', 'تسجيل خروج') . '</a>';
  }

  function displayapps($applications) {
    ?>
    <div class="careersApplyFormCont">
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 mrgbtm_20">
        <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formLeftCont">
          <p class="heading"><?php echo custom_translate('Job Title', 'المسمى الوظيفي'); ?></p>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formRightCont">
          <p class="heading"><?php echo custom_translate('Application Status', 'حالة الطلب'); ?></p>
        </div>
      </div>
    <?php
    foreach ($applications as $application) {
      if ($application->application_status == 'New') {
        $status = custom_translate('Awaiting Response From HR', 'في انتظار رد من HR');
      } else {
        $status = $application->application_status;
      }
      ?>

        <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 mrgbtm_20">
          <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formLeftCont">
            <p><?php echo $application->application_title; ?></p>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formRightCont">
            <p><?php echo $status; ?></p>
          </div>
        </div>

    <?php } ?>
    </div>

    <?php
    }

  }
  