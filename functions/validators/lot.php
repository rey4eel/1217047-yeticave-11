<?php

function validate_lot_form (array $lot_data,?array $file_data) : ?array {

    $errors =[];
    $errors['lot-name'] = validate_name($lot_data['lot-name']);
    $errors['message'] = validate_message($lot_data['message']);
    $errors['lot-rate'] = validate_rate($lot_data['lot-rate']);
    $errors['lot-date'] = validate_date($lot_data['lot-date']);
    $errors['lot-step'] = validate_step($lot_data['lot-step']);
    //$errors['category'] = validate_category($lot_data['category']);
    $errors['file'] = validate_lot_file($file_data);

    foreach ($errors as $key=>$error){
        if (empty($error)){
            unset($errors[$key]);
        }
    }
    return $errors;
}
// создать валидацию для файл прикрепленного в форме
function validate_lot_file(?array $file_data): ?string
{
    if ($file_data['size'] === 0) {
        return $errors = 'Не загружен файл';
    }
    $file_type = mime_content_type($file_data['tmp_name']);
    $allow_type = ['image/png', 'image/jpeg'];
    if (!in_array($file_type, $allow_type)) {
        return $errors = 'Неверный формат файла';
    }
    return null;
}


// проверить что категория есть в базе.



function validate_name (string $name) : ?string {
    if(empty($name)) {
        return 'Поле не должно быть пустым ';
    }
    $len = strlen($name);
    if ($len < 10 or $len > 256) {
        return 'Длина поля должна быть от 10 до 256 символов';
    }
    return null;
}

function validate_date(string $date) : ?string {

    if (empty($date)){
        return 'Выберите дату';
    }
    $date_now = date_create(date('Y-m-d'));
    date_modify( $date_now, '+1 day');

    if ($date <= $date_now->format('Y-m-d')) {
        return 'указанная дата должна быть больше текущей даты, хотя бы на один день';
    }
    return null;
}

function validate_rate (string $rate) : ?string {
    if (!is_numeric($rate)) {
        return 'Допустим ввод только цифр';
    }
    if($rate <= 0) {
        return 'Начальная цена должна быть больше 0';
    }
    return null;
}

function validate_step (string $step) : ?string {
    if (!is_numeric($step)) {
        return 'Допустим ввод только цифр';
    }
    if($step <= 0) {
        return 'Шаг ставки должен быть больше 0';
    }
    return null;
}

function validate_category (string $category) : ?string {
    if($category == 'Выберите категорию') {
        return 'Выберите категорию';
    }
    return null;
}

function validate_message (string $message) : ?string {
    if(empty($message)) {
        return 'Поле не заполнено';
    }
    $len = strlen($message);
    if ($len < 80 or $len > 2000) {
        return 'Длина поля должна быть от 80 до 2000 символов';
    }
    return null;
}




