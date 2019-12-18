<?php
function check_email_double (mysqli $connection, $email ) :bool {

    $query_data = "SELECT email FROM users WHERE email = '$email'";
    $query = mysqli_query($connection,$query_data);
    $db_email = mysqli_fetch_all($query,MYSQLI_ASSOC);
    if (empty($db_email))
    {
        return false;
    }
    if ($db_email[0]['email'] === $email) {
        return true;
    }
    return false;
}

function add_user (mysqli $connection,array $user_data) :bool {

    $query_data = "INSERT INTO users 
                          (email,user_password,name,creation_time,contacts)
                     VALUES
                ('{$user_data['email']}','{$user_data['password']}','{$user_data['name']}',NOW(),'{$user_data['message']}')";

    $query = mysqli_query($connection,$query_data);

    if (!$query){
        //ошибка sql-запроса
        $error = mysqli_error($connection);
        //куда-то вывести $error, например:
        exit('Ошибка MySQL: '.$error);
    }
    return true;
}
