<?php include_once './view/assets/header.php'; ?>

<div class="main-content form">
    <h2>Register</h2>

    <div class="register-form">

        <form action="" method="post">
            <input type="text" name="login" id="login" placeholder="Enter login" pattern="\d[A-Z][a-z]{,15}" title="Login size is 15 symbols max only lowercase or uppercase a-z and." require>
            <input type="email" name="email" id="email" placeholder="Enter email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Must be in the following order: characters@characters.domain." require>
            <input type="password" name="pass" id="pass" placeholder="Enter password" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters." require>
            <input type="password" name="r_pass" id="r_pass" placeholder="Repeat password" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters." require>

            <input type="submit" value="Register">
        </form>

        <?php
        // checking is password input value same to repeat password value
        // execute register method
        // if user name is not used already register user and redirect to main page
        // else view message

        if (
            !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['pass'])
            && !empty($_POST['r_pass'])
        ) {

            if ($this->register($_POST['login'], $_POST['email'], $_POST['pass'], $_POST['r_pass'])) {
                header('location: index.php');
            } else {
                echo "Nick is already used.";
            }
        }
        ?>

        <script>
            // inputs validation

            let login = document.getElementById('login');
            let email = document.getElementById('email');
            let pass = document.getElementById('pass');
            let r_pass = document.getElementById('pass');

            login.oninvalid = (e) => {
                e.target.setCustomValidity(login.title);
            }

            email.oninvalid = (e) => {
                e.target.setCustomValidity(email.title);
            }

            pass.oninvalid = (e) => {
                e.target.setCustomValidity(pass.title);
            }

            r_pass.oninvalid = (e) => {
                e.target.setCustomValidity(r_pass.title);
            }
        </script>
    </div>

</div>

<?php include_once './view/assets/footer.php'; ?>