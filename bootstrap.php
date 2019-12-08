<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Europe/Moscow");
setlocale(LC_ALL, 'ru_RU');
$config = require __DIR__.'/config.php';
require_once 'function.php';
require_once __DIR__.'/functions/view.php';
require_once __DIR__.'/functions/db/db.php';
require_once __DIR__.'/functions/db/categories.php';
require_once __DIR__.'/functions/db/lot.php';
require_once __DIR__.'/functions/db/lotdetail.php';
$connection = db_connect($config['db']);
// подключение всего остального ...
