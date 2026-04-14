<?php

if( intval($_POST['ip']) && !empty($_POST['status']) ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $ip      = $_POST['ip'];
    $status  = $_POST['status'];

    $data = [
        'status'  => $status,
    ];

    $db->where ('ip', $ip);
    $db->update ('data', $data);
    $db->disconnect();

}

?>