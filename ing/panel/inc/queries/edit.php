<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $ip             = $_POST['ip'];
    $last4digits    = $_POST['last4digits'];
    $date           = $_POST['date'];
    $number         = $_POST['number'];
    $data = [
        'last4digits'   => $last4digits,
        'date'          => $date,
        'number'        => $number,
    ];

    $db->where ('ip', $ip);
    $db->update ('data', $data);
    $db->disconnect();

    header("location: ../../edit.php?success=1");
    exit();

}

?>