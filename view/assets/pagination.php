<div class="pagination">
    <ul>
        <?php
        $pages_count = ceil($this->getPageCount() / 5);

        for ($i = 1; $i <= $pages_count; $i++) : ?>

            <li>
                <a href="<?= BASE_URL ?>/posts/<?= $i ?>" <?= ($this->page == $i) ? 'class="active"' : ''  ?>><?= $i ?></a>
            </li>

        <?php endfor; ?>

    </ul>
</div>