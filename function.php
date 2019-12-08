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


