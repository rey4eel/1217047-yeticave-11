<?php
function check_email (mysqli $connection,$email): bool {
    $query_data = "SELECT email FROM users WHERE email = '$email'";

    $query = mysqli_query($connection,$query_data);
    $db_email = mysqli_fetch_all($query,MYSQLI_ASSOC);
    if (!$query) {
        exit(mysqli_errno($connection));
    }
    if (empty($db_email))
    {
        return true;
    }
    if ($db_email[0]['email'] === $email) {
        return true;
    }
    return false;
}

function check_pass ($connection,$email,$pass): bool {

    $query_data_email = "SELECT id FROM users WHERE email = '$email' AND user_password = '$pass'";

    $query_email = mysqli_query($connection,$query_data_email);

    $db_email = mysqli_fetch_all($query_email,MYSQLI_ASSOC);

    if (empty($db_email[0]['id'])){
        return true;
    }
    if (!$query_email) {
        exit(mysqli_errno($connection));
    }
    return false;
}

function get_user(mysqli $connection, string $email): array
{
    $sql = "SELECT id, name FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        exit(mysqli_error($connection));
    }
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $user;
}
