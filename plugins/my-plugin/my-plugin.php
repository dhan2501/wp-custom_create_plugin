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
    $q = "CREATE TABLE IF NOT EXISTS `$wp_emp` (`id` INT(10) NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `email` VARCHAR(100) NOT NULL , `phone` VARCHAR(50) NOT NULL , `status` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
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


// Create shortcode using php


// function my_shortcode($atts){
//     // $atts = array_change_key_case($atts, CASE_LOWER);
//     $atts = array_change_key_case((array) $atts, CASE_LOWER);
//     $atts = shortcode_atts(array(
//         'type' => 'img_gallery',
//         // 'note' => 'default'

//     ), $atts);

    // ob_start();
    ?>
    <!-- <h1>Youtube</h1> -->
    <?php
    // $html = ob_get_clean();

    // return 'Result: '. $atts['msg'];
    // return $html;
    // include 'slider.php';
    // include $atts['type'].'.php';
// }
// add_shortcode('my-sc','my_shortcode');

function my_custom_scripts(){
$path_js = plugins_url('js/main.js', __FILE__);
$path_style = plugins_url('css/style.css', __FILE__);
$dep = array('jquery');
$ver = filemtime(plugin_dir_path(__FILE__).'js/main.js');
$ver_style = filemtime(plugin_dir_path(__FILE__).'css/style.css');
$is_login = is_user_logged_in() ? 1 : 0;

//style enqueue
wp_enqueue_style('my-custom-style', $path_style, '', $ver_style);

//script includes
wp_enqueue_script('my-custom-js', $path_js, $dep, $ver, true); //dependencies
wp_add_inline_script('my-custom-js', 'var is_login = '.$is_login.';','before');

// if(is_page('home')){
//     wp_enqueue_script('my-custom-js', $path_js, $dep, $ver, true); //dependencies
// }
}
add_action('wp_enqueue_scripts','my_custom_scripts');
add_action('admin_enqueue_scripts','my_custom_scripts');


//create shortcode
function my_custom_shortcode()
{
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';
    $q = "SELECT * FROM `$wp_emp`";
    $results = $wpdb->get_results($q);

    // print_r($result);
    ob_start();
?>
<table>
    <thead>
    <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Email</td>
        <td>Phone</td>
    </tr>
</thead>
<tbody>
    <?php
    foreach($results as $row){
    ?>
    <tr>
        <td><?php echo $row->id; ?></td>
        <td><?php echo $row->name; ?></td>
        <td><?php echo $row->email; ?></td>
        <td><?php echo $row->phone; ?></td>
    </tr>
    <?php
    }
?>
</tbody>
</table>
<?php
    $html = ob_get_clean();
    return $html;

}
add_shortcode('my-sc', 'my_custom_shortcode');


// Get Post data using shortcode

function my_posts(){
    $args = array(
        'post_type' => 'post'
    );
    $query = new WP_Query($args);
    ob_start();
    if($query->have_posts()):
    ?>
    <ul>
        <?php
            while($query->have_posts()){
                $query->the_post();
                echo '<li>'.get_the_title().'->'.get_the_content().'</li>';
            }
        ?>
        
    </ul>
    <?php
           
    endif;
    wp_reset_postdata();
    $html = ob_get_clean();
    return $html;

}
add_shortcode('my-post','my_posts');

