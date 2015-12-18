<?php

  $ecardobj = new ECard;
  
  if(isset($_GET['info']) && $_GET['info']=='delete'){
    $arrresult = $ecardobj->delete_ecard($_GET['ecardd_id']);
  }

  if($arrresult){
    $message = "Ecard Deleted.";
    header("Location:admin.php?page=fhg_ecards");
    exit;
  }

 if (isset($message)): 
?>
  <div class="updated">
    <p><?php echo $message;?></p>
  </div>
<?php 
  endif;

?>