<?php
require_once 'bootstrap.php';

function getPostVal($name) {
    return $_POST[$name] ?? "";
}

$errors = [];

// доделать отображение страницы с лотом
// Проверить категорию массив ничего не возвращал


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $file_data = $_FILES['fileID'];
    $lot_data = get_lot_data($_POST);
    $errors = validate_lot_form($lot_data,$file_data);

    //var_dump($_POST);
    if (count($errors) === 0){
        $lot_data['file'] = save_file($_FILES['fileID']);
        $insert = insert_lot_data($connection,$lot_data);
        if ($insert) {
            header("Location: lot.php?id=" . $insert);
        }
        else{echo "NEgotovo";}

    }else{
        $errors['check'] = '1';
    }

}

$add_lot = include_template('add-lot.php',[
    'categories' => get_categories($connection),
    'errors' => $errors
]);

print($add_lot);


