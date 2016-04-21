<?php

function capm_registration_form() {

  // only show the registration form to non-logged-in members
  if (!is_user_logged_in()) {

    global $capm_load_css;

    // set this to true so the CSS is loaded
    $capm_load_css = true;

    // check to make sure user registration is enabled
    $registration_enabled = get_option('users_can_register');

    // only show the registration form if allowed
    if ($registration_enabled) {
      $output = capm_registration_form_fields();
    } else {
      $output = __('User registration is not enabled');
    }
    return $output;
  }
}

add_shortcode('register_form', 'capm_registration_form');

function capm_login_form() {

  if (!is_user_logged_in()) {

    global $capm_load_css;

    // set this to true so the CSS is loaded
    $capm_load_css = true;

    $output = capm_login_form_fields();
  } else {
    // could show some logged in user info here
    // $output = 'user info here';
  }
  return $output;
}

add_shortcode('login_form', 'capm_login_form');

function capm_registration_form_fields() {

  ob_start();
  ?>  



  <h3 class="career_header"><?php _e(custom_translate('Register Account', 'تسجيل حساب')); ?></h3>
  <div class="careersApplyFormCont">
    <?php
    // show any error messages after form submission
    capm_show_error_messages();
    ?>
    <form id="capm_registration_form" class="capm_form" action="" method="POST">
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16">
          <label for="capm_user_Login"><?php _e(custom_translate('Username*', 'اسم المستخدم*')); ?></label></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <input name="capm_user_login" id="capm_user_login" class="form-control" value="<?php echo $_POST['capm_user_login']; ?>" type="text" required/></div>
      </div>


      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16">
          <label for="capm_user_email"><?php _e(custom_translate('Email*', 'البريد الإلكتروني*')); ?></label></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <input name="capm_user_email" id="capm_user_email" class="form-control" value="<?php echo $_POST['capm_user_login']; ?>" type="email" required/></div>
      </div>

      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16">
          <label for="capm_user_first"><?php _e(custom_translate('First Name*', 'الاسم الأول*')); ?></label></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <input name="capm_user_first" id="capm_user_first" class="form-control" value="<?php echo $_POST['capm_user_login']; ?>" type="text" required/></div>
      </div>

      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16"> <label for="capm_user_last"><?php _e(custom_translate('Last Name*', 'اسم العائلة*')); ?></label></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16"><input name="capm_user_last" value="<?php echo $_POST['capm_user_login']; ?>" id="capm_user_last" class="form-control" type="text" required/></div>
      </div>

      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16"> <label for="password"><?php _e(custom_translate('Password*', 'كلمة المرور*')); ?></label></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16"> <input name="capm_user_pass" id="password" class="form-control" type="password" required/></div>
      </div>


      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16"> <label for="password_again"><?php _e(custom_translate('Password Confirmation*', 'تأكيد كلمة المرور*')); ?></label></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16"><input name="capm_user_pass_confirm" id="password_again" class="form-control" type="password" required/></div>
      </div>

      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <div id="RecaptchaFields1" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
          <span style="display:none" class="capspan">Please check the recaptcha. </span>
        </div>
      </div>

      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <input type="hidden" name="capm_register_nonce" value="<?php echo wp_create_nonce('capm-register-nonce'); ?>"/>
          <input type="submit" class="formbtn" value="<?php _e(custom_translate('Register To Apply', 'سجل لتقدم')); ?>"/>
          <?php
          if (isset($_GET['id'])) {
            # code...
            $queryid = $_GET['id'];
            $sitecustomurl = SITE_URL . custom_translate('/careers-description/', '/ar/مهن-ويرد-وصف/') . '?id=' . $queryid . '&form=loginfrm'; //print_r($_SERVER); 
          } else {
            $sitecustomurl = SITE_URL . custom_translate('/careers/', '/ar/فرص-العمل/') . '?form=loginfrm'; //print_r($_SERVER);
          }
          ?>
          <a href="<?php echo $sitecustomurl; ?>" class="formbtn registerbtn_mrgtop" value="" id="loginbtn"><?php echo custom_translate('Login', 'دخول'); ?></a>
   <!--             <input type="button" class="formbtn registerbtn_mrgtop" value="<?php echo custom_translate('Login', 'دخول'); ?>" id="loginbtn"> -->
        </div>
      </div>
    </form>
  </div>
  <?php
  return ob_get_clean();
}

function capm_login_form_fields() {

  ob_start();
  ?>

  <h3 class="career_header"><?php _e(custom_translate('Login', 'دخول')); ?></h3>
  <div class="careersApplyFormCont">
    <?php
    // show any error messages after form submission
    capm_show_error_messages();
    ?>
    <form id="capm_login_form"  class="capm_form"action="" method="post">
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16">
          <label for="capm_user_Login"><?php echo custom_translate('Username*', 'اسم المستخدم*'); ?></label></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <input name="capm_user_login" id="capm_user_login" class="form-control" type="text" required/></div>
      </div>

      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16">
          <label for="capm_user_pass"><?php echo custom_translate('Password*', 'كلمة السر*'); ?></label> </div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <input name="capm_user_pass" id="capm_user_pass" class="form-control" type="password" required/></div>
      </div>

      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <div id="RecaptchaFields1" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
          <span style="display:none" class="capspan">Please check the recaptcha. </span>
        </div>
      </div>

      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 careerFirstForm_mrgn">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-10 col-xs-16">
          <input type="hidden" name="capm_login_nonce" value="<?php echo wp_create_nonce('capm-login-nonce'); ?>"/>
          <input id="capm_login_submit" class="formbtn" type="submit" value="<?php echo custom_translate('Login', 'دخول'); ?>"/>
         <!--  <input type="button" class="formbtn registerbtn_mrgtop" value="<?php _e(custom_translate('Register To Apply', 'سجّل لتقدّم')); ?>" id="registerbtn"> -->
          <?php
          if (isset($_GET['id'])) {
            # code...
            $queryid = $_GET['id'];
            $sitecustomurl = SITE_URL . custom_translate('/careers-description/', '/ar/مهن-ويرد-وصف/') . '?id=' . $queryid . '&form=registerfrm'; //print_r($_SERVER); 
          } else {
            $sitecustomurl = SITE_URL . custom_translate('/careers/', '/ar/فرص-العمل/') . '?form=registerfrm'; //print_r($_SERVER);
          }
          ?>
          <a href="<?php echo $sitecustomurl; ?>" class="formbtn registerbtn_mrgtop" value="" id="registerbtn"><?php _e(custom_translate('Register To Apply', 'سجّل لتقدّم')); ?></a>
        </div>
      </div>
    </form>
  </div>
  <?php
  return ob_get_clean();
}

