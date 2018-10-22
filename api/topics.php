<?php
    include "db.php";
    $dataquery = $con->query("SELECT Topic_name FROM topics");
    if($dataquery->num_rows > 0) {
        while($row = $dataquery->fetch_assoc()){
            $topics_arr[] = $row["Topic_name"];
        } 
    }else{
        echo "No topics";
    }
    echo json_encode($topics_arr);
?>