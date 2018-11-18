<?php
	include "../Account/db.php";
	header('Content-type: application/json');
	
	$topicName = $_POST['Topic_Name'];
	
	$dataquery = mysqli_query($con, 
	"SELECT *, (select count(*) from advice where advice.question_id = questions.Question_ID) AS CommentCount 
	FROM Questions
	WHERE topic = '$topicName'");
	
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
                        $p_Image = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAABmJLR0QA/wD/AP+gvaeTAAAAB3RJTUUH4gsSDAcqh3gYWQAAB/5JREFUeNrtndlW28gWQPeRLNvCM0MYQrr7/3/p3tsEgsEjnq1ZdR9sOYSVpA0YV9Fov5Blr6BSbZ0aVFUHub27V+QYg6W7ADk/kgsxjFyIYeRCDCMXYhi5EMPIhRhGLsQwciGGkQsxjFyIYeRCDCMXYhi5EMPIhRhGLsQwciGGkQsxjILuArwEEdn8Wym1/gnZx9n32XfviXclRERIkgTfD1h6Hp7vE4YhcZICCkssCk6BcqmI67ocuC5Fx0FE3o2cdyPEDwJG4wmj8QTP90mS5LeVbFkWjuNQr1Y4bLWo16rYtm28GDF514mIEIQhvf6AwfCBIAw3n2+LUgrLsqhVq5x9OqHRqGMBpt600RHyMBpxe9dh6XmIyLNEZGTN1WQ6Zb6Yc3R4yOfzM0rFopHRYqSQNE2563Tp9PokSfIiEU8REdJU0esPWC49/vzymVq1apwU44a9SZpyfdvmrtMlTdOdyHiMiDBfLPjv1TXjyXTnv/+1GCUkTVO+3bbpDYZveh0RIQgCrq5vmMxmRkkxSsh9t0dvMGQf1ZMNGL7efMNb91EmYIQQEWE0nnDf7e39up7nc9O+I0kS3dUAGCIkDEPa9x0tlSIijCfTVWQaECXahYhAtz9gsVxqqxAFdHp9PN9HtxOtQkTA8wP6wwetT6cAQRDQHwy1zxg1R4gwfBgRrmfgWksiwnA0xtdcFq1CoihmNJ5orYDHhGHIRPPcRJsQEWGxXK7bbf2dKazee40mU9I01VYGrREync203vxTRISl5xGGkbYyaBOSpimL5VLbjf+KKIo2LzN1oE1IHMcEQWhMc5WhlMLzfW3X1yJERIjimNiQ2fFTgiDU9hZYa4SY1H88Joo/YB+SpCmGLUVsSJP040XIakZsphGlsWRa5yGmdejfy8ZelgB+hjYhtm1rf5H367IVPt6wt1CwsUT7y+afUnQ+mBClFE7BwXEc4zYZAJTLJW3X1hohOm/8V1iWhVt29V1f14VFhGqlou3Gf4YCSsUibrn8AYe9QL1WpVCwdRbhR5SiWqngOPq2q2kTopTCdV0qBxVj+hHLsmg1Gx9zPQTAtiyODltGzEeUUhy4LvWa3t2MWoUopWg16lQOXO1RIiKcHB9RKOjdXat9IuA4DqcnJ1qjRK37jqNWU/uDoV2IUorDVpNWs6GtMmzb5uL8VHt0gAFCYFUhlxfnlMulvUtRwNmnE5r1uvboAEOEZB3qH5ef9/qUKqU4bDY4P/2kuwo2GCEEsg6+wR+XF1jW2xdLKUWjXufPL5dGNFUZ5pRkzcnREYJwc9smiuM36eyVUrSaDf768sW4k1TGCQE4OT7CcRxubts73QGSnTc8PTnm8/k5jlMwSgYYKkQpRbNRp1wucXffZTgavepoW1bpB67Lxfkph80WImaeYzf8FO4qIcB0NqPbHzCdzYnjeP3d7+WsVogVIkK5XOL48JCTo0OKhjVRTzEyQjKyemvU69SqVRZLj/FkwnQ+x/cDkiQhTX9cARcRLMui6DhUDg5oNOo0atWNCJNlgOFCMtT6Sa9VK9SqFdI0JYwigiAkiqJVEgHAEqHgFCg5RYqlIs6j0ZPpIjKMFfK4SUqVIk1TkjghTmKSJCFJUtI0RaEQy0JYbUxYyQqJk4SCbWMXbGzbxrasH4bTpgoyRogArA/5x0lCEAR4vo/n+fhBQBCGxHGybqb+ed+UiGCJYNk2BdumWCxSLpVw3TJuuUy5VMJ5tHZuiiDtQlYH+lP8IGC2WDKbzVl4S8IwJHmyYe25KTUSpUjSlDAMWXpe9kuw13lQDtwytWqVWrWKWy5h2/bm/2qrDx2jrCzdRRCGTKYzxpMJ88WSOI43lbGPt7/ZtQqFAgdumWa9TqNRx3VdLE0ZhPYqJIuG+WLJ8OGB8XRKGEabTlsnWeU7ToF6tcbRUYtGrbb3DEJ7EZKJmM7m9AYDJtPZznKYvAXZjL5aOeDT8THNZoPCnsTsRchiueS+22M8mRot4infh9tVzk9PaNTrWJb1pmLerFMXEcIootvr0xsMiKLY6P28v7oHWL0pmC8WHLWaXJyd4bpvt03ozSJkOpvxrX3PfLF4VxJ+h1KKcqnE5/OzN9ucsXMhSik6vT53nS7xG70+10nWv5wcHXJ5cb7z7bA7a7JEhCiK+dZu0x8+bD77t5EN2bv9AX4Q8NeXS1x3d7tmdrI0l6U6+vv6+s1zXZmCiDCZzvjP1dedNsuvFrJKBhby99drRuPJvzIqfnfvy6XH/66umc13I+XVQqIo4urmG5OpWZnZ9oWI4Pk+V9c3LHeQ0ehVQtJUcdO+Yzz5WJHxlCwDxNXNLUEYvuo43KuEdPt9BppTK5mCiDCbz7lt35O+ooN/kZDs4vedru56MAoRYfDw8Kr8Xy8SEscx7fsO0Xp9O+c7SsFdp4vnvSzL0bOFrBJ9jZjO5nlT9RNEVtnpOr3ei+YmzxYSRRHd/sCYFTYTybLTvSSP5LOEZOlcXxqOH4k4jukPH5794D5LSJKkDEfjPDq2YJV+drL5iw7bsrWQ1QTI05rO9b0RhhGzZ/a1z4qQ2Xyx2TmY888opZjOZs9qUbYWopRivljovsd3x8LznpWobWsh2d9+ytkeESEKI6Io2rrZ2no9JE4SomiVaS3v1LcnThLCMOTA3S5dx9ZCBKHRqBubls9ksg1422D0cYSPiDFnDHNW5EIMIxdiGLkQw8iFGEYuxDByIYaRCzGM/wORaBnaJM1ONwAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxOC0xMS0xOFQxMjowNzo0Mi0wNTowMGjX1WUAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTgtMTEtMThUMTI6MDc6NDItMDU6MDAZim3ZAAAAAElFTkSuQmCC";
                    }else{
                        $p_Image = $y->profileImage;
                    }

                    array_push($arr, array("Question_ID" => $Question_ID, "Description" => $Description, 
                    "Subject" => $Subject, "anonymous" => $anonymous, "hide" => $hide, "user_ID2" => $user_ID2, 
                    "name" => $Name, "pImage" => "<img src = $p_Image>", "dImage" => "<img src = $d_Image>", "c_count" => $comment_count));

                }

        }

    }


    echo json_encode($arr);
    die();
?>