function capm_login_member() {

  if (isset($_POST['capm_user_login']) && wp_verify_nonce($_POST['capm_login_nonce'], 'capm-login-nonce')) {

    // this returns the user ID and other info from the user name
    $user = get_userdatabylogin($_POST['capm_user_login']);

    if (!$user) {
      // if the user name doesn't exist
      capm_errors()->add('empty_username', __('Invalid username'));
    }

    if (!isset($_POST['capm_user_pass']) || $_POST['capm_user_pass'] == '') {
      // if no password was entered
      capm_errors()->add('empty_password', __('Please enter a password'));
    }

    // check the user's login with their password
    if (!wp_check_password($_POST['capm_user_pass'], $user->user_pass, $user->ID)) {
      // if the password is incorrect for the specified user
      capm_errors()->add('empty_password', __('Incorrect password'));
    }

    // retrieve all error messages
    $errors = capm_errors()->get_error_messages();

    // only log the user in if there are no errors
    if (empty($errors)) {

      wp_setcookie($_POST['capm_user_login'], $_POST['capm_user_pass'], true);
      wp_set_current_user($user->ID, $_POST['capm_user_login']);
      do_action('wp_login', $_POST['capm_user_login']);

      // $currenturl = SITE_URL.DS.'jobss';
      //    wp_redirect($currenturl); exit;
    }
  }
}

add_action('init', 'capm_login_member');

function capm_add_new_member() {
  if (isset($_POST["capm_user_login"]) && wp_verify_nonce($_POST['capm_register_nonce'], 'capm-register-nonce')) {
    $user_login = sanitize_text_field($_POST["capm_user_login"]);
    $user_email = sanitize_text_field($_POST["capm_user_email"]);
    $user_first = sanitize_text_field($_POST["capm_user_first"]);
    $user_last = sanitize_text_field($_POST["capm_user_last"]);
    $user_pass = sanitize_text_field($_POST["capm_user_pass"]);
    $pass_confirm = sanitize_text_field($_POST["capm_user_pass_confirm"]);

    // this is required for username checks
    require_once(ABSPATH . WPINC . '/registration.php');

    if (username_exists($user_login)) {
      // Username already registered
      capm_errors()->add('username_unavailable', __('Username already taken'));
    }
    if (!validate_username($user_login)) {
      // invalid username
      capm_errors()->add('username_invalid', __('Invalid username'));
    }
    if ($user_login == '') {
      // empty username
      capm_errors()->add('username_empty', __('Please enter a username'));
    }
    if (!is_email($user_email)) {
      //invalid email
      capm_errors()->add('email_invalid', __('Invalid email'));
    }
    if (email_exists($user_email)) {
      //Email address already registered
      capm_errors()->add('email_used', __('Email already registered'));
    }
    if ($user_pass == '') {
      // passwords do not match
      capm_errors()->add('password_empty', __('Please enter a password'));
    }
    if ($user_pass != $pass_confirm) {
      // passwords do not match
      capm_errors()->add('password_mismatch', __('Passwords do not match'));
    }

    $errors = capm_errors()->get_error_messages();

    // only create the user in if there are no errors
    if (empty($errors)) {

      $new_user_id = wp_insert_user(array(
          'user_login' => $user_login,
          'user_pass' => $user_pass,
          'user_email' => $user_email,
          'first_name' => $user_first,
          'last_name' => $user_last,
          'user_registered' => date('Y-m-d H:i:s'),
          'role' => 'subscriber'
              )
      );
      if ($new_user_id) {
        // send an email to the admin alerting them of the registration
        wp_new_user_notification($new_user_id);

        // log the new user in
        wp_setcookie($user_login, $user_pass, true);
        wp_set_current_user($new_user_id, $user_login);
        do_action('wp_login', $user_login);
      }
    }
  }
}

add_action('init', 'capm_add_new_member');

function capm_errors() {
  static $wp_error; // Will hold global variable safely
  return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

function capm_show_error_messages() {
  if ($codes = capm_errors()->get_error_codes()) {
    echo '<div class="capm_errors">';
    // Loop error codes and display errors
    foreach ($codes as $code) {
      $message = capm_errors()->get_error_message($code);
      echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
    }
    echo '</div>';
  }
}

function capm_register_css() {
  // wp_register_style('capm-form-css', plugin_dir_url(__FILE__) . 'includes/css/forms.css');
}

add_action('init', 'capm_register_css');

function capm_print_css() {
  global $capm_load_css;

  // this variable is set to TRUE if the short code is used on a page/post
  if (!$capm_load_css)
    return; // this means that neither short code is present, so we get out of here

  wp_print_styles('capm-form-css');
}

add_action('wp_footer', 'capm_print_css');
?>