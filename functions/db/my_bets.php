<?php
function get_my_bets (mysqli $connection,string $user_id) :?array {

    $query ="SELECT b.amount,b.creation_time,l.title,l.image,l.end_date,l.id,c.title AS cat
        FROM bet b
        JOIN lot l ON b.lot_id = l.id
        JOIN categories c ON l.category_id = c.id
        WHERE b.user_id =$user_id";

    $request = mysqli_query($connection,$query);

    if (!$request){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }
    return mysqli_fetch_all($request,MYSQLI_ASSOC);
}
