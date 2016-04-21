<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function fhg_lp_add_meta_box() {
  $screens = array( 'post', 'page' );

  foreach ( $screens as $screen ) {

    add_meta_box(
      'fhg_lp_sectionid',
      __( 'FHG Landing Page Setting', 'fhg_lp_name_text' ),
      'fhg_lp_meta_box_callback',
      $screen
    );
  }
}
add_action( 'add_meta_boxes', 'fhg_lp_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function fhg_lp_meta_box_callback( $post ) {

  // Add a nonce field so we can check for it later.
  wp_nonce_field( 'fhg_lp_save_meta_box_data', 'fhg_lp_meta_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  echo '<table>
  <tr>
    <td width="150px">
      <label for="fhg_lp_name">';
      _e( 'Select Landing Page', 'fhg_lp_name_text' );
      echo '</label>
    </td>
    <td>';
    $fhg_landing_pages_options = get_option( 'fhg_lp_settings' );
    $fhg_landing_pages_options_array = explode(',', $fhg_landing_pages_options['fhg_landing_pages']); 
    $fhg_current_landing_page = esc_attr( get_post_meta( $post->ID, '_fhg_lp_name', true ) );
    $fhg_current_landing_section = esc_attr( get_post_meta( $post->ID, '_fhg_lp_section', true ) );
    
    $fhg_lp_name_select_field = "<select name='fhg_lp_name'>";
    $fhg_lp_name_select_field .= "<option value='' ";
    if ( "" == $fhg_current_landing_page ){
      $fhg_lp_name_select_field .= 'selected';
    } 
    $fhg_lp_name_select_field .= ">Please select</option>";

    foreach ($fhg_landing_pages_options_array as &$option) {
        $fhg_lp_name_select_field .= "<option value='" . trim($option) . "' "; 
        if ( $option == $fhg_current_landing_page ){
          $fhg_lp_name_select_field .= 'selected';
        } 
        $fhg_lp_name_select_field .= ">" . ucwords(trim($option)) . "</option>";        
    }
   $fhg_lp_name_select_field .= "</select>";
   echo $fhg_lp_name_select_field;
   echo "</td>
   </tr>
   <tr>
   <td>
      <label for='fhg_lp_section'>";
      _e( 'Select Section', 'fhg_lp_section_text' );
      echo "</label>
   </td>
    <td>";
    $fhg_lp_section_select_field = "<select name='fhg_lp_section'>";
    $fhg_lp_section_select_field .= "<option value='' ";
    if ( "" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
    $fhg_lp_section_select_field .= ">Please select</option>  <option value='1' "; 
      if ( "1" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
      $fhg_lp_section_select_field .= ">Section 1</option>  <option value='2' "; 
      if ( "2" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
      $fhg_lp_section_select_field .= ">Section 2</option>  <option value='3' "; 
      if ( "3" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
      $fhg_lp_section_select_field .= ">Section 3</option>  <option value='4' "; 
      if ( "4" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
      $fhg_lp_section_select_field .= ">Section 4</option>  <option value='5' "; 
      if ( "5" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
      $fhg_lp_section_select_field .= ">Section 5</option> <option value='6' "; 
      if ( "6" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
      $fhg_lp_section_select_field .= ">Section 6</option> <option value='7' "; 
      if ( "7" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
      $fhg_lp_section_select_field .= ">Section 7</option> <option value='8' "; 
      if ( "8" == $fhg_current_landing_section ){ $fhg_lp_section_select_field .= 'selected';} 
      $fhg_lp_section_select_field .= ">Section 8</option>
    </select>";
      echo $fhg_lp_section_select_field;
echo "</td>
  </tr>
   <tr>
   <td>
      <label for='fhg_lp_section'>";
      _e( 'Set Order', 'fhg_lp_post_order' );
      echo '</label>
   </td>
    <td>
      <input type="text" id="_fhg_lp_post_order" name="fhg_lp_post_order" value="' . esc_attr( get_post_meta( $post->ID, '_fhg_lp_post_order', true ) ) . '" size="10" />
    </td>
    <td>
    </tr>
  </table>';
}
//  <input type="text" id="fhg_lp_name" name="fhg_lp_name" value="' . esc_attr( get_post_meta( $post->ID, '_fhg_lp_name', true ) ) . '" size="25" />
/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function fhg_lp_save_meta_box_data( $post_id ) {

  /*
   * We need to verify this came from our screen and with proper authorization,
   * because the save_post action can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['fhg_lp_meta_box_nonce'] ) ) {
    return;
  }

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $_POST['fhg_lp_meta_box_nonce'], 'fhg_lp_save_meta_box_data' ) ) {
    return;
  }

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  // Check the user's permissions.
  if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) ) {
      return;
    }

  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
    }
  }

  /* OK, it's safe for us to save the data now. */
  
  // Make sure that it is set.
  if ( ! isset( $_POST['fhg_lp_name'] ) ) {
    return;
  }

  if ( ! isset( $_POST['fhg_lp_section'] ) ) {
    return;
  }

  // Update the meta field in the database.
  update_post_meta( $post_id, '_fhg_lp_name', sanitize_text_field( $_POST['fhg_lp_name'] ) );
  update_post_meta( $post_id, '_fhg_lp_section', sanitize_text_field( $_POST['fhg_lp_section'] ) );
  update_post_meta( $post_id, '_fhg_lp_post_order', sanitize_text_field( $_POST['fhg_lp_post_order'] ) );
}
add_action( 'save_post', 'fhg_lp_save_meta_box_data' );

?>