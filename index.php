<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ('function.php');

$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

$lots = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'price' => 10999,
        'img' => 'img/lot-1.jpg',
        'category' => 'Доски и лыжи',
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'price' => 159999,
        'img' => 'img/lot-2.jpg',
        'category' => 'Доски и лыжи',
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'price' => 8000,
        'img' => 'img/lot-3.jpg',
        'category' => 'Крепления',
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'price' => 10999,
        'img' => 'img/lot-4.jpg',
        'category' => 'Ботинки',
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal	',
        'price' => 7500,
        'img' => 'img/lot-5.jpg',
        'category' => 'Одежда',
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'price' => 5400,
        'img' => 'img/lot-6.jpg',
        'category' => 'Разное',
    ]

];

/**
 * @param int $price
 * @return string
 */
function price_format(int $price): string
{
    $currency = '<b class="rub">р</b>';
    $price = ceil($price);
    if ($price >= 1000) {
        $price = number_format($price, 0, null, ' ');
    }
    return $price.' '.$currency;
}

$page_content = include_template('main.php', [
    'lots'=>$lots,
    'categories'=>$categories
]);

$layout_content = include_template('layout.php',  [
    'page_content'=>$page_content,
    'categories'=>$categories,
    'title'=>'Главная Странца',
    'user_name' => 'Vartan Saakian',
    'is_auth' => rand(0, 1)
]);

print($layout_content);
?>

