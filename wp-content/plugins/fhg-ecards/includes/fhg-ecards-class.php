<?php 

class ECard{

  public function get_ecards() {
    global $wpdb;
    $sql = "select * from " . ECARDS_TABLENAME . " order by id desc";
    if ($limit) {
      $sql .= " $limit";
    }
    $result = $wpdb->get_results($sql);

    return $result;
  }

  public function get_single_ecard($id){

    global $wpdb;
    $sql = "select * from " . ECARDS_TABLENAME . " where id = $id order by id desc";
    $result = $wpdb->get_row($sql);

    return $result;
  }

  public function insert_ecard($data){

    $ecard_title = sanitize_text_field($data["ecard_title"]);
    $ecard_html = $data["ecard_html"];
    $media_url = sanitize_text_field($data["media_url"]);

    global $wpdb;
  
    $insertqry =$wpdb->insert(
      ECARDS_TABLENAME, //table
      array('ecard_title' => $ecard_title,'ecard_html' => $ecard_html,'media_url' => $media_url), //data
      array('%s','%s','%s') //data format      
    );
    
    if($insertqry){
      return true;
    }
  }

  public function update_ecard($data){

    $ecard_title = sanitize_text_field($data["ecard_title"]);
    $ecard_html = $data["ecard_html"];
    $media_url = sanitize_text_field($data["media_url"]);
    $ecard_id = sanitize_text_field($data["ecard_id"]);

    global $wpdb;
  
    $wpdb->update(
      ECARDS_TABLENAME, //table
      array('ecard_title' => $ecard_title,'ecard_html' => $ecard_html,'media_url' => $media_url), //data
      array( 'id' => $ecard_id ),
      array('%s','%s','%s'),
      array( '%d' )  //data format      
    );
    return true;
  }

  public function delete_ecard($id){
    global $wpdb;
    $wpdb->delete('wp_fhg_ecards', array( 'id' => $id), array( '%d' ) );
    return true;
  }
  

  public function _Download($f_location, $f_name){
    $file=uniqid().'.pdf';
    file_put_contents($file,file_get_contents($f_location));
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . filesize($file));
    header('Content-Disposition: attachment; filename=' . basename($f_name));
     readfile($file);
  }

  public function sendemail($ecard_html){


    $attachments = "";
    $headers = 'Content-type: text/html;charset=utf-8' . "\r\n";   
    $headers .= 'From: CAPM <annet.fhg@gmail.com>' . "\r\n";
 

    $subject = 'CAPM ECARD';
    $message = '<p>Dear '.stripslashes(sanitize_text_field($_POST['receivername'])).',</p>';
    $message .= stripslashes($ecard_html);
    $message .= '<p>Thank You </p>';
    $message .= '<p>CAPM</p>';

    $email = "akashmudliyar@gmail.com";
    $mailconfirm = wp_mail(sanitize_text_field($_POST['receiveremailid']), $subject, $message, $headers, $attachments);
    //$mailconfirm = mail("test@dispostable.com", "subject", "comment", "From:" . $email);
    return $mailconfirm;
  }


  


}


