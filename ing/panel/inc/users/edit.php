<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $id       = intval($_GET['id']);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $data = [
        'username'   => $username,
    ];
    if( !empty($password) ) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $db->where ('id', $id);
    $db->update ('admins', $data);
    $db->disconnect();

    header("location: ../../profile.php?success=1");
    exit();

}

?>