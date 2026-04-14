<?php

    include_once '../app.php';
    session_destroy();
    header("location: ../../index.php");
    exit();

?>