jQuery(document).ready(function($){

  var mediaUploader;

  $('#upload-button').click(function(e) {
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
      $('#media_url').val(attachment.url);
    });
    // Open the uploader dialog
    mediaUploader.open();
  });

  // $('#sendecard').hide();
  // $('#sendecardbtn').click(function(){
  //   $('#sendecard').show();
  // });

});