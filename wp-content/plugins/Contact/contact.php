<?php

/**
 * Plugin Name: Contact Us
 * Plugin URI: http://annet.com/
 * Description: It includes the contact form for the user. 
 * Version: 1.0 
 * Author: Annet	
 * Author URI: www.annet.com
 */
// Register the contact us plugin

function contact_us() { ?>
    <div class="slide-out-div">
    <a class="handle" ></a>
    <div class="formdivs" style="opacity:0;">
    <h3><?php echo custom_translate('Contact Us', 'اتصل بنا');?></h3>
    <?php
        if (check_arabic()) {
            echo do_shortcode('[contact-form-7 id="801" title="Contact Us - Arabic"]');
        }else{
            echo do_shortcode('[contact-form-7 id="809" title="Contact Us"]');
        }
            echo '</div></div>';
    }

function contact_us_mobile() { ?>
    
    <div class="slide-out-div-mobile">
    
    
    <?php
        if (check_arabic()) {
            echo do_shortcode('[contact-form-7 id="801" title="Contact Us - Arabic"]');
        }else{
            echo do_shortcode('[contact-form-7 id="809" title="Contact Us"]');
        }
            echo '</div>';
    }

    add_shortcode('contact_us', 'contact_us');
    add_shortcode('contact_us_mobile', 'contact_us_mobile');
    ?>