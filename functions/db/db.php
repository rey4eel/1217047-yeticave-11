<?php
function db_connect ($db_config) : mysqli {
    $connection = mysqli_connect($db_config['host'],$db_config['user'],$db_config['password'],$db_config['database']);

    if (!$connection){
        exit('Ошибка соединения с БД: ' . mysqli_connect_error());

    }
    mysqli_set_charset($connection, 'utf8');

    return $connection;
}
