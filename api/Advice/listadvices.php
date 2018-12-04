<?php
    include "../Account/db.php";
    header('Content-Type: application/json');
    $Question_ID = $_POST["Question_ID"];
    
    if(isset($_SESSION['user_ID'])){
        $uID = $_SESSION['user_ID'];
    }
    

    //QUERY TO CHECK IS RESPONSES FOR QUESTION IS HIDDEN
    $dataquery = mysqli_query($con, "SELECT * FROM questions WHERE Question_ID='$Question_ID'");
    while($a = mysqli_fetch_object($dataquery)){
        $hide = $a->hide;
        $userID = $a->user_id;
    }
    
    //IF QUESTION RESPONSES SELECTED AS HIDE AND USER OWNS THE QUESTION, DISPLAY ALL RESPONSES
    if($hide == 1 && $userID == $uID){

    //QUERY TO SELECT ALL FROM THE ADVICE TABLE WITH SPECIFIC QUESTION ID
    $datastring = mysqli_query($con, "SELECT * FROM advice WHERE question_id='$Question_ID'");
    $arr = array();

    //FETCH DATA FROM QUERY AND STORE INTO VARIABLES
    while($r = mysqli_fetch_object($datastring)){
        $user_ID = $r->user_id;
        $advice = $r->advice;
        $advice_ID = $r->advice_id;

        //COUNT AMOUNT OF ADVICES THAT HAVE ADVICE_LIKE COLUMN = 1
        $likequery = mysqli_query($con, "SELECT * FROM like_advices WHERE advice_ID=$advice_ID AND advice_like='1'");
        $like_count = mysqli_num_rows($likequery);
        
        //DISPLAY ROW COUNTS
        if($like_count == 0){
            $like_count = " ";
        }else{
            $like_count = mysqli_num_rows($likequery);
        }

        // QUERY TO GRAB USER NAME
        $query = mysqli_query($con, "SELECT f_name, l_name FROM users WHERE user_ID='$user_ID'");

        while($z = mysqli_fetch_object($query)){
            $fname = $z->f_name;
            $lname = $z->l_name;
            $Name = $fname . ' ' . $lname;

            //QUERY TO GRAB USER PROFILE IMAGE
            $query2 = mysqli_query($con, "SELECT profileImage FROM profile_pics WHERE user_ID='$user_ID'");

            while($y = mysqli_fetch_object($query2)){
                $p_Image = $y->profileImage;
            
                array_push($arr, array("advice" => $advice, "name" => $Name, "advice_id" => $advice_ID, 
                "pImage" => "<img src = $p_Image>", "likes" => $like_count));
            }
        }
    }

    echo json_encode($arr);
    die();

    }
    //IF QUESTION RESPONSES ARE HIDDEN BUT USER DOES NOT OWN THE QUESTION, NOTIFY USER
    else if($hide == 1 && $userID != $uID){

        echo json_encode("Responses Private");

    }
    //IF QUESTION RESPONSES NOT SET TO HIDE RESPONSES DISPLAY ALL RESPONSES
    else if($hide == 0){
    
    //QUERY TO SELECT ALL FROM THE ADVICE TABLE WITH SPECIFIC QUESTION ID
    $datastring = mysqli_query($con, "SELECT * FROM advice WHERE question_id='$Question_ID'");
    $arr = array();

    //FETCH DATA FROM QUERY AND STORE INTO VARIABLES
    while($r = mysqli_fetch_object($datastring)){
        $user_ID = $r->user_id;
        $advice = $r->advice;
        $advice_ID = $r->advice_id;

        //COUNT AMOUNT OF ADVICES THAT HAVE ADVICE_LIKE COLUMN = 1
        $likequery = mysqli_query($con, "SELECT * FROM like_advices WHERE advice_ID=$advice_ID AND advice_like='1'");
        $like_count = mysqli_num_rows($likequery);

        //DISPLAY ROW COUNTS
        if($like_count == 0){
            $like_count = " ";
        }else{
            $like_count = mysqli_num_rows($likequery);
        }

        // QUERY TO GRAB USER NAME
        $query = mysqli_query($con, "SELECT f_name, l_name FROM users WHERE user_ID='$user_ID'");

        while($z = mysqli_fetch_object($query)){
            $fname = $z->f_name;
            $lname = $z->l_name;
            $Name = $fname . ' ' . $lname;

            //QUERY TO GRAB USER PROFILE IMAGE
            $query2 = mysqli_query($con, "SELECT profileImage FROM profile_pics WHERE user_ID='$user_ID'");

            while($y = mysqli_fetch_object($query2)){
                $p_Image = $y->profileImage;
            
                array_push($arr, array("advice" => $advice, "name" => $Name, "advice_id" => $advice_ID, 
                "pImage" => "<img src = $p_Image>", "likes" => $like_count));
            }
        }
    }

    echo json_encode($arr);
    die();
    
    }

?>