<?php
require_once 'bootstrap.php';
use Respect\Validation\Validator as v;
$search = $_GET['search'];
$validation = v::alnum()->validate($search);
$categories = get_categories($connection);

$cur_page = $_GET['page'] ?? 1;
$item_per_page = 6;
$lots_count = get_search_lots_count($connection, $search);

if (is_int($lots_count)) {
    $pages_count = intval(ceil($lots_count / $item_per_page));
    $offset = ($cur_page - 1) * $item_per_page;
    $pages = range(1, $pages_count);
    $search_data = get_search_data($connection, $search,
        $item_per_page, $offset);
    $page_content = include_template('search.php', [
        'categories' => $categories,
        'pages'      => $pages,
        'cur_page'   => $cur_page,
        'search_data' => $search_data,
        'search' => $search
    ]);
} else {
    $page_content = include_template('search.php', [
        'categories' => $categories,
        'pages'      => [],
        'search_data' => null,
        'search' => $search,
        'error'      => $lots_count
    ]);
}



print($page_content);
