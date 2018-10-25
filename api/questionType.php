<?php
    include "db.php";
    $dataquery = $con->query("SELECT question_type FROM question_type");
    if($dataquery->num_rows > 0) {
        while($row = $dataquery->fetch_assoc()){
            $type_arr[] = $row["question_type"];
        } 
    }else{
        echo "No question types";
    }
    echo json_encode($type_arr);
?>