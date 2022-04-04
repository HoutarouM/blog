<?php include_once './view/assets/header.php'; ?>

<div class="main-content form">

    <h2>Add Discussion</h2>

    <form action="" method="post">
        <input type="hidden" name="author_id" value="<?= $this->getAutourId($_SESSION['login'])[0] ?>">

        <input type="text" name="title" placeholder="Discussion title">

        <p>Category:</p>
        <select name="category">
            <?php
            $categories = $this->getCategories();

            if (!$categories) : ?>
                <option value="0">No categories</option>
            <?php else : ?>
                <option value="0">Chose category</option>

                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category[0] ?>"><?= $category[1] ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <textarea name="post_text" id="post_text" placeholder="Post text..." cols="30" rows="10" required></textarea>

        <input type="submit" value="Add post">
    </form>

    <?php
    // execute controller addPost method
    // check is input is not empty

    if (!empty($_POST['author_id']) && !empty($_POST['title']) && !empty($_POST['post_text'])) {

        // check is category is chosen
        if (!empty($_POST['category'])) {
            $this->addDiscussion($_POST['category'], $_POST['author_id'], $_POST['title'], $_POST['post_text']);

            header('Location: index.php');
        } else {
            echo 'Chose category';
        }
    }
    ?>

    <script>
        // inputs validation

        let post_text = document.getElementById('post_text');

        post_text.onsubmit = () => {
            post_text.oninvalid = (e) => {
                e.target.setCustomValidity(post_text.title);
            }
        }
    </script>
</div>

</div>

<?php include_once './view/assets/footer.php'; ?>