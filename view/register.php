<?php include_once './view/assets/header.php'; ?>

<div class="main-content form">
    <h2>Register</h2>

    <div class="register-form">

        <form action="" method="post">
            <input type="text" placeholder="Enter login" name="login" require>
            <input type="text" placeholder="Enter email" name="email" require>
            <input type="password" placeholder="Enter password" name="pass" require>
            <input type="password" placeholder="Repeate password" name="r_pass" require>

            <input type="submit" value="Register">
        </form>

        <?php
        // TODO: rewrite to mvc

        if (
            !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['pass'])
            && !empty($_POST['r_pass'])
        ) {
            $con = mysqli_connect('localhost', 'root', '', 'forum');

            if ($_POST['pass'] != $_POST['pass']) {
                exit();
            }

            $login = $_POST['login'];
            $email = $_POST['email'];

            $pass = $_POST['pass'];
            $pass = hash('sha512', $pass);

            $chech_login_query = "SELECT * FROM `users` WHERE `nick` = $login";

            $res = mysqli_query($con, $chech_login_query);

            if (mysqli_fetch_array($res)) {
                echo "Nick jest zajety";

                exit();
            }

            $add_user_query = "INSERT INTO `users`(`id`, `email`, `haslo`, `nick`) VALUES (null, '$email', '$pass', '$login');";

            mysqli_query($con, $add_user_query);

            mysqli_close($con);

            header('location: index.php');
        }
        ?>
    </div>
</div>

<?php include_once './view/assets/footer.php'; ?>