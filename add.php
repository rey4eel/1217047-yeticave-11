<?php
require_once 'bootstrap.php';

function getPostVal($name) {
    return $_POST[$name] ?? "";
}

$error_input = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $request = $_POST;
    $required_field = ['lot-name'];
    foreach ($required_field as $field){
        if (empty($_POST[$field])){
            $error_input[$field] = 'Поле не заполнено';
        }
    }

    $error_input['lot-rate'] = validate_rate($_POST['lot-rate']);
    $error_input['lot-date'] = validate_date($_POST['lot-date']);
    $error_input['lot-step'] = validate_step($_POST['lot-step']);
    $error_input['category'] = validate_step($_POST['category']);
    $error_input['message'] = validate_message($_POST['message']);

    var_dump($_POST);

    if (count($error_input) === 0){
        // вписать данные в БД
    }else{
        $error_input['check'] = '1';
    }
}

$add_lot = include_template('add-lot.php',[
    'categories' => get_categories($connection),
    'error_input' => $error_input
]);

print($add_lot);


