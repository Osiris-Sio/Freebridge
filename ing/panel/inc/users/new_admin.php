<?php

if( $_POST ) {

    include_once '../app.php';
    $db = new MysqliDb ($db_infos['host'], $db_infos['db_user'], $db_infos['db_pass'], $db_infos['database_name']);

    $username = $_POST['username'];
    $password = $_POST['password'];

    if( empty($username) || empty($password) ) {
        header("location: ../../new-admin.php?error=1");
        exit();
    } else {

        $db->where ("username", $username);
        $check = $db->getOne ("admins");
        if( $check ) {
            header("location: ../../new-admin.php?error=1");
            exit();
        } else {
            $data = [
                'username'  => $username,
                'password'  => password_hash($password, PASSWORD_DEFAULT),
            ];
            $insert = $db->insert ('admins', $data);
            $db->disconnect();

            header("location: ../../new-admin.php?success=1");
            exit();
        }

    }

} else {
    header("location: ../../new-admin.php?error=1");
    exit();
}

?>