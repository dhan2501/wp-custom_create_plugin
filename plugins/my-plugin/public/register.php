<?php
if(isset($_POST['register'])){
    global $wpdb;
    $fname = $wpdb->escape($_POST['user_fname']);
    $lname = $wpdb->escape($_POST['user_lname']);
    $username = $wpdb->escape($_POST['username']);
    $email = $wpdb->escape($_POST['user_email']);
    $user_pass = $wpdb->escape($_POST['user_pass']);
    $user_con_pass = $wpdb->escape($_POST['user_con_pass']);

    if($user_pass == $user_con_pass){
        //wp_insert_user()
        //wp_create_user()

        // $result = wp_create_user($username, $user_pass, $email);

        $user_data = array(
            'user_login' => $username,
            'user_email' => $email,
            'first_name' => $fname,
            'last_name' => $lname,
            'display_name' => $fname.' '. $lname,
            'user_pass' => $user_pass,
        );
        $result = wp_insert_user($user_data);

        if(!is_wp_error($result)){
            echo 'User creater ID: '. $result;
            add_user_meta($result, 'type', 'Faculty');
            update_user_meta($result, 'show_admin_bar_front', false); //admin bar hide code
        }else{
            echo $result->get_error_message();
        }



    }else{
        echo 'Password must Matched';
    }
}
?>
<div class="form-wrapper">
    
    <div class="register-form">
        <form action="<?php echo get_the_permalink(); ?>" method="post">
            First Name: <input type="text" name="user_fname" id="user-fname"></br>
            Last Name: <input type="text" name="user_lname" id="user_lname"></br>
            Username: <input type="text" name="username" id="username"></br>
            Email: <input type="email" name="user_email" id="user_email"></br>
            Password: <input type="password" name="user_pass" id="user_pass"></br>
            Confirm Password: <input type="password" name="user_con_pass" id="user_con_pass"></br>
            <input type="submit" class="button" name="register" value="Register">
        </form>
    </div>
</div>