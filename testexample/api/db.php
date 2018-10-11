<?php
//allows for cross platform access
header('Access-Control-Allow-Origin: *');

//connection string to the database, ([databaseip],[user],[password],[databasename])
$con = mysqli_connect("localhost","root","","jsontest") or die ("could not connect database");
?>