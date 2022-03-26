<?php include_once './view/assets/header.php'; ?>

<div class="main-content form">
    <div class="login-form">
        <h2>Login</h2>

        <form action="" method="post">
            <input type="text" name="login" id="login" placeholder="Enter login" pattern="[A-Z][a-z]{,15}" title="Login size is 15 symbols max only lowercase or uppercase a-z and." required>
            <input type="password" name="pass" id="pass" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters." require>

            <input type="submit" value="Login">
        </form>

        <?php
        // execute controller login method

        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
            $this->login($_POST['login'], $_POST['pass']);
        }

        ?>

        <script>
            // inputs validation

            let login = document.getElementById('login');
            let pass = document.getElementById('pass');

            login.oninvalid = (e) => {
                e.target.setCustomValidity(login.title);
            }

            pass.oninvalid = (e) => {
                e.target.setCustomValidity(pass.title);
            }
        </script>
    </div>

</div>

<?php include_once './view/assets/footer.php'; ?>