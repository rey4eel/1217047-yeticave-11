<?php
if (!file_exists('vendor/autoload.php')) {
    exit();
}
require_once 'bootstrap.php';

$lots = get_expired_lots_without_win($connection);
$transport = (new Swift_SmtpTransport(
    $config['mailer']['host'],
    $config['mailer']['port']
))
    ->setUsername($config['mailer']['username'])
    ->setPassword($config['mailer']['password']);
$mailer = new Swift_Mailer($transport);
foreach ($lots as $lot) {
    $winner = get_winner($connection, $lot['id']);
    if (isset($winner['user_id'])) {
        $message = get_message($winner, $lot['id']);
        $result = $mailer->send($message);
    }
}
