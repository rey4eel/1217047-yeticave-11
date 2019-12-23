<ul class="pagination-list">
    <li class="pagination-item pagination-item-prev">
        <?php ($cur_page === 1) ? $class_hide = 'visually-hidden'
            : $class_hide = ''; ?>
        <a <?= "class='$class_hide'"; ?>
            href="<?= $_SERVER['PHP_SELF'] ?>?<?= $param; ?>&page=<?= $cur_page
            - 1; ?>">Назад</a></li>
    <?php foreach ($pages as $page): ; ?>
        <?php ($page === $cur_page) ?
            $class_active = 'pagination-item-active'
            : $class_active = ''; ?>
        <li class="pagination-item <?= $class_active; ?>">
            <?php if ($class_active === ''): ?>
                <a href="<?= $_SERVER['PHP_SELF'] ?>?<?= $param; ?>&page=<?= $page; ?>"><?= $page; ?></a>
            <?php else: ?>
                <a><?= $page; ?></a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    <li class="pagination-item pagination-item-next">
        <?php ($cur_page === count($pages)) ? $class_hide = 'visually-hidden'
            : $class_hide = ''; ?>
        <a <?= "class='$class_hide'"; ?>
            href="<?= $_SERVER['PHP_SELF'] ?>?<?= $param; ?>&page=<?= $cur_page
            + 1; ?>">Вперед</a>
    </li>
</ul>
