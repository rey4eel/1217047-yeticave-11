<?php

function validate_bet_form (string $bet,string $lot_id,mysqli $connection) : ?array {

    $errors =[];
    $errors['bet'] = validate_bet($connection,$bet,$lot_id);

    foreach ($errors as $key=>$error){
        if (empty($error)){
            unset($errors[$key]);
        }
    }
    return $errors;
}

function validate_bet(mysqli $connection,string $bet,$lot_id) :?string {
    if (!is_numeric($bet)) {
        return 'Допустим ввод только цифр';
    }
    if($bet <= 0) {
        return 'Шаг ставки должен быть больше 0';
    }
    $query = "SELECT  initial_price FROM lot 
        WHERE id=$lot_id";

    $request = mysqli_query($connection,$query);

    if (!$request){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }
    $initial_price = mysqli_fetch_all($request,MYSQLI_ASSOC);
    if($bet <= $initial_price[0]['initial_price']){
        return 'Шаг ставки должен быть больше начальной цены';
    }

    return null;

}



