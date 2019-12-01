<?php

function get_lots(mysqli $connection): ?array {
    $query = "SELECT l.initial_price,l.title, l.image, l.step ,l.end_date, c.title 
        FROM lot l
        JOIN categories c ON l.category_id = c.id";

    $request = mysqli_query($connection,$query);

    if (!$request){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }
    return mysqli_fetch_all($request,MYSQLI_ASSOC);
}
