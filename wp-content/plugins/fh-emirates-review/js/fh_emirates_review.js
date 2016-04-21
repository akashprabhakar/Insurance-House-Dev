jQuery(document).ready(function($){
//alert()
  var mediaUploader;

  $('#upload-button-fh').click(function(e) {
    e.preventDefault();
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
      $('#emirates_pdf').val(attachment.url);
    });
    // Open the uploader dialog
    mediaUploader.open();
  });

   $('#upload-button-fh-ar').click(function(e) {
    e.preventDefault();
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
      $('#emirates_pdf_ar').val(attachment.url);
    });
    // Open the uploader dialog
    mediaUploader.open();
  });

 

});