<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title><?= WEBSITE_TITLE ?></title>

    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH ?>">
</head>

<body>
    <header>
        <a href="index.php">
            <div class="site-logo">
                <h1>『My Forum』</h1>
            </div>
        </a>

        <div class="header-links">
            <ul>
                <?php if (!array_key_exists('login', $_SESSION)) : ?>
                    <!-- if user not logged view login and register buttons  -->

                    <li><a href="login">Login</a></li>
                    <li><a href="register">Register</a></li>
                <?php else : ?>
                    <!-- if user logged in view user name button and log out button -->

                    <li><a href="addpost">Add post</a></li>
                    <li><a href="logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <main>