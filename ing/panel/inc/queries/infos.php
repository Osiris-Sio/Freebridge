<?php

if( $_POST ) {

    if( !empty($_POST['ip']) ) {

        include_once '../app.php';
        $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

        $ip = $_POST['ip'];
        $db->where ("ip", $ip);
        $data = $db->getOne("data");
        if( $data ) {
            echo json_encode($data);
        }

    }

    $db->disconnect();
    
}

?>