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
    header("Location: /plugindevelop");
    die();
}

// add_action('wp_head', 'addHeaderCode');

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
// wp_add_inline_script('my-custom-js', 'var is_login = '.$is_login.';','before');
wp_add_inline_script('my-custom-js', 'var ajaxUrl = "'.admin_url('admin-ajax.php').'";','before');

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
        'post_type' => 'post',
        'posts_per_page' => 3,
        'offset' => 0,
        'orderby' => 'ID',
        'order' => 'ASC',
        'meta_key' => 'views',
        'meta_value' => '3',
        'meta_compare' => '>='
        // 'tag' => 'river' 
        // 'tax_query' => array(
        //     'relation' => 'AND', //OR
        //     array(
        //     'taxnomoy' => 'category', //post group ko  taxnomoy kehte hai.
        //     'field' => 'slug',
        //     'terms' => array('flat'),
        //     'operator' =>'NOT IN'
        //     ),
        //     array(
        //         'taxonomy' => 'category',
        //         'field' => 'slug',
        //         'terms' => array('plot') 
        //     )
        // ) 
    );
    $query = new WP_Query($args);
    ob_start();
    if($query->have_posts()):
    ?>
    <ul>
        <?php
            while($query->have_posts()){
                $query->the_post();
                echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</>('.get_post_meta(get_the_ID(), 'views', true).') ->'.get_the_content().'</li>';
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


function head_fun(){
    if(is_single()){
        global $post;
        $views = get_post_meta($post->ID, 'views', true);
        if($views == ''){
            add_post_meta($post->ID, 'views', 1);

        }else{
            $views++;
            update_post_meta($post->ID, 'views', $views);
        }

        echo get_post_meta($post->ID, 'views', true);
    }
}
add_action('wp_head', 'head_fun');


function views_count(){
    global $post;
    return 'Total Views: '.get_post_meta($post->ID, 'views', true);
}
add_shortcode('views-count', 'views_count');


function my_plugin_page_func(){
    // echo 'Hi';
    include 'admin/main-page.php';
}

function my_plugin_subpage_func(){
    echo 'This is sub menu page';
}

function my_plugin_menu(){
    add_menu_page('My plugin Page', 'My plugin Page', 'manage_options','my-plugin-page'
    , 'my_plugin_page_func', '',6);

    add_submenu_page('my-plugin-page', 'All Emp', 'All Emp', 'manage_options',
     'my-plugin-page', 'my_plugin_page_func');

    add_submenu_page('my-plugin-page', 'My Plugin Sub page', 'My Plugin sub Page', 'manage_options','my-plugin-subpage','my_plugin_subpage_func');

}
add_action('admin_menu', 'my_plugin_menu');

add_action('wp_ajax_my_search_func','my_search_func');
add_action('wp_ajax_nopriv_my_search_func','my_search_func');

function my_search_func(){
    global $wpdb,$table_prefix;
    $wp_emp = $table_prefix.'emp';
    // print_r($wp_emp);
    $search_term = $_POST['search_term'];
    if(!empty('search_term')){
        $q = "SELECT * FROM `$wp_emp` WHERE `name` LIKE '%".$search_term."%' OR `email` LIKE '%".$search_term."%' OR `phone` LIKE '%".$search_term."%';";
    }else{
        $q = "SELECT * FROM `$wp_emp`";
    }
    $results = $wpdb->get_results($q);
    // echo '<pre>';
    // print_r($results);
    // echo '</pre>';
    // echo $search_term;
    ob_start();
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

    echo ob_get_clean();
    wp_die();
}

add_shortcode('my-data', 'my_table_data');
function my_table_data(){
    ob_start();
    include 'admin/main-page.php';
    return ob_get_clean();
}

// Create custom Create Post
function register_my_cpt(){
    $labels = array(
        'name' => 'Cars',
        'Singular_name' => 'Car',        
    );
    $supports = array('title','editor','comments','thumbnail','excerpt');
    $options = array(
        'labels' => $labels,
        'public' => true,
        
        'supports' => $supports,
        'has_archive' => true,
        'rewrite' => array('slug' => 'cars'),
        'show_in_rest' =>true,
        // 'taxonomies' => array('category'),
        'taxonomies' => array('car_types'),
        'publicly_queryable' => true
    );
    register_post_type('car', $options);
}
add_action('init', 'register_my_cpt');

function register_car_types(){
    $labels = array(
        'name' => 'Car Type',
        'singular_name' => 'Car Types'
    );
    $options = array(
        'labels' => $labels,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'car-type'),
        'show_in_rest' =>true,
    );
    register_taxonomy('car-type', array('car'), $options);
}
add_action('init','register_car_types');


// include registeration page
function register_users(){
    ob_start();
    include 'public/register.php';
    return ob_get_clean();
}
add_shortcode('register-user','register_users');



// Custom Login code 

function my_login(){
    if(isset($_REQUEST['user-login'])){
        $username = esc_sql($_POST['username']);
        $pass = esc_sql($_POST['pass']);
        $credentials = array(
            'user_login' => $username,
            'user_password' => $pass,
        );
        $user = wp_signon($credentials);
        if(!is_wp_error($user)){
            // echo 'Success Login';
            // echo '<pre>';
            // print_r($user);
            // echo '</pre>';
            if($user->roles[0] == 'administrator'){
                wp_redirect(admin_url());
                exit;
            }else{
                wp_redirect(site_url('profile'));
                exit;
            }
        }else{
            echo $user->get_error_message();
        }
    }
}
add_action('template_redirect', 'my_login');

function my_login_form(){
    ob_start();
    include 'public/login.php';
    return ob_get_clean();
}
add_shortcode('my-login-form', 'my_login_form');

function my_profile(){
    ob_start();
    include 'public/profile.php';
    return ob_get_clean();
}
add_shortcode('my-profile', 'my_profile');


function my_check_redirect(){
    $is_user_logged_in = is_user_logged_in();
    if($is_user_logged_in && (is_page('login') || is_page('register'))){
        wp_redirect(site_url('profile'));
        exit;
    }elseif(!$is_user_logged_in && is_page('profile')){
        wp_redirect(site_url('login'));
        exit;
    }
}

add_action('template_redirect','my_check_redirect');

function redirect_after_logout(){
    wp_redirect(site_url('login'));
    exit;
}
add_action('wp_logout', 'redirect_after_logout');