<?php
    include "db.php";
    $dataquery = $con->query("SELECT Topic_name FROM topics");
    if($dataquery->num_rows > 0) {
        while($row = $dataquery->fetch_assoc()){
            // echo $row["Topic_name"] . "<br>"; 
            $topics_arr[] = $row["Topic_name"] . "<br>";
        } 
    }else{
        echo "No topics";
    }
    echo json_encode($topics_arr);


?>