<div class="add-comment">
    <h3>Add Comment</h3>

    <form action="" method="post">
        <input type="hidden" name="parent_post_id" value="<?= $parent_post_id ?>">
        <input type="hidden" name="category_id" value="<?= $category_id ?>">
        <input type="hidden" name="author_id" value="<?= $this->getAutourId($_SESSION['login'])[0] ?>">

        <textarea name="text" cols="10" rows="5" placeholder="Post text..." required></textarea>

        <input type="submit" value="Add comment">
    </form>

    <?php
    if (
        !empty($_POST['parent_post_id'])
        && !empty($_POST['category_id'])
        && !empty($_POST['author_id'])
        && !empty($_POST['text'])
    ) {
        filter_var($_POST['parent_post_id'], FILTER_SANITIZE_NUMBER_INT);
        filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
        filter_var($_POST['author_id'], FILTER_SANITIZE_NUMBER_INT);
        filter_var($_POST['text'], FILTER_SANITIZE_SPECIAL_CHARS);

        $this->addComment($_POST['parent_post_id'], $_POST['category_id'], $_POST['author_id'], $_POST['text']);

        // refresh page after submit with no warnings
        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>
</div>