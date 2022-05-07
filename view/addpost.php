<?php include_once '../view/assets/header.php'; ?>

<div class="main-content form">

    <h2>Add Discussion</h2>

    <form action="" method="post" enctype="multipart/form-data">
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

                    <input type="file" name="file[]" id="file" class="btn inputfile" data-element="img" accept="image/png, image/jpeg" multiple>
                    <label for="file">img</label>
                </div>

            </div>

            <!-- Textarea -->
            <textarea name="post_text" id="content" cols="70" rows="20" placeholder="Post text..." required></textarea>
        </div>

        <input type="submit" value="Add post">
    </form>

    <?php
    // execute controller addPost method
    // check is input is not empty

    if (!empty($_POST['author_id']) && !empty($_POST['title']) && !empty($_POST['post_text'])) {

        // check is category is chosen
        if (!empty($_POST['category'])) {
            // if files chosen, add files path to database
            if (!empty($_FILES['file'])) {
                $file_paths = [];

                // add file path to array
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                    $file_path = '/imgs/' . $_FILES['file']['name'][$i];

                    array_push($file_paths, $file_path);
                }

                $this->addDiscussion($_POST['category'], $_POST['author_id'], $_POST['title'], $_POST['post_text'], $file_paths);
            } else {
                $this->addDiscussion($_POST['category'], $_POST['author_id'], $_POST['title'], $_POST['post_text']);
            }

            // header('Location: ' . BASE_URL);
        } else {
            echo 'Chose category';
        }
    }
    ?>

    <script>
        // inputs validation

        let post_text = document.getElementById('post_text');

        if (post_text !== null) {
            post_text.onsubmit = () => {
                post_text.oninvalid = (e) => {
                    e.target.setCustomValidity(post_text.title);
                }
            }
        }
    </script>
</div>

</div>

<?php include_once '../view/assets/footer.php'; ?>