<?php
    $ecardobj = new ECard;
    if(isset($_GET['id']) && !empty($_GET['id'])){
      $arrresult = get_single_ecards($_GET['id']);
    }
    $ecard_id = $arrresult->id;
    $ecard_title = $arrresult->ecard_title;
    $ecard_html = stripslashes($arrresult->ecard_html);
    $media_url = $arrresult->media_url;

    $url = get_url();
    
    if(isset($_POST['ecardgo'])){
      $emailconfirm = $ecardobj->sendemail($ecard_html);
    }


    ?>
   <div class="container">
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 ecardsDetailMainCont">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16">
          <?php if(isset($emailconfirm) && $emailconfirm == true){ ?>
            <p>Email has been successfully sent.</p>
          <?php }   ?>
          <div class="ecardsDetailMainCont">    
            <div class="ecardsDetailsCont">
              <div class="ecardsDetailBox">
                <div class="topborder"></div>
                <div class="ecardsPosition"><?php echo custom_translate($ecard_title, $ecard_title); ?></div>
                
                <span class="glyphicon glyphicon-menu-left"><a href="<?php echo $url . custom_translate('ecard', 'بطاقات-الكترونية'); ?>"><?php echo custom_translate('Back to Ecards Listing', 'Back to Ecards Listing');?></a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
      </div>
    </div>
  
  <div class="container">

    <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 ">
      
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-16 careersDetailResponsibilities">
      <div class="ecardscont">

        <div class="careerDetailsContainer"><?php echo custom_translate($ecard_html, $ecard_html); ?>
               <!-- send ecard div -->
      
          <div class="sendecard">
            <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 mrgbtm_20">
              <form method="post" name="sendecardform" id="sendecardform">
                <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formLeftCont">
                  <p class="heading"><?php echo custom_translate('Recipient Details','المسمى الوظيفي');?></p>
                  <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 ecardleftright">
                    <input name="receivername" placeholder="Enter Recipient's Name" id="receivername" type="text" value="" class="ecardtextbox" required/>
                    
                  </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formRightCont">
                  <p class="heading opac"><?php echo custom_translate('To Details','حالة الطلب');?></p>
                  <!-- <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 ecardleftright">
                    <input name="receivername" placeholder="Enter Receiver's Name" id="receivername" type="text" value="" class="ecardtextbox" required/>
                     <input name="receiveremailid" placeholder="Enter Receiver's Email Address" id="receiveremailid" type="email" value="" class="ecardtextbox" required/>
                  </div> -->
                  <input name="receiveremailid" placeholder="Enter Recipient's Email Address" id="receiveremailid" type="email" value="" class="ecardtextbox" required/>
                </div>
                <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 mrgbtm_20">
                  <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formLeftCont">
                    <input type="hidden" name="ecardid" class="ecardidd" value="">
                    <input type="submit" name="ecardgo" id="ecardgo" class="ecardgobtn" value="Go">
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formRightCont">
                  </div>
                </div>
              </form>
            </div>
          </div>
      <!-- end send ecard div -->
      </div>
        </div>
        <div  name="sendemail" id="sendemail" class=" apply_now text-center">
          <a href="<?php echo $media_url;?>" download><?php echo custom_translate('Download', 'Download');?></a>
          <a href="#" class="sendecardbtn"><?php echo custom_translate('Send', 'Send');?></a></div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>
    </div>
  </div>
  
