<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $db->where ("username", $username);
    $admin = $db->getOne ("admins");
    if( $admin ) {
        
        if( password_verify($password,$admin['password']) ) {
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id']      = $admin['id'];
            header("location: ../../data.php");
        } else {
            header("location: ../../index.php?error=1");
        }

    } else {
        header("location: ../../index.php?error=1");
    }


} else {
    header("HTTP/1.0 404 Not Found");
    die();
}

?>