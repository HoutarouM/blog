<h2>Discussion</h2>

<div class="discussions-and-nav-wrapper">

    <div class="discussions">

        <?php $posts_data = $this->getPostsData();

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

            <?php else : ?>

                <div class="discussion">
                    <div class="post-data">
                        <p>Author: <?= $this->getAuthorData($posts_data[$i]['id']) ?></p>
                        <p>Likes: <?= $this->getLikesData($posts_data[$i]['id']) ?></p>
                    </div>
                    <p><?= substr($posts_data[$i]['text'], 0, 25) . '...' ?></p>
                </div>

            <?php endif; ?>

        <?php endfor; ?>

        <div class="add-comment">
            <h3>Add Comment</h3>

            <form action="" method="post">
                <textarea name="comment-text" cols="10" rows="5"></textarea>

                <input type="submit" value="Add comment">
            </form>

            <?php

            ?>
        </div>
    </div>

</div>