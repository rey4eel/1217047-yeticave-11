<?php
require_once 'bootstrap.php';

$lot_id = $_GET['id'];
$lotdata = get_lotById($connection,$lot_id);
$betdata = get_bet_Byid($connection,$lot_id);
$lot_info = include_template('lotPage.php', [
    'categories' => get_categories($connection),
    'lotdata' => get_lotById($connection,$lot_id),
    'betdata' => $betdata,
    'lot_id' => $lot_id
]);

print($lot_info);
