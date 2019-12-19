<?php
require_once 'bootstrap.php';

function getPostVal($name) {
    return $_POST[$name] ?? "";
}
$categories = get_categories($connection);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $form_data = $_POST;
    $errors = verify_login_form($form_data,$connection);

    if(count($errors) != 0)
    {
        $errors['check'] = '1';
    }
    else
    {
        $user = get_user($connection,$form_data['email']);
        if ($user)
        {
            $_SESSION = [
                'user' => $user['name'],
                'id'   => $user['id'],
            ];
            header("Location: index.php");
            exit();
        }
    }
}

$page_content = include_template('login.php', [
    'categories' => $categories,
    'errors' => $errors
]);

print($page_content);
