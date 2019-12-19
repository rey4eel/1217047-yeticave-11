<?php
require_once 'bootstrap.php';

$categories = get_categories($connection);
$lots = get_lots($connection);

$page_content = include_template('main.php', [
    'lots'=> $lots,
    'categories'=> $categories
]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'categories' => $categories,
    'title' => 'Главная Странца',
]);


print($layout_content);


