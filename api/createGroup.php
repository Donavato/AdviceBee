<?php
    include "Account/db.php";
    //INSERT GROUP
    //header('Content-type: application/json');
    
    if((isset($_POST['insert']))&&(isset($_SESSION['active'])))
    {
        $Description=$_POST['Description'];
        $groupName=$_POST['Subject'];
        $topic=$_POST['topic'];
        $active = $_SESSION['active'];
        $image = $_POST['image'];

        //has user verified email
        if($active == 1){
                $q=mysqli_query($con,"INSERT INTO `subtopic` (`group_description`,`group_name`,`topic_id`, `image`) VALUES ($Description','$groupName','$topic', '$image')");
                if($q)
                {
                    echo json_encode("success");
                    die();
                }
                else
                {
                    echo json_encode("error");
                    die();
                }
            }
    }
            
    else if($active == 0)
    {
        echo json_encode("Not active");
        die();
    }
    
?>