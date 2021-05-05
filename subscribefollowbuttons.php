<?php
/*
Plugin Name: Social Subscribe - Follow Buttons
Plugin URI: https://nazmulrobin.com
Description: Shows youtube subscribe button and total number of subscribers
Version: 1.0.0
Author: Nazmul Hasan Robin
*/

//Exit if accessed directly
if(!defined('ABSPATH')){
    exit;
}

//Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/subscribefollow-scripts.php');

//Load Class
require_once(plugin_dir_path(__FILE__).'/includes/subscribefollow-class.php');

//Register Widget
function nhrrob_sfb_register_sfbuttons(){
    register_widget('NHRROB_SFB_SFButtons_Widget');
}

//Hook in function
add_action('widgets_init', 'nhrrob_sfb_register_sfbuttons');