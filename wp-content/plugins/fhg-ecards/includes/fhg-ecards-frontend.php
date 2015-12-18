<?php 
  $ecardobj = new ECard;
  $ecards = $ecardobj->get_ecards();

  if(isset($_POST['ecardgo'])){
    //print_r($_POST);
    //echo $_POST['ecardid'];
    $ecarddetails = $ecardobj->get_single_ecard($_POST['ecardid']);
    //echo $ecarddetails->ecard_html;die;
    $emailconfirm = $ecardobj->sendemail($ecarddetails->ecard_html);

  }
?>

<div class="ecardscont">
      <?php if(isset($emailconfirm) && $emailconfirm == true){ ?>
        <p>Email has been successfully sent.</p>
      <?php } ?>
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
              <p class="heading opac"><?php echo custom_translate('Recipient Details','المسمى الوظيفي');?></p>
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
      <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 mrgbtm_20">
        <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formLeftCont">
          <p class="heading"><?php echo custom_translate('ECARD Title','المسمى الوظيفي');?></p>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formRightCont">
          <p class="heading"><?php echo custom_translate('Actions','حالة الطلب');?></p>
        </div>
      </div>
      <?php   
      if(count($ecards) > 0 ){
        foreach($ecards as $ecard) {  
          $siteurl = SITE_URL.DS.'e-card-description?id='.$ecard->id; 
          $siteurl_ar = SITE_URL.DS.'ar/وصف-بطاقات-الكترونية?id='.$ecard->id; 

          ?>

        <div class="col-lg-16 col-md-16 col-sm-16 col-xs-16 mrgbtm_20">
          <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formLeftCont">
            <p><a href="<?php echo custom_translate($siteurl,$siteurl_ar);?>"><?php echo $ecard->ecard_title; ?></a></p>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-16 col-xs-16 formRightCont">
           
            <p>
              <a href="<?php echo custom_translate($siteurl,$siteurl_ar);?>">View</a> 
              <?php if(isset($ecard->media_url) && !empty($ecard->media_url)){ ?>
              <a href=<?php echo $ecard->media_url; ?> download>Download</a>  <?php  } ?>
              <a href="#" id="<?php echo $ecard->id; ?>" value="<?php echo $ecard->id; ?>" class="sendecardbtn">Send</a> 
            </p>
            
          </div>
        </div>


       

      <?php } 
      }

      ?>
</div>