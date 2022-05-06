<h2>Last Discussions</h2>

<div class="discussions-and-nav-wrapper">

    <div class="discussions">

        <?php $posts_data = $this->getPostsData();

        if ($posts_data) {
            foreach ($posts_data as $post_data) : ?>

                <div class="discussion">

                    <a href="<?= BASE_URL ?>/post/<?= $post_data['id_posta'] ?>/1">
                        <h2><?= $post_data['tytul'] ?></h2>
                    </a>
                    <div class="post-data">
                        <p>Author: <?= $this->getAuthorData($post_data['id_posta']) ?></p>
                        <p>Likes: <?= $this->getLikesData($post_data['id_posta']) ?></p>
                    </div>
                    <p><?= substr(strip_tags($post_data['text']), 0, 25) . '...' ?></p>
                </div>

        <?php endforeach;
        } else {
            echo "No posts";
        }
        ?>
    </div>

    <?php include_once './view/assets/nav.php'; ?>

</div>

<?php include_once './view/assets/pagination.php'; ?>