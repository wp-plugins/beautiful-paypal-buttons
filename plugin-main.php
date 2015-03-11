<?php
/*
Plugin Name: Beautiful Paypal Buttons
Plugin URI: http://wpexpand.com/beautiful-paypal-buttons/
Description: This plugin will enable beautiful paypal buttons in your wordpress site. 
Author: WP Expand
Author URI: http://wpexpand.com/
Version: 1.0
*/


/* Adding Latest jQuery from Wordpress */
function we_becutiful_paypal_buttons_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'we_becutiful_paypal_buttons_jquery');

function we_becutiful_paypal_buttons_files(){
    wp_enqueue_script( 'beautiful-paypal-buttons-script', plugins_url( '/js/jquery.classypaypal.min.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_style( 'beautiful-paypal-buttons-style', plugins_url( '/css/button-styles.css', __FILE__ ), array(), '1.0', 'all' ); 
}
add_action( 'wp_enqueue_scripts', 'we_becutiful_paypal_buttons_files' );



function beautiful_paypal_buttons_shortcode( $atts, $content = null  ) {
 
    extract( shortcode_atts( array(
        'id' => '1',
        'text' => 'Buy Now',
        'product' => 'Product Name',
        'email' => '',
        'price' => '10',
        'currency' => 'USD',
        'quantity' => '1',
        'type' => 'buynow',
        'style' => 'default',
        'target' => '_self',
        'color' => '#009CDE'
    ), $atts ) );
 
    return '
    
    <script>
        jQuery(document).ready(function($){
            $("#paypal'.$id.'").ClassyPaypal({
                type: "'.$type.'",
                checkoutTarget: "'.$target.'",
                style: "'.$style.'"
            });             
        });
    </script>
    
    <style>
        button#paypal'.$id.'.ClassyPaypal-style-one, button#paypal'.$id.'.ClassyPaypal-style-two {color:'.$color.'; border-color:'.$color.'}
        button#paypal'.$id.'.ClassyPaypal-style-default, button#paypal'.$id.'.ClassyPaypal-style-three:before, button#paypal'.$id.'.ClassyPaypal-style-three:after, button#paypal'.$id.'.ClassyPaypal-style-default:hover, button#paypal'.$id.'.ClassyPaypal-style-three:hover {background:'.$color.';}
    </style>
    
    <button id="paypal'.$id.'" class="ClassyPaypal-button"
        data-business="'.$email.'" 
        data-item_name="'.$product.'"
        data-amount="'.$price.'" 
        data-quantity="'.$quantity.'"
        data-currency_code="'.$currency.'">'.$text.'</button>

   
    ';
}   
add_shortcode('paypal', 'beautiful_paypal_buttons_shortcode');


function beautiful_paypal_mce_btn_css() {
	wp_enqueue_style('mce-n-btn-tc', plugins_url('/css/mce-style.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'beautiful_paypal_mce_btn_css' );



// Hooks your functions into the correct filters
function beautiful_paypal_mce_btn() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'we_beautiful_bvtn_plugin' );
		add_filter( 'mce_buttons', 'we_beautiful_mce_btn' );
	}
}
add_action('admin_head', 'beautiful_paypal_mce_btn');


// Declare script for new button
function we_beautiful_bvtn_plugin( $plugin_array ) {
	$plugin_array['we_paypal_mce_button'] = plugin_dir_url( __FILE__ ) .'/js/mce-button.js';
	return $plugin_array;
}

// Register new button in the editor
function we_beautiful_mce_btn( $buttons ) {
	array_push( $buttons, 'we_paypal_mce_button' );
	return $buttons;
}
