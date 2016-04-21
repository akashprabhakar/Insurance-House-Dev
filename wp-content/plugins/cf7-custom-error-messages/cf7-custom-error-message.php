<?php
/**
 * Plugin Name: CF7 - Different Error Message
 * Plugin URL: 
 * Description:  This plugin will integrate Different Error Messages for different fields after submitting the form.
 * Version: 1.0
 * Author: David Pokorny
 * Author URI: http://#/
 * Developer: Pokorny David
 * Developer E-Mail: pokornydavid4@gmail.com
 * Text Domain: contact-form-7-diff
 * Domain Path: /languages
 * 
 * Copyright: © 2009-2015 izept.com.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * 
 * @access      public
 * @since       1.0 
 * @return      $content
*/
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

require_once (dirname(__FILE__) . '/cf7-tag-custom-error-message.php');

function cf7pp_editor_panels_error ( $panels ) {
		
		$new_page = array(
			'Error' => array(
				'title' => __( 'Custom Error', 'contact-form-7' ),
				'callback' => 'cf7pp_admin_error_additional_settings'
			)
		);
		
		$panels = array_merge($panels, $new_page);
		
		return $panels;
		
	}
	add_filter( 'wpcf7_editor_panels', 'cf7pp_editor_panels_error' );

function cf7pp_admin_error_additional_settings( $cf7 )
{
	
	$post_id = sanitize_text_field($_GET['post']);
	$tags = $cf7->form_scan_shortcode();
	$enable = get_post_meta($post_id, "_cf7cm_enable_errors", true);
	
	if ($enable == "1") { $checked = "CHECKED"; } else { $checked = ""; }
	
	$admin_cm_output = "";
	$admin_cm_output .= "<form>";
	$admin_cm_output .= "<div id='additional_settings-sortables' class='meta-box'><div id='additionalsettingsdiv'>";
	$admin_cm_output .= "<div class='handlediv' title='Click to toggle'><br></div><h3 class='hndle ui-sortable-handle'><span>Custom Error Message Settings</span></h3>";
	$admin_cm_output .= "<div class='inside'>";
	
	$admin_cm_output .= "<div class='mail-field'>";
	$admin_cm_output .= "<input name='enable' value='1' type='checkbox' $checked>";
	$admin_cm_output .= "<label>Enable Custom Error Messages on this form</label>";
	$admin_cm_output .= "</div>";

	$findme   = '*';
	$admin_cm_output .= "<br /><table>";
	foreach ($tags as $key => $value) {
		# code...
		$pos = strpos($value['type'], $findme);
		if($pos)
		{
			$val = "val_of".$value['name'];
			$key = "_cf7cm_".$value['name'];
			$val = get_post_meta($post_id, $key, true);
			$admin_cm_output .= "<tr><td>Error Message For : <strong>".str_replace('-',' ',$value['name'])."</strong></td></tr>";
			$admin_cm_output .= "<tr><td><input type='text' size='50' name='$key' value='$val'> </td></tr><tr><td>";
		}
		
	}
		
	$admin_cm_output .= "<input type='hidden' name='email' value='2'>";
	
	$admin_cm_output .= "<input type='hidden' name='post' value='$post_id'>";
	
	$admin_cm_output .= "</td></tr></table></form>";
	$admin_cm_output .= "</div>";
	$admin_cm_output .= "</div>";
	$admin_cm_output .= "</div>";

	echo $admin_cm_output;
	
}
// hook into contact form 7 admin form save
add_action('wpcf7_save_contact_form', 'cf7pp_save_contact_form');

function cf7pp_save_contact_form( $cf7 ) {

		$tags = $cf7->form_scan_shortcode();
	
		$post_id = sanitize_text_field($_POST['post']);
		
		if (!empty($_POST['enable'])) {
			$enable = sanitize_text_field($_POST['enable']);
			update_post_meta($post_id, "_cf7cm_enable_errors", $enable);
		} else {
			update_post_meta($post_id, "_cf7cm_enable_errors", 0);
		}

		foreach ($tags as $key => $value) {

			$key = "_cf7cm_".$value['name'];
			$vals = sanitize_text_field($_POST[$key]);
			update_post_meta($post_id, $key, $vals);

		}
		
}
?>