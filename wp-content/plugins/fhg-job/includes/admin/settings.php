<?php

  //$ecardobj = new ECard;
require_once(JS_INCLUDES_ADMIN_CLASS_DIR . DS . 'applicationclass.php');
$objMem = new applicationClass();
//insert
  

  if(isset($_POST['hr_email_insert'])){
    
    $insert_ecard = $objMem->update_settings_table($_POST);
    if(isset($insert_ecard) && $insert_ecard==true){
     $message  = "Email Address has been updated successfully.";
    }
  }

  $get_settings = $objMem->select_settings_table(); 
?>

<div class="wrap">
  
  
  <div class="postbox">
          <?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
            
            <div class="inside">
              <h2><span class="dashicons dashicons-admin-generic"></span>Job Settings</h2>
              <form name="wptreehouse_username_form" method="post" action="">             

                <table class="form-table">
                  <tr valign="top"> 
                    <th scope="row"><label>HR Email Address(Default) </label></th>
                    <td>
                        <input name="hr_email" placeholder="Enter HR Email Address" id="hr_email" type="email" value="<?php echo $get_settings['hr_email']; ?>" class="regular-text" required/>
                    </td>
                  </tr>           
                </table>

                <p>
                  <input class="button-primary" type="submit" name="hr_email_insert" value="Save" /> 
                  <input type="hidden" name="hr_id" value="<?php echo $get_settings['id']; ?>">
                </p>

              </form>

            </div> <!-- .inside -->
          
          </div> <!-- .postbox -->
</div><!-- .WRAP -->
<?php




