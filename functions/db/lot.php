<?php

function get_lots(mysqli $connection): ?array {
    $query = "SELECT l.id,l.initial_price,l.title, l.image, l.step ,l.end_date, c.title AS catname 
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

function get_expired_lots_without_win(mysqli $connection): array
{
    $sql = "SELECT id FROM lots WHERE end_time <= NOW() AND winner_id IS NULL";
    $lots = mysqli_fetch_all(mysqli_query($connection,  $sql), MYSQLI_ASSOC);
    return $lots ?? [];
}

function get_winner(mysqli $connection, int $lot_id): ?array
{
    $sql = "
SELECT b.user_id,
       u.name as user_name,
       u.email,
       l.title as lot_name
FROM bets b
         INNER JOIN users u ON b.user_id = u.id
         INNER JOIN lot l ON b.lot_id = l.id
WHERE lot_id = $lot_id
ORDER BY SUM DESC
LIMIT 1
";
    $result = mysqli_fetch_array(mysqli_query($connection, $sql), MYSQLI_ASSOC);
    return $result ?? [];
}
