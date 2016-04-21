(function() {

	tinymce.PluginManager.add('my_mce_button', function( editor, url ) {
		editor.addButton('my_mce_button', {
			text: false,
			icon: 'my-dd-icon',
			//image: img_path + '/fh_map_icon.png',
			onclick: function() {
				tinyMCE.execCommand('mceInsertContent', true, '<div class="fa fa-angle-double-down"></div>');
				//tinyMCE.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' + img_path + '/fh_map_icon.png' + '"/>');
				//editor.insertContent('WPExplorer.com is awesome!');
			}
		});
	});
})();