<?php

// validation function

function validate_date(string $date) : ?string {
    if (empty($date)){
        return 'Выберите дату';
    }
    // стащил код со Stack
    $date_now = date_create(date('Y-m-d'));
    date_modify( $date_now, '+1 day');

    if ($date <= $date_now) {
        return 'указанная дата должна быть больше текущей даты, хотя бы на один день';
    }
    return null;
}

function validate_rate (string $rate) : ?string {
    if($rate <= 0) {
       return 'Начальная цена должна быть больше 0';
    }
    return null;
}

function validate_step (string $step) : ?string {
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
