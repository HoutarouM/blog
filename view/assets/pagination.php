<div class="pagination">
    <ul>
        <?php
        $pages_count = ceil($this->getPageCount() / 5);

        // print_r($_GET['url']);

        if (count($_GET['url']) == 1) {
            $url = BASE_URL . '/posts/';
        } else if (count($_GET['url']) == 3) {
            $url = BASE_URL . '/post/' . $_GET['url'][1] . '/';
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