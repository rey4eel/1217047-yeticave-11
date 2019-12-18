<?php
function validate_reg_form (mysqli $connection,array $user_data) : ?array {
    $reg_data =  get_user_form_reg_data($user_data);
    $errors =[];
    $errors['name'] = validate_user_name($reg_data['name']);
    $errors['email'] = validate_email($connection,$reg_data['email']);
    $errors['password'] = validate_password($reg_data['password']);
    $errors['message'] = validate_contacts($reg_data['message']);
    foreach ($errors as $key=>$error){
        if (empty($error)){
            unset($errors[$key]);
        }
    }
    return $errors;
}
function get_user_form_reg_data(array $user_data): array
{
    $user_data = filter_var_array($user_data, [
        'email'    => FILTER_VALIDATE_EMAIL,
        'password' => FILTER_DEFAULT,
        'name'     => FILTER_DEFAULT,
        'message'  => FILTER_DEFAULT
    ], true);
    return $user_data;
}
function validate_user_name (string $name) : ?string {
    if(empty($name)) {
        return 'Поле не может быть пустым';
    }
    if(ctype_digit($name)){
        return 'имя должно состоять из букв';
    }
    $len = strlen($name);
    if ($len < 2 or $len > 60) {
        return 'Длина поля должна быть от 2 до 60 символов';
    }
    return null;
}

function validate_email($connection,string $email) : ?string {

    if (empty($email)){
        return 'Поле не может быть пустым и иметь верный формат email';
    }
    $email_valid =  check_email_double($connection,$email);
    if($email_valid){
        return 'This email already used';
    }

    return null;
}
function validate_password (string $password) : ?string {

    if (!$password) {
        return 'Поле не может быть пустым';
    } elseif (mb_strlen($password) < 6) {
        return 'Пароль должен состоять инимум из 6 симоволов';
    }
    return null;
}

function validate_contacts(string $message): ?string
{
    if (!$message) {
        return 'Заполните контакты';
    }
    $len = mb_strlen($message);
    if ($len < 8 or $len > 60) {
        return "Значение должно быть от 8 до 60 символов";
    }
    return null;
}
