<?php include_once './view/assets/header.php'; ?>

<div class="main-content form">
    <div class="login-form">
        <h2>Login</h2>

        <form action="" method="post">
            <input type="text" name="login" id="login" placeholder="Enter login" required>
            <input type="password" name="pass" id="pass" placeholder="Enter password" require>

            <input type="submit" value="Login">
        </form>

        <?php
        // execute controller login method

        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
            filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS);

            $this->login($_POST['login'], $_POST['pass']);
        }
        ?>
    </div>

</div>

<?php include_once './view/assets/footer.php'; ?>