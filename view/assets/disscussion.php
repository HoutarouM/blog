<h2>Discussion</h2>

<div class="discussions-and-nav-wrapper">

    <div class="discussions">

        <?php
        $posts_data = $this->getPostsData();

        if (!$posts_data) {
            echo "No posts";
        }

        for ($i = 0; $i < count($posts_data); $i++) : ?>

            <?php if ($i == 0) : ?>

                <h2><?= $posts_data[$i]['tytul'] ?></h2>

                <div class="discussion">
                    <div class="post-data">
                        <p>Author: <?= $this->getAuthorData($posts_data[$i]['id']) ?></p>
                        <p>Likes: <?= $this->getLikesData($posts_data[$i]['id']) ?></p>
                    </div>
                    <p><?= substr($posts_data[$i]['text'], 0, 25) . '...' ?></p>
                </div>

                <?php
                // category id for new comments
                $category_id = $posts_data[$i]['id_kategorii'];

                // parent post id for new comments
                $parent_post_id = $posts_data[$i]['id'];
                ?>

            <?php else : ?>

                <div class="discussion">
                    <div class="post-data">
                        <p>Author: <?= $this->getAuthorData($posts_data[$i]['id']) ?></p>
                        <p>Likes: <?= $this->getLikesData($posts_data[$i]['id']) ?></p>
                        <form action="" method="post">
                            <input type="hidden" name="user" value="<?= $this->getAutourId($_SESSION['login'])[0] ?>">
                            <input type="hidden" name="post_id" value="<?= $posts_data[$i]['id'] ?>">
                            <button type="submit" name="like">👍</button>
                        </form>
                    </div>
                    <p><?= $posts_data[$i]['text'] ?></p>
                </div>

            <?php endif; ?>

        <?php endfor; ?>

        <?php

        if (!empty($_POST['user']) && !empty($_POST['post_id']) && isset($_POST['like'])) {
            $this->likePost($_POST['user'], $_POST['post_id'], $_POST['like']);

            echo "<meta http-equiv='refresh' content='0'>";
        }

        // view comments textarea if logged in
        // or login and register button if not

        if (!array_key_exists('login', $_SESSION)) {
            include_once './view/assets/add_coment.php';
        } else {
            include_once './view/assets/add_coment.php';
        }
        ?>
    </div>

</div>