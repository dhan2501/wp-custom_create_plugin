<?php
if (!defined('ABSPATH')){
    header("Location: /plugindevelop");
    die();
}


if(isset($_REQUEST['update'])){
    $user_id = esc_sql($_POST['user_id']);
    $fname = esc_sql($_POST['user_fname']);
    $lname = esc_sql($_POST['user_lname']);
    if($_FILES['user_img']['error'] == 0){
        $file = $_FILES['user_img'];
        $ext = explode('/', $file['type'])[1];
        $file_name = "$user_id.$ext"; //5.png
        $image = wp_upload_bits($file_name, null, file_get_contents($file['tmp_name']));
        // print_r($image);

        if(!metadata_exists('user', $user_id, 'user_profile_img_url')){
            add_user_meta($user_id, 'user_profile_img_url', $image['url']);
            add_user_meta($user_id, 'user_profile_img_path', esc_sql($image['file']));
        
        }else{

        update_user_meta($user_id, 'user_profile_img_url', $image['url']);
        update_user_meta($user_id, 'user_profile_img_path', esc_sql($image['file']));

        }
    }
    $userdata = array(
        'ID' => $user_id,
        'first_name' => $fname,
        'last_name' => $lname
    );
    $user = wp_update_user($userdata);
    if(is_wp_error($user)){
        echo 'can not update: '.$user->get_error_message();
    }
}


$user_id = get_current_user_id();
$user = get_userdata($user_id);
if($user != false):
    // echo '<pre>';
    // print_r($user);
    // echo '</pre>';
    // echo get_usermeta($user_id);
    // echo wp_logout_url();
    $user_type = get_usermeta($user_id, 'type');
    $fname = get_usermeta($user_id, 'first_name');
    $lname = get_usermeta($user_id, 'last_name');
    $profile_img = get_usermeta($user_id, 'user_profile_img_url');
    // echo $profile_img = get_usermeta($user_id, 'user_profile_img_path');


if($profile_img != ''){
    echo "<img src='$profile_img' width='200'>";
} 
?>

<!-- <h1>Hello <?//= get_current_user_id();  ?></h1> -->
<h1>Hi <?php echo "$fname $lname <small>($user_type)</small>";  ?></h1>
<p>Not <?php echo "$fname $lname"; ?> <a href="<?= wp_logout_url() ?>">Logout</a> </p>
<form action="<?= get_the_permalink(); ?>" method="POST" enctype="multipart/form-data">
    Profile Image : <input type="file" name="user_img" id="user-img"><br/>
    First Name : <input type="text" name="user_fname" id="user-fname" value="<?= $fname; ?>"><br/>
    Last Name: <input type="text" name="user_lname" id="user-lname" value="<?= $lname; ?>"><br/>
    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
    <input type="submit" name="update" id="update" value="Update">

</form>
<?php
endif;
