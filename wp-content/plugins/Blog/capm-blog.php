<?php
/*
Plugin Name: Blog
Plugin URI: http://www.annet.com
Description: Blog Plugin
Version: 0.1
Author: Annet
Author URI: http://www.annet.com
License: GPLv2 or later
*/




/**
 * Meta Box For Adding Location for the news in arabic ..(1846)
 */

add_action( 'add_meta_boxes', 'cd_meta_box_blog_title_ar' );
function cd_meta_box_blog_title_ar()
{
    add_meta_box( 'title-box', 'Add Blog Title', 'blog_title_cb', 'post', 'normal', 'high' );
}
function blog_title_cb()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );


    $blogenglish = isset( $values['blog_title_text'] ) ? $values['blog_title_text'] : '';
    $blogarabic = isset( $values['blog_title_text_ar'] ) ? $values['blog_title_text_ar'] : '';

 
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="blog_title_text">English</label>
        <input type="text" name="blog_title_text" id="blog_title_text" value="<?php echo $newsenglish[0]; ?>" />
    </p>
    <p>
        <label for="blog_title_text_ar">Arabic</label>
        <input type="text" name="blog_title_text_ar" id="blog_title_text_ar" value="<?php echo $blogarabic[0]; ?>" />
    </p>
     
 
    <?php    
}

add_action( 'save_post', 'blog_title_save' );
function blog_title_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['blog_title_text'] ) )
        update_post_meta( $post_id, 'blog_title_text', wp_kses( $_POST['blog_title_text'], $allowed ) );

     if( isset( $_POST['blog_title_text_ar'] ) )
        update_post_meta( $post_id, 'blog_title_text_ar', wp_kses( $_POST['blog_title_text_ar'], $allowed ) );
         
    
}
?>
<?php 

function totalblogPosts(){
    
     global $wpdb;

    $args_post1 = array(
        'numberposts' => -1,
        'child_of' => 0,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_type' => 'post',
        'post_status' => 'publish'



        );
    $arg_post_data1 = get_posts($args_post1);

    return count($arg_post_data1);
}

function getblogPosts(){
    
     global $wpdb;

    $args_post = array(
        'numberposts' => -1,
        'child_of' => 0,
        'orderby' => 'title',
        'order' => 'ASC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 10, 
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1



        );
    $arg_post_data = get_posts($args_post);

    return $arg_post_data;
}

/**
 * Code to display all events based on the category(year) ..
 * Done by (1846)
 */
function displayBlogs() {
        //code for sorting posts based on month --done by (1846)
    $arg_post_data = getblogPosts();
    $post_count = count($arg_post_data);  
    if ($arg_post_data) {
      
        $counter =0;
        foreach ($arg_post_data as $post_data) {
            $each_faq = (array) $post_data;
            //print_r($each_faq);
            $id = $each_faq['ID'];
      
            $post_title = $each_faq['post_title'];
            $post_content = $each_faq['post_content'];
            $posturl = $each_faq['guid'];
            $post_name = $each_faq['post_name'];
            $customurl = $each_faq['guid'];
            $postdate = $each_faq['post_date'];
            
            $length = str_word_count($post_content);
    
            $post_title = $each_faq['post_title'];
             if ($length >= 10) {
              $total_words = explode(" ", $post_title);
              $post_title = implode(" ", array_splice($total_words, 0, 15));
              
              
                $readmore = custom_translate('Read More','اقرأ المزيد');

                $post_title .= '...<a href="'.$customurl.'">'.$readmore.'</a>';    

            }else {
                $readmore = custom_translate('Read More','اقرأ المزيد');

                $post_title .= '...<a href="'.$customurl.'">'.$readmore.'</a>';    
             
            }
            

            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($id));
            
            $url = $_SERVER['REQUEST_URI']; 
                if (strstr($url, '/ar/') !== false) //check if '?' is present
                {
                       
                       $venue = 'مكان';
                       $date = 'تاريخ';
                       $postdate = date('j.M.Y', strtotime($postdate));
                       $postdate = transmonth($postdate);
                       $postdate = trans($postdate);
                   
                } else{
                        $venue = 'Venue';
                       $date = 'Date';
                       $postdate = date('j.M.Y', strtotime($postdate));
                   
                }


            if($counter == 0){

            $details .= '<div class="pastEvtContainer"><div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
            $details .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 pastEvtConpadleft"><div class="detailpast"><div class="topborder">&nbsp;</div>';
            $details .= '<div class="venueDate"><span>'.$date.':</span> <span>'. $postdate.'</span></div>';
            $details .= '<div class="pastEvtxt"><a href="'.$customurl.'">'.$post_title.'</a></div></div></div>';
            
            $counter = 1;
            }else if($counter == 1){


            $details .= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-16 pastEvtConpadRight"><div class="detailpast"><div class="topborder">&nbsp;</div>';
            $details .= '<div class="venueDate"><span>'.$date.':</span> <span>'. $postdate.'</span></div>';
            $details .= '<div class="pastEvtxt"><a href="'.$customurl.'">'.$post_title.'</a></div></div></div>';
            $details .= ' <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div></div>';

            $counter = 0;
            }


            //$details .= $gmte;
        }
             $big = 999999999; // need an unlikely integer
              $details .= '<div class="pastEvtConloadmore"><div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div>';
            
            $totalposts =  totalblogPosts();
            $totalcount= $totalposts/10;
            //$totalcount  = $totalposts / $div;
            $pagenum_link = get_pagenum_link() ;
            //echo $pagenum_link;
            $url_parts    = explode( '?', $pagenum_link );
            //echo $url_parts[0];
              // $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';
            $url = $_SERVER['REQUEST_URI']; 
                if (strstr($url, '/ar/') !== false) //check if '?' is present
                {
                    
                                $pagenum_link = SITE_URL.'/ar/مدونة%_%';
                  $pages = paginate_links( array(

                'base' => $pagenum_link,
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $totalcount,
                'prev_next' => false,
                'type'  => 'array',
                'prev_next'   => TRUE,
                'prev_text'    => __('previous'),
                'next_text'    => __('next'),
                ) );
              } 
              else {
                 $pages = paginate_links( array(

                       'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $totalcount,
                        'prev_next' => false,
                        'type'  => 'array',
                        'prev_next'   => TRUE,
                        'prev_text'    => __('previous'),
                        'next_text'    => __('next'),
                    ) );
              }

            if( is_array( $pages ) ) {
             //   $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                $details.= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-16"><div class="pagination-centered"><ul class="pagination">';

            $url = $_SERVER['REQUEST_URI']; 
                foreach ( $pages as $page ){
               
                         $details .= "<li>$page</li>"; 
                     }                               
               $details .= '</ul></div></div>';
            }              

             $details .= ' <div class="col-lg-2 col-md-2 col-sm-2 col-xs-16"></div></div>';

        echo $str .= $details;
        //echo $str = $cat_name;
    } else {
        $coming  = custom_translate('Coming Soon','قريبا');
        $details = '<div class="pastEvtContainer coming">'.$coming.'</div>';
        echo $details;
    }
}

add_shortcode('blogs', 'displayBlogs');
?>
