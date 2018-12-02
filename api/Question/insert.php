<?php
    include "../Account/db.php";
    //INSERT A QUESTION
    header('Content-type: application/json');
    
    if((isset($_POST['insert']))&&(isset($_SESSION['active'])))
    {
        $Description=$_POST['Description'];
        $Subject=$_POST['Subject'];
        $topic=$_POST['topic'];
        $type=$_POST['question_type'];
        $uID = $_SESSION['user_ID'];
        $active = $_SESSION['active'];
        $anonymous = $_POST['anonymous'];
        $hide = $_POST['hide'];
        $image = $_POST['image'];

        //has user verified email
    
        if($active == 1){
            //get points from database
            $result=mysqli_query($con, "SELECT * FROM users WHERE user_ID=$uID");
            while($row=mysqli_fetch_object($result))
            {
                $points=$row->points; 
            }
            //check if user has enough points
            if($points > 9)
            {
                $q=mysqli_query($con,"INSERT INTO `Questions` (`user_id` ,`Description`,`Subject`,`topic`,`question_type`, `anonymous`, `hide`, `image`) VALUES ('$uID','$Description','$Subject','$topic','$type', '$anonymous', '$hide', '$image')");
                //subtract the points
                $points=$points - 10;
                //update points
                mysqli_query($con, "UPDATE users SET points=$points WHERE user_ID=$uID");
                if($q){
                    echo json_encode("success");
                    die();
                }
                else{
                    echo json_encode("error");
                    die();
                }
            }
            else
            {
                echo json_encode("Insufficient points");
                die();
            }
            
        }
        else if($active == 0){
            echo json_encode("Not active");
            die();
        }    
    
    }
    else{
        echo json_encode("No account");
        die();
    }
    
?>