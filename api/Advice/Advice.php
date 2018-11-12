<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    //FORMAT ADVICE 
    $Question_ID = $_POST["Question_ID"];
    
    $dataquery = mysqli_query($con, "SELECT * FROM Questions WHERE Question_ID='$Question_ID'");
    
    if($dataquery->num_rows == 0){
        $output = "Question not found!";
        
        echo json_encode($output);
        die();
    }
    else{
        $arr = array();

        while($r = mysqli_fetch_object($dataquery)){
            $Question_ID = $r->Question_ID;
            $Description = $r->Description;
            $Subject = $r->Subject;
            $topic = $r->topic;
            $question_type = $r->question_type;
            $anonymous = $r->anonymous;
            $hide = $r->hide;
            $user_ID2 = $r->user_id;
            $d_Image = $r->image;

            if($d_Image == NULL){
                $d_Image = NULL;
            }else{
                $d_Image = $r->image;
            }

            $query = mysqli_query($con, "SELECT f_name, l_name FROM users WHERE user_ID='$user_ID2'"); 
    
            while($z = mysqli_fetch_object($query)){
                $fname = $z->f_name;
                $lname = $z->l_name;
    
                if($anonymous == 1){
                    $Name = "Anonymous";
                }else{
                    $Name = $fname . ' ' . $lname;
                }
                
                    $query2 = mysqli_query($con, "SELECT profileImage FROM profile_pics WHERE user_ID='$user_ID2'");
    
                    while($y = mysqli_fetch_object($query2)){
                        $p_Image = $y->profileImage;

                        if($anonymous == 1){
                            $p_Image = NULL;
                        }else{
                            $p_Image = $y->profileImage;
                        }
                        
                        array_push($arr, array("Question_ID" => $Question_ID, "Description" => $Description, 
                        "Subject" => $Subject, "anonymous" => $anonymous, "hide" => $hide, "user_ID2" => $user_ID2, 
                        "name" => $Name, "pImage" => "<img src = $p_Image>", "dImage" => "<img src = $d_Image>", "topic" => $topic, "question_type" => $question_type));
    
                    }
    
            }
    
        }
        echo json_encode($arr);
        die();

    }

?>