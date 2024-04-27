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
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';
    $q = "CREATE TABLE IF NOT EXISTS `$wp_emp` (`id` INT(10) NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `email` VARCHAR(100) NOT NULL , `status` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    $wpdb->query($q);

    // $q = "INSERT INTO `$wp_emp` (`name`, `email`, `status`) VALUES ('Dhananjay', 'dhananjay@gmail.com', 1)";
    // $wpdb->query($q);
    $data = array(
        'name' => 'Akshay',
        'email' => 'aksha@gmail.com',
        'status' => 1
    );

    $wpdb->insert($wp_emp, $data);
}
register_activation_hook(__FILE__, 'my_plugin_activation');

function my_plugin_deactivation(){
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';

    // $q = "DROP TABLE `$wp_emp`";
    $q = "TRUNCATE TABLE `$wp_emp`";
    $wpdb->query($q);

}
register_deactivation_hook(__FILE__, 'my_plugin_deactivation');

function my_sc_fun(){
    return 'Function call';
}
add_shortcode('my-sc','my_sc_fun');

