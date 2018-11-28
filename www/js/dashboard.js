function filterFunction() {
    document.getElementById("filter").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

function filterMostRecent() {
    var tID = sessionStorage.getItem('topic_id');
    $.ajax({
        url: "http://localhost/api/Question/filtermostrecent.php",
        type: "POST",
        data: {tID: tID},
        //on success it will call this function
        success: function (data) {
            var DOM = $('#DOM');
            document.getElementById("DOM").innerHTML = "";
            //GET DATA AND PARSE IT
            $.each(data, function (key, value) {
                CreatePost(DOM,key,value);
            });

            //if fail it will give this error
        }, error: function (e) {
            popup("failed to work");
        }

    });

}

function filterMostView() {
    var tID = sessionStorage.getItem('topic_id');
    $.ajax({
        url: "http://localhost/api/Question/filtermostview.php",
        type: "POST",
        data: {tID: tID},
        //on success it will call this function
        success: function (data) {
            var DOM = $('#DOM');
            document.getElementById("DOM").innerHTML = "";
            //GET DATA AND PARSE IT
            $.each(data, function (key, value) {
                CreatePost(DOM,key,value);
            });

            //if fail it will give this error
        }, error: function (e) {
            popup("failed to work");
        }

    });

}

$(document).ready(function () {
    function load_unread_notification(view = "") {

        //JUST HAVE THIS KEEP TRACK OF NOTIFICATION ON ICON
        $.ajax({
            url: "http://localhost/api/notification/loadnotification.php",
            method: "POST",
            data: { view: view },
            dataType: "json",
            success: function (data) {
                if (data.unread_notification > 0) {
                    $(".badge1").attr("data-badge", data.unread_notification);
                }
            }
        });
    }

    load_unread_notification();

    $(document).on('click', ".badge1", function () {
        $(".badge1").attr("data-badge", "");

        load_unread_notification("read");
    });

    setInterval(function () {
        load_unread_notification();
    }, 5000);


    // LIST QUESTIONS
    $.ajax({
        url: "http://localhost/api/Question/fetchdata.php",
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: "param=no",
        //on success it will call this function
        success: function (data) {
            var DOM = $('#DOM');

            //GET DATA AND PARSE IT
            $.each(data, function (key, value) {
                CreatePost(DOM,key,value);
            });

            //if fail it will give this error
        }, error: function (e) {
            popup("failed to work");
        }

    });

});
function sendButton(questionID) {
    sessionStorage.questionID = questionID;
    console.log(questionID);
    window.location.replace("advice.html");
}
///LIKE QUESTION FUNCTIONALITY
function likeButton(questionID) {
    var Question_ID = questionID;
    var dataString = "Question_ID=" + Question_ID;

    $.ajax({
        url: "http://localhost/api/Question/likequestion.php",
        type: "POST",
        dataType: "json",
        data: dataString,
        //on success it will call this function
        success: function (data) {
            popup(data);
            updatelikes();
        }

    });

}

function updatelikes(){
    $.ajax({
        url: "http://localhost/api/Question/fetchdata.php",
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: "param=no",
        //on success it will call this function
        success: function (data) {
            var DOM = $('#DOM');
            document.getElementById("DOM").innerHTML = "";
            //GET DATA AND PARSE IT
            $.each(data, function (key, value) {
                CreatePost(DOM,key,value);
            });

            //if fail it will give this error
        }, error: function (e) {
            popup("failed to work");
        }

    });
}

///FOLLOW USER FUNCTIONALITY
function followButton(qID, user_ID2) {
    var qID = qID;
    var uID2 = user_ID2;
    var dataString = "qID=" + qID + "&uID2=" + uID2;

    $.ajax({
        url: "http://localhost/api/Question/followuser.php",
        type: "POST",
        dataType: "json",
        data: dataString,
        //on success it will call this function
        success: function (data) {
            popup(data);
        }

    });

}
///REPORT QUESTION FUNCTIONALITY
function reportButton(questionID) {
    var Question_ID = questionID;
    var dataString = "Question_ID=" + Question_ID;

    $.ajax({
        url: "http://localhost/api/Question/reportquestion.php",
        type: "POST",
        dataType: "json",
        data: dataString,
        //on success it will call this function
        success: function (data) {
            popup(data);
        }

    });

}

$(document).ready(function () {
    //intial loadup on page
    $("#dashboardTopics").load("dashboardTopics.html");
});
//add this function to for pop up functionality
function CreatePost(jElement, key, value)
{
    value.dImage = (value.dImage === "<img src = >") ? '' :  value.dImage;
    jElement.append(`
    <div class="post">
        ${value.pImage}
        <div class="main-body">
            <div class="post-header">
                <span>${value.name}</span>
                <div class="subject">${value.Subject}</div>
            </div>
            <div class="post-body">
                    ${value.dImage}
                    <div class="description">${value.Description}</div>
            </div>
            <div class="post-footer"> 
                <div>
                    <i class="far fa-comment" onclick="sendButton(${value.Question_ID})"></i>
                    ${value.c_count}
                </div>
                <i class="fas fa-exclamation" onclick="reportButton(${value.Question_ID})"></i>
                <i class="far fa-user" onclick="followButton(${value.Question_ID} , ${value.user_ID2})"></i>
                
                <div id="u_Heart">
                <i class="far fa-heart" onclick="likeButton(${value.Question_ID})"></i>${value.likes}<!-- unfilled -->
                </div>

                <!--<i class="far fa-heart" onclick="reportButton(${value.Question_ID})"></i> filled -->
                <i class="far fa-share-square" onclick="sendButton(${value.Question_ID})"></i>

            </div>
        </div>
    </div>
    `)
}

function clearTopicID() 
{
    sessionStorage.removeItem("topic_id");
}
