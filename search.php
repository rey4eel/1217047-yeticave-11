<?php
require_once 'bootstrap.php';

$search = trim($_GET['search']) ?? '';
$categories = get_categories($connection);

if (empty($search))
{
    $page_content = include_template('404.php', [
        'categories' => $categories,
    ]);
}
else {
    $cur_page = $_GET['page'] ?? 1;
    $item_per_page = 3;
    $lots_count = get_search_lots_count($connection, $search);

    if(is_int($lots_count)){
        $pages_count = intval(ceil($lots_count/$item_per_page));
        $offset = ($cur_page - 1)*$item_per_page;
        $pages = range(1, $pages_count);
        $search_data = get_search_data($connection, $search, $item_per_page, $offset);
        $page_content = include_template('search.php', [
            'categories' => $categories,
            'pages' => $pages,
            'cur_page' => $cur_page,
            'search_data' => $search_data,
            'search' => $search
        ]);
    } else {
        $page_content = include_template('search.php', [
            'categories' => $categories,
            'pages' => [],
            'search_data' => null,
            'search' => $search,
            'error' => $lots_count
        ]);
    }
}


print($page_content);
