<?php
    include "db.php";

    mysqli_query($con, "UPDATE users SET points=50 WHERE level='Bronze'");
    mysqli_query($con, "UPDATE users SET points=100 WHERE level='Silver'");
    mysqli_query($con, "UPDATE users SET points=200 WHERE level='Gold'");
    die();
?>