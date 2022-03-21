<?php include_once './view/assets/header.php'; ?>

<div class="main-content login">
    <h2>Login</h2>

    <!-- TODO: add styles -->
    <div class="login-form">
        <form action="" method="post">
            <input type="text" placeholder="Enter login" name="login" require><br>
            <input type="password" placeholder="Enter password" name="pass" require><br>

            <input type="submit" value="Login">
        </form>

        <?php

        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
            // TODO: controller method login
            // <?php $this->login()

            $con = mysqli_connect('localhost', 'root', '', 'forum');

            $login = $_POST['login'];
            $pass = hash('sha512', $_POST['pass']);

            $login_query = "SELECT * FROM `users` WHERE `nick` = '$login' AND `haslo` = '$pass';";

            $res = mysqli_query($con, $login_query);

            if (mysqli_fetch_array($res)) {

                $_SESSION['login'] = $login;

                mysqli_close($con);

                header('location: 2pM/forum_study/');
            } else {
                echo 'Zly login lub haslo';
            }

            mysqli_close($con);
        }
        ?>
    </div>
</div>

<?php include_once './view/assets/footer.php'; ?>