<div class="nav">
    <form action="" method="get">
        <p>Category:</p>
        <select name="sortCategory">
            <option value="0">Chose category</option>

            <?php $categories = $this->getCategories();
            foreach ($categories as $category) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['kategoria'] ?></option>
            <?php endforeach; ?>
        </select>
        <p>Time created:</p>
        <select name="sortTimeCreated">
            <option value="0">Chose time created</option>
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
        </select>

        <input type="submit" value="sort">
    </form>
</div>