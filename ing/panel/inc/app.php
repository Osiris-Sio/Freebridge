<?php
session_start();
error_reporting(0);

$db_infos = [
    'host'              => 'localhost',
    'db_user'           => 'ing',
    'db_pass'           => 'Asedzq123',
    'database_name'     => 'ing'
];

include_once 'MysqliDb.php';
include_once 'functions.php';
?>