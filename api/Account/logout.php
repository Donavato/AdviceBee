<?php    
include "db.php";

function logout()
{
    $_SESSION = array(); //destroy all of the session variables
    session_destroy();
    echo json_encode("session has been closed");
    die();
}
logout();
?>