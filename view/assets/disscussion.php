<h2>Discussion</h2>

<div class="discussions-and-nav-wrapper">

    <div class="discussions">

        <?php
        // get posts data
        $posts_data = $this->getPostsData();

        // if post data not empty show posts
        // else show no posts message
        if (!empty($posts_data)) {

            for ($i = 0; $i < count($posts_data); $i++) : ?>

                <!-- Discussion topic -->
                <?php if ($i == 0) : ?>
                    <h2><?= $posts_data[$i]['tytul'] ?></h2>

                    <?php
                    // category id for new comments
                    $category_id = $posts_data[$i]['id_kategorii'];

                    // parent post id for new comments
                    $parent_post_id = $posts_data[$i]['id_posta'];
                    ?>
                <?php endif; ?>

                <div class="discussion">
                    <div class="post-data">
                        <p>Author: <?= $this->getAuthorData($posts_data[$i]['id_posta']) ?></p>
                        <p>Likes: <?= $this->getLikesData($posts_data[$i]['id_posta']) ?></p>

                        <!-- only for signed users -->
                        <?php if (array_key_exists('login', $_SESSION)) : ?>

                            <!-- like post -->
                            <form action="" method="post">
                                <input type="hidden" name="user" value="<?= $this->getAutourId($_SESSION['login'])[0] ?>">
                                <input type="hidden" name="post_id" value="<?= $posts_data[$i]['id_posta'] ?>">
                                <button type="submit" name="like">👍</button>
                            </form>

                            <!-- delete post only for creator -->
                            <?php if ($_SESSION['login'] == $this->getAuthorData($posts_data[$i]['id_posta'])) : ?>

                                <form action="" method="post">
                                    <input type="hidden" name="post_id" value="<?= $posts_data[$i]['id_posta'] ?>">
                                    <button type="submit" name="del">🗑</button>
                                </form>

                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                    <p><?= $posts_data[$i]['text'] ?></p>
                </div>
            <?php endfor; ?>

        <?php
        } else {
            echo "No posts";
        }

        // like post
        if (!empty($_POST['user']) && !empty($_POST['post_id']) && isset($_POST['like'])) {
            $this->likePost($_POST['user'], $_POST['post_id'], $_POST['like']);

            echo "<meta http-equiv='refresh' content='0'>";
        }

        // delete post
        if (!empty($_POST['post_id']) && isset($_POST['del'])) {
            $this->delPost($_POST['post_id']);

            if (count($posts_data) > 1) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                header("Location: " . BASE_URL);
            }
        }

        // view comments textarea if logged in
        // or login and register button if not
        if (!array_key_exists('login', $_SESSION)) {
            include_once '../view/assets/login_pls.php';
        } else {
            include_once '../view/assets/add_comment.php';
        }
        ?>
    </div>

</div>