<?php
    include_once 'inc/app.php';
    if( !user_logged_in() ) {
        header("location: index.php");
        exit();
    }
    $results = [];
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);
    $data = $db->get('data');
    $result['data'] = $data;
    echo json_encode($result);
    die();
?>
