<?php

require_once 'bootstrap.php';
$user_id = $_SESSION['id'];
$my_bets = get_my_bets($connection,$user_id);

$page_contetnt = include_template('my-bets.php',[
    'categories' => get_categories($connection),
    'my_bets' => $my_bets,
]);

print($page_contetnt);
