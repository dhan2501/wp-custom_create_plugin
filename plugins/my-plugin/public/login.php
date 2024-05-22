<div class="login-form">
        <form action="<?= get_the_permalink(); ?>" method="POST">
            Username : <input type="text" name="username" id="login-username"><br/>
            Password : <input type="password" name="pass" id="login-pass"><br/>
            <input type="submit" name="user-login" value="login">
        </form>
    </div>