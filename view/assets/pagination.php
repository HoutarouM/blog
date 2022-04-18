<div class="pagination">
    <ul>
        <?php
        $pages_count = ceil($this->getPageCount() / 5);

        if (count($_GET['url']) < 4) {
            $url = BASE_URL . '/posts/';
        } else {
            array_pop($_GET['url']);

            $url = BASE_URL . '/' . implode('/', $_GET['url']) . '/';
        }

        for ($i = 1; $i <= $pages_count; $i++) : ?>

            <li>
                <a href="<?= $url . $i ?>" <?= ($this->getPage() == $i) ? 'class="active"' : ''  ?>><?= $i ?>
                </a>
            </li>

        <?php endfor; ?>

    </ul>
</div>