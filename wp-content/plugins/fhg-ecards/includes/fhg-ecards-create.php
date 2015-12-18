<?php

  $ecardobj = new ECard;

//insert
  if(isset($_POST['ecard_insert'])){
    
    $insert_ecard = $ecardobj->insert_ecard($_POST);
    if(isset($insert_ecard) && $insert_ecard==true){
     
    }
  }
?>

<div class="wrap">
  
  
  <div class="postbox">
          <?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
            
            <div class="inside">
              <h2><span class="dashicons dashicons-plus"></span>Add New E-CARD</h2>
              <form name="wptreehouse_username_form" method="post" action="">             

                <table class="form-table">
                  <tr valign="top"> 
                    <th scope="row"><label>ECARD Title </label></th>
                    <td>
                        <input name="ecard_title" placeholder="Enter Ecard title" id="ecard_title" type="text" value="" class="regular-text" required/>
                    </td>
                  </tr>  

                  <tr valign="top">
                    <th scope="row"><label>ECARD HTML </label></th>
                    <td>
                      <?php
                      $args = array("textarea_rows" => 5, 'media_buttons' => true,
                          "textarea_name" => "ecard_html", "editor_class" => "my_editor_custom", 'tinymce' => array(
                              'theme_advanced_disable' => 'charmap,wp_help,blockquote,wp_more,pastetext,pasteword,bullist'
                              ));
                      wp_editor($ecard_html, "my_editor_1", $args);
                      ?>
                    </td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label>Upload Video:</label> <span class="error">*</span></th>
                    <td>
                      <input id="media_url" type="text" name="media_url" />
                      <!-- <input id="upload-button" type="button" class="button" value="Upload Image" />
   -->
                      <button type="button" id="upload-button" class="button" ><span class="dashicons dashicons-admin-media"></span> Add Media</button>
                    </td>
                  </tr>             
                </table>

                <p>
                  <input class="button-primary" type="submit" name="ecard_insert" value="Save" /> 
                </p>

              </form>

            </div> <!-- .inside -->
          
          </div> <!-- .postbox -->
</div><!-- .WRAP -->
<?php




