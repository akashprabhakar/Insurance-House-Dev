<?php

  $ecardobj = new ECard;
  $arrresult = $ecardobj->get_ecards();


?>
<div class="wrap">
  
  <div id="icon-upload" class="icon32"></div>
  <h2><span class="dashicons dashicons-playlist-video"></span> FHG ECARDS Plugin 


  </h2>
  
  <div id="poststuff">
  
    <div id="post-body" class="metabox-holder columns-1">
    
      <!-- main content -->
      <div id="post-body-content">
        
        <div class="meta-box-sortables ui-sortable">

         

          <div class="postbox">
          
            <h3><span>List of all Ecards</span>
              <a href="admin.php?page=fhg_ecards_create" class="page-title-action">Add New</a>
            </h3>
            <div class="inside">
              
                <table class="widefat" class="form-table" id="joblist" cellspacing="0"><thead><tr><tr>

                <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Title</strong>
              
                <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Video/Flash Filename</strong>

                <th id="columnname" class="manage-column column-columnname" scope="col"><strong>Action</strong>

              </tr></tr>
            </thead><tbody>
        <?php
        
        if (count($arrresult) > 0) {
          ?>
                <?php
                foreach ($arrresult as $key => $val) {
                  $ecard_id = $val->id;
                  $ecard_title = $val->ecard_title;
                  $ecard_html = $val->ecard_html;
                  $media_url = $val->media_url;
                  ?>
                  <tr class='alternate' valign='top'>
                    <td class='column-columnname'>
                  <?php echo wordwrap(stripslashes($ecard_title), 40, "<br>\n", true); ?>
                    </td>
                   

                    <td class='column-columnname'><a href="<?php echo DOCUMENT_UPLOADS_URL . DS . $application_resume_filename; ?>" >
                      <?php echo stripslashes($media_url); ?></a>
                    </td>
                    <td><a href="admin.php?page=fhg_ecards_update&ecard_id=<?php echo $ecard_id; ?>">Edit</a>&nbsp;&nbsp;<a href="admin.php?page=fhg_ecards_delete&info=delete&ecardd_id=<?php echo $ecard_id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                  </tr>
                        <?php
                      }
                      
                    } else {
                      ?>
               
              <?php } ?>
            </tbody>
            <tfoot>
            <br/>
            </tfoot>
          </table>
            </div> <!-- .inside -->
          
          </div> <!-- .postbox -->

  

                   

         
    

        </div> <!-- .meta-box-sortables .ui-sortable -->
        
      </div> <!-- post-body-content -->
      

      
    </div> <!-- #post-body .metabox-holder .columns-2 -->
    
    <br class="clear">
  </div> <!-- #poststuff -->
  
</div> <!-- .wrap -->
