<?php
/**
 * @param mysqli $connection
 * @param string|null $search
 * @return array|null
 */
function get_search_data(mysqli $connection, ?string $search,?int $limit,?int $offset):?array
{

    $query = "SELECT lot.id, lot.title, lot.description, lot.image, lot.initial_price,lot.end_date,categories.title AS category FROM lot 
JOIN categories ON lot.category_id = categories.id
WHERE MATCH(lot.title, lot.description) AGAINST('{$search}' IN NATURAL LANGUAGE MODE) LIMIT {$limit} OFFSET {$offset}";

    $request = mysqli_query($connection, $query);

    if(!$request){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }

    return mysqli_fetch_all($request, MYSQLI_ASSOC);
}

function get_search_lots_count(mysqli $connection, string $search) :?int
{
    if ($search) {
//        $sql = " SELECT COUNT(*) as count_item FROM lot WHERE MATCH(lot.title, lot.description) AGAINST('{$search}' IN BOOLEAN MODE)";
        $sql = "SELECT COUNT(*) as count_item FROM lot";

        $request = mysqli_query($connection, $sql);

        if(!$request){
            //ошибка sql-запроса
            $error = mysqli_error($connection);
            //куда-то вывести $error, например:
            exit('Ошибка MySQL: '.$error);
        }
        $lots_found = mysqli_fetch_array($request, MYSQLI_ASSOC);
        if ($lots_found['count_item'] > 0) {
            return $lots_found['count_item'];
        }
        return 'Ничего не найдено по вашему запросу';
    }
    return 'пустой запрос';
}
