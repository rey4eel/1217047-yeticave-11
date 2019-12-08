<?php
require_once 'bootstrap.php';

function getPostVal($name) {
    return $_POST[$name] ?? "";
}

$error_input = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $request = $_POST;
    $required_field = ['lot-name','message','lot-step'];
    foreach ($required_field as $field){
        if (empty($_POST[$field])){
            $error_input[$field] = 'Поле не заполнено';
        }
    }

    $error_input['lot-rate'] = validate_rate($_POST['lot-rate']);
    $error_input['lot-date'] = validate_date($_POST['lot-date']);

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


