<?php

/*
Plugin Name: my-plugin
Plugin URI: 
Description: Demo plugin for learing about the plugin information comment.
Version: 1.0.0
Contributors: Dhananjay
Author: Dhananjay Gupta
Author URI: www.google.com
License: GPLv2 or later
License URI: 
Text Domain: wpplugin
Domain Path: /languages
*/

// If this file is called directly, abort.
if (!defined('ABSPATH')){
    die("");
}


function my_plugin_activation(){

}
register_activation_hook(__FILE__, 'my_plugin_activation');
function my_plugin_deactivation(){


}
register_deactivation_hook(__FILE__, 'my_plugin_deactivation');

function my_sc_fun(){
    return 'Function call';
}
add_shortcode('my-sc','my_sc_fun');

