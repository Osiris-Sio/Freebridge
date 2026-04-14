<?php

function user_logged_in() {
    if( isset($_SESSION['is_logged_in']) && isset($_SESSION['user_id']) )
        return true;
    return false;
    
}

?>