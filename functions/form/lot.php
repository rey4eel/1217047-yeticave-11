<?php

function get_lot_data (array $form_data) : array {

    $lot_data = [];
    $lot_data ['lot-name'] = $form_data['lot-name'] ?? '';
    $lot_data ['message'] = $form_data['message'] ?? '';
    $lot_data ['lot-rate'] = $form_data['lot-rate'] ?? '';
    $lot_data ['lot-date'] = $form_data['lot-date'] ?? '';
    $lot_data ['lot-step'] = $form_data['lot-step'] ?? '';


    return $lot_data;
}

//function get_file_data (array $data) :?array {
//    $file_data = $data['fileID'] ?? null;
//    return $file_data;
//}

function insert_lot_data (mysqli $connection,array $lot_data) : ?int {

    $query_data = "INSERT INTO lot 
                          (title,category_id,description,initial_price,step,end_date,author_id,image,start_date)
                     VALUES
                ('{$lot_data['lot-name']}',1,'{$lot_data['message']}','{$lot_data['lot-rate']}','{$lot_data['lot-step']}','{$lot_data['lot-date']}',1,'{$lot_data['file']}',NOW())";


    $query = mysqli_query($connection,$query_data);

    if ($query) {
        return mysqli_insert_id($connection);
    }else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
    return null;
}

function save_file(array $lot_img): string
{
    $file_name = $lot_img['name'];
    $ext = substr($file_name, strrpos($file_name, '.'));
    $link = '/uploads/'.uniqid().$ext;
    move_uploaded_file($lot_img['tmp_name'],
        substr($link, 1));
    return $link;
}

