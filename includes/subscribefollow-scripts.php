<?php 
function nhrrob_sfbuttons_add_scripts(){
    //Add Google Platform Script
    wp_register_script('google-platform-js', 'https://apis.google.com/js/platform.js');
    wp_enqueue_script('google-platform-js');
}

add_action('wp_enqueue_scripts', 'nhrrob_sfbuttons_add_scripts'); 