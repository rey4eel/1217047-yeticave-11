<?php
require_once 'bootstrap.php';
$lot_id = $_POST['lotId'];
$bet_cost = $_POST['cost'];
$user_id = $_SESSION['id'];
$errors = [];

//validation
$errors = validate_bet_form($bet_cost,$lot_id,$connection);

if (count($errors) === 0){
    $bet = insert_bet($connection,$lot_id,$bet_cost,$user_id);
    If($bet){
        header("Location: lot.php?id=$lot_id");
        exit();
    }
    else
    {
        header("Location: lot.php?id=$lot_id");
        exit();
    }
}
$lotdata = get_lotById($connection,$lot_id);
$betdata = get_bet_Byid($connection,$lot_id);
$lot_info = include_template('lotPage.php', [
    'categories' => get_categories($connection),
    'lotdata' => get_lotById($connection,$lot_id),
    'betdata' => $betdata,
    'lot_id' => $lot_id,
    'errors' => $errors
]);

print($lot_info);
