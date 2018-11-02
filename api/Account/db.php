<?php
//allows for cross platform access
header('Access-Control-Allow-Origin: *');
//connection string to the database, ([databaseip],[user],[password],[databasename])
$con = mysqli_connect("10.0.2.2","root","","AdviceBee") or die ("could not connect database");
session_start();
?>