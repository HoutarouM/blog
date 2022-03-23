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

            if ($_POST['pass'] != $_POST['r_pass']) {
                exit();
            }

            if (!$this->register($_POST['login'], $_POST['email'], $_POST['pass'])) {
                echo "Nick jest zajety";
            }

            // header('location: 2pM/forum_study/');
        }
        ?>
    </div>
</div>

<?php include_once './view/assets/footer.php'; ?>