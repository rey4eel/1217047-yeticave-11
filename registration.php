<?php
require_once 'bootstrap.php';

if (isset($_SESSION['user'])) {
    header("Location: 404.php");
    exit();
}

function getPostVal($name)
{
    return $_POST[$name] ?? "";
}

$categories = get_categories($connection);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_data = $_POST;
    $errors = validate_reg_form($connection, $user_data);
    if (count($errors)) {
        $page_content = include_template('registration.php', [
            'categories' => $categories,
            'errors' => $errors
        ]);
    } else {
        $is_user_added = add_user($connection, $user_data);
        if ($is_user_added) {
            header("Location: index.php");
            exit();
        }
    }
}

$page_content = include_template('registration.php', [
    'categories' => $categories,
    'errors' => $errors
]);

print($page_content);
