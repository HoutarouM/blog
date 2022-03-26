<?php include_once './view/assets/header.php'; ?>

<div class="main-content form">
    <!-- TODO: add styles -->

    <h2>Add Discussion</h2>
    <p>Autor: <?= $_SESSION['login'] ?></p>

    <form action="" method="post">
        <input type="hidden" name="author_name" value="<?= $_SESSION['login'] ?>">

        Category: <select name="category">
            <?php
            $categories = $this->getCategories();

            if (!$categories) : ?>
                <option value="">No category</option>
            <?php else : ?>
                <option value="">Chose category</option>

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


    ?>

    <script>
        // inputs validation

        let post_text = document.getElementById('post_text');

        post_text.oninvalid = (e) => {
            e.target.setCustomValidity(post_text.title);
        }
    </script>
</div>

</div>

<?php include_once './view/assets/footer.php'; ?>