<?php
require_once 'bootstrap.php';
$categories = get_categories($connection);
$layout_content = include_template('404.php', [
    'categories' => $categories,
]);
print($layout_content);
