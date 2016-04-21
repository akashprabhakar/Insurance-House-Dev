jQuery(document).ready(function($){

  var mediaUploader,mediaUploader1;

  $('#finupload-button-fh').click(function(e) {
  
    // If the uploader object has already been created, reopen the dialog
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Upload File',
      button: {
      text: 'Upload File'
    }, multiple: false });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function() {
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#financialreports_pdf').val(attachment.url);
    });
    // Open the uploader dialog
    mediaUploader.open();
  });

   $('#finupload-button-fh-ar').click(function(e) {
   
    // If the uploader object has already been created, reopen the dialog
      if (mediaUploader1) {
      mediaUploader1.open();
      return;
    }
    // Extend the wp.media object
    mediaUploader1 = wp.media.frames.file_frame = wp.media({
      title: 'Upload File',
      button: {
      text: 'Upload File'
    }, multiple: false });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader1.on('select', function() {
      attachment1 = mediaUploader1.state().get('selection').first().toJSON();
   
      $('#financialreports_pdf_ar').val(attachment1.url);
    });
    // Open the uploader dialog
    mediaUploader1.open();
  });

 
 

});