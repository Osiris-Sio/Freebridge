<?php

if( $_GET['id'] ) {

    include_once '../app.php';
    if( !user_logged_in() ) {
        header("location: index.php");
        exit();
    }
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $id = intval($_GET['id']);
    $db->where('id', $_GET['id']);
    $db->delete('data');
    $db->disconnect();

    header("location: ../../data.php");
    exit();

}

?>