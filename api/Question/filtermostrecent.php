<?php
    include "../Account/db.php";
    header('Content-type: application/json');

    $tID=$_POST['tID'];

    if(!$tID){
        
        $dataquery = mysqli_query($con, "SELECT *, (select count(*) from advice where advice.question_id = questions.Question_ID) AS CommentCount FROM Questions  ORDER BY timestamp DESC");
        $arr = array();

        while($r = mysqli_fetch_object($dataquery)){
            $Question_ID = $r->Question_ID;
            $Description = $r->Description;
            $Subject = $r->Subject;
            $anonymous = $r->anonymous;
            $hide = $r->hide;
            $user_ID2 = $r->user_id;
            $d_Image = $r->image;
            $comment_count = $r->CommentCount;

            $likequery = mysqli_query($con, "SELECT * FROM like_questions WHERE question_ID=$Question_ID AND question_like='1'");
            $like_count = mysqli_num_rows($likequery);
            
            if($like_count == 0){
                $like_count = " ";
            }else{
                $like_count = mysqli_num_rows($likequery) . ' Like';
            }

            if($d_Image == NULL ||$d_Image == "None"){
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
                        "name" => $Name, "pImage" => "<img src = $p_Image>", "dImage" => "<img src = $d_Image>", 
                        "c_count" => $comment_count, "likes" => $like_count));

                    }

            }

        }


        echo json_encode($arr);
        die();

    }else{
        $t_query = mysqli_query($con, "SELECT * FROM `topics` WHERE Topic_ID='$tID'");

        while($h = mysqli_fetch_object($t_query)){
            $tName = $h->Topic_name;
    
            $dataquery = mysqli_query($con, "SELECT *, (select count(*) from advice where advice.question_id = questions.Question_ID) AS CommentCount FROM Questions WHERE topic='$tName' ORDER BY timestamp DESC");
            $arr = array();
    
            while($r = mysqli_fetch_object($dataquery)){
            $Question_ID = $r->Question_ID;
            $Description = $r->Description;
            $Subject = $r->Subject;
            $anonymous = $r->anonymous;
            $hide = $r->hide;
            $user_ID2 = $r->user_id;
            $d_Image = $r->image;
            $comment_count = $r->CommentCount;
    
            $likequery = mysqli_query($con, "SELECT * FROM like_questions WHERE question_ID=$Question_ID AND question_like='1'");
            $like_count = mysqli_num_rows($likequery);
            
            if($like_count == 0){
                $like_count = " ";
            }else{
                $like_count = mysqli_num_rows($likequery) . ' Like';
            }
    
            if($d_Image == NULL ||$d_Image == "None"){
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
                        "name" => $Name, "pImage" => "<img src = $p_Image>", "dImage" => "<img src = $d_Image>", 
                        "c_count" => $comment_count, "likes" => $like_count));
    
                    }
    
            }
    
        }
    
    }
    
        echo json_encode($arr);
        die();
}
   
?>