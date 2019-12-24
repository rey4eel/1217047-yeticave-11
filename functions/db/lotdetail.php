<?php

function get_lotById(mysqli $connection,int $id): ?array {

    $query = "SELECT l.initial_price,l.title, l.image, l.step ,l.end_date, c.title AS catname 
        FROM lot l
        JOIN categories c ON l.category_id = c.id
        WHERE l.id = $id";


    $request = mysqli_query($connection,$query);

    if (!$request){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }
    return mysqli_fetch_all($request,MYSQLI_ASSOC);
}

function get_bet_Byid(mysqli $connection,int $id): ?array {

    $query = "SELECT b.amount,b.creation_time,u.name 
        FROM bet b
        JOIN users u ON b.user_id = u.id
        WHERE b.lot_id = $id";


    $request = mysqli_query($connection,$query);

    if (!$request){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }
    return mysqli_fetch_all($request,MYSQLI_ASSOC);
}

function insert_bet(mysqli $connection,int $lot_id,int $amount,string $user_id) : bool {

    $query = "INSERT INTO bet 
                          (creation_time,amount,user_id,lot_id)
                     VALUES
                (NOW(),$amount,$user_id,$lot_id)";


    $request = mysqli_query($connection,$query);

    if (!$request){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }
    return true;
}

