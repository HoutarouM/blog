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
                    </div>
                    <p><?= $posts_data[$i]['text'] ?></p>
                </div>

            <?php endif; ?>

        <?php endfor; ?>

        <?php if (!array_key_exists('login', $_SESSION)) : ?>
            <!-- TODO: login block -->

        <?php else : ?>
            <div class="add-comment">
                <h3>Add Comment</h3>

                <form action="" method="post">
                    <input type="hidden" name="parent_post_id" value="<?= $parent_post_id ?>">
                    <input type="hidden" name="category_id" value="<?= $category_id ?>">
                    <input type="hidden" name="author_id" value="<?= $this->getAutourId($_SESSION['login'])[0] ?>">

                    <textarea name="text" cols="10" rows="5"></textarea>

                    <input type="submit" value="Add comment">
                </form>

                <?php
                if (
                    !empty($_POST['parent_post_id'])
                    && !empty($_POST['category_id'])
                    && !empty($_POST['author_id'])
                    && !empty($_POST['text'])
                ) {
                    $this->addComment($_POST['parent_post_id'], $_POST['category_id'], $_POST['author_id'], $_POST['text']);
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

</div>