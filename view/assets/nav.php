<div class="nav">
    <form action="" method="post">
        <p>Sort by:</p>
        <select name="sortCategory">
            <option value="0">Chose category</option>
            <option value="time">Time creation</option>
            <option value="likes">Likes</option>
        </select>
        <p>Time created:</p>
        <select name="sortTimeCreated">
            <option value="0">Chose time created</option>
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
        </select>

        <input type="submit" value="sort">
    </form>

    <?php
    if (isset($_POST['sortCategory']) && isset($_POST['sortTimeCreated'])) {
        $sortCategory = $_POST['sortCategory'];
        $sortTimeCreated = $_POST['sortTimeCreated'];

        if ($sortCategory != 0 && $sortTimeCreated != 0) {
            $value = 'php/forum_study/posts/' . $sortCategory . '/' . $sortTimeCreated;

            header("Location: /$value");
        } else {
            echo 'Choose all variants';
        }
    }
    ?>
</div>