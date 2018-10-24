<?php    
include "db.php";

function logout()
{
    $_SESSION = array(); //destroy all of the session variables
    session_destroy();
    header( 'Location: index.php' );
}
logout();
?>