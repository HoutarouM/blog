<?php include_once './view/assets/header.php'; ?>

<div class="main-content">
    <?php if (empty($this->data)) {
        include_once './view/assets/discussions.php';
    } else {
        include_once './view/assets/disscussion.php';
    }
    ?>
</div>

<?php include_once './view/assets/footer.php'; ?>