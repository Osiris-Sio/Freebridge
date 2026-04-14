<?php

if( intval($_GET['ip']) && !empty($_GET['action']) ) {

    include_once '../app.php';
    if( !user_logged_in() ) {
        header("location: index.php");
        exit();
    }
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $ip  = $_GET['ip'];
    $action  = $_GET['action'];

    $data = [
        'action'  => $action,
        'status'  => 0,
    ];

    $db->where ('ip', $ip);
    $db->update ('data', $data);
    $db->disconnect();

    header("location: ../../data.php");
    exit();

}

?>