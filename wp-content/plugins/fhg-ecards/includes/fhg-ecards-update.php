<?php

  $ecardobj = new ECard;
   if(isset($_POST['ecard_update'])){
    $insert_ecard = $ecardobj->update_ecard($_POST);
    $message = "ECARD has been updated";
   
  }

  if(isset($_GET['ecard_id'])){
  	$ecard = $ecardobj->get_single_ecard($_GET['ecard_id']);
  	$ecard_id = $ecard->id;
  	$ecard_title = $ecard->ecard_title;
  	$ecard_html = $ecard->ecard_html;
  	$media_url = $ecard->media_url;
  }
 
?>

<div class="wrap">
 	<div id="icon-upload" class="icon32"></div>
  <h2><span class="dashicons dashicons-playlist-video"></span> FHG ECARDS Plugin</h2>
  <div class="postbox">
  				 
          <?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
            
            <div class="inside">
            	<h3><span class="dashicons dashicons-edit"></span>Edit E-CARD</h3>
              <form name="wptreehouse_username_form" method="post" action="">             

                <table class="form-table">
                  <tr valign="top"> 
                    <th scope="row"><label>ECARD Title </label></th>
                    <td>
                        <input name="ecard_title" placeholder="Enter Ecard title" id="ecard_title" type="text" value="<?php echo $ecard_title; ?>" class="regular-text" required/>
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
                      <input id="media_url" type="text" value="<?php echo $media_url; ?>" name="media_url" />
                      <!-- <input id="upload-button" type="button" class="button" value="Upload Image" />
   -->
                      <button type="button" id="upload-button" class="button" ><span class="dashicons dashicons-admin-media"></span> Add Media</button>
                    </td>
                  </tr>             
                </table>

                <p>
                	<input type="hidden" name="ecard_id" id="ecard_id" value="<?php echo $ecard_id; ?>" />
                  <input class="button-primary" type="submit" name="ecard_update" value="Update" /> 
                </p>

              </form>

            </div> <!-- .inside -->
          
          </div> <!-- .postbox -->
</div><!-- .WRAP -->
<?php




