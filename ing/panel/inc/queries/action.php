<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $id        = $_POST['id'];
    $color    = $_POST['color'];
    $data = [
        'color'   => $color,
    ];

    $db->where ('id', $id);
    $db->update ('data', $data);
    $db->disconnect();

    echo 'success';

}

?>