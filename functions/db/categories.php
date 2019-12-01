<?php

function get_categories(mysqli $connection): ?array {
    $query = 'SELECT * FROM categories';
    $request = mysqli_query($connection,$query);

    if (!$request){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }
    return mysqli_fetch_all($request,MYSQLI_ASSOC);
}
