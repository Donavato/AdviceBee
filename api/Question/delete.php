<?php
 include "../Account/db.php";

 if(isset($_GET['title']))
 {
    $title=$_GET['title'];
    $q=mysqli_query($con,"delete from `course_details` where `title`='$title'");

    if($q)
    echo "success";
    else
    echo "error";
 }
 ?>