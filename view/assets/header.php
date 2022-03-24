<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title><?= WEBSITE_TITLE ?></title>
    <link rel="stylesheet" type="text/css" href="./view/styles/main.css">
</head>

<body>
    <header>
        <!-- TODO: change font-family for logo -->
        <a href="/php/forum_study/">
            <div class="site-logo">
                <h1>『My Forum』</h1>
            </div>
        </a>

        <div class="header-links">
            <ul>
                <?php if (!$_SESSION['login']) : ?>
                    <!-- if user not logged view login and register buttons  -->
                    <li><a href="login">Login</a></li>
                    <li><a href="register">Register</a></li>

                <?php else : ?>
                    <!-- if user logged in view user name button and log out button -->
                    <li><a href="login"><?= $_SESSION['login'] ?></a></li>
                    <li><a href="register">Log out</a></li>

                <?php endif; ?>
            </ul>
        </div>
    </header>

    <main>