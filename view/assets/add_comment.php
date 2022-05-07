<div class="add-comment">
    <h3>Add Comment</h3>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="parent_post_id" value="<?= $parent_post_id ?>">
        <input type="hidden" name="category_id" value="<?= $category_id ?>">
        <input type="hidden" name="author_id" value="<?= $this->getAutourId($_SESSION['login'])[0] ?>">

        <div class="text-editor">

            <!-- Menu buttons -->
            <div class="text-editor-header">
                <div class="text-editor-text-style">
                    <button type="button" class="btn" data-element="strong">
                        <strong>B</strong>
                    </button>

                    <button type="button" type="butuon" class="btn" data-element="italic">
                        <strong>
                            <em>I</em>
                        </strong>
                    </button>

                    <button type="button" class="btn" data-element="underline">
                        <strong>
                            <em>U</em>
                        </strong>
                    </button>
                </div>

                <select class="font-size">
                    <option value="12px">12px</option>
                    <option value="24px">24px</option>
                    <option value="48px">48px</option>
                </select>

                <div class="text-editor-add-obj">
                    <button type="button" class="btn" data-element="ul">
                        <strong>
                            <em>•</em>
                        </strong>
                    </button>

                    <button type="button" class="btn" data-element="ol">
                        <strong>
                            <em>1</em>
                        </strong>
                    </button>

                    <input type="file" name="file" id="file" class="btn inputfile" data-element="img" accept="image/png, image/jpeg">
                    <label for="file">img</label>
                </div>

            </div>

            <!-- Textarea -->
            <textarea name="text" id="content" cols="70" rows="20" placeholder="Post text..." required></textarea>
        </div>

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