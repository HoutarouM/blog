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
            $this->login($_POST['login'], $_POST['pass']);
        }
        ?>
    </div>
</div>

<?php include_once './view/assets/footer.php'; ?>