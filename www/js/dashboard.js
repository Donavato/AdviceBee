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
    $.ajax({
        url: "http://localhost/api/Question/filtermostrecent.php",
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

                DOM.append("<div class='usercontainer'>" + "<div class='profileimage'>" + value.pImage + "</div><div class='username'>" + value.name + "</div>" + "</div>" + "<div class='question'>" +
                    "<p class='sub'>" + value.Subject + "</p><br>" + "<div class='content'>" + value.dImage + "<br>" + "<div class='desc'>" + value.Description + "</div>" + "</div><br>" + "<br><div class='usercontainer'>" +
                    "<div class='comment'>" + "<a onclick='sendButton(" + value.Question_ID + ")'>" + value.c_count + " comments</a></div>" + "<div class='actionbar'>" +
                    "<img onclick='reportButton(" + value.Question_ID + ")' src='images/advice/report.png'> </img>" +
                    "<img onclick='followButton(" + value.user_ID2 + ")' src='images/advice/followuser.png'></img>" +
                    "<img onclick='likeButton(" + value.Question_ID + ")' id='like-img" + value.Question_ID + "' src='images/advice/like.png'></img>" +
                    "<img onclick='sendButton(" + value.Question_ID + ")' src='images/advice/reply.png'></img>" + "</div></div>" + "</div><hr>");

            });

            //if fail it will give this error
        }, error: function (e) {
            popup("failed to work");
        }

    });

}


function filterMostView() {
    $.ajax({
        url: "http://localhost/api/Question/filtermostview.php",
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

                DOM.append("<div class='usercontainer'>" + "<div class='profileimage'>" + value.pImage + "</div><div class='username'>" + value.name + "</div>" + "</div>" + "<div class='question'>" +
                    "<p class='sub'>" + value.Subject + "</p><br>" + "<div class='content'>" + value.dImage + "<br>" + "<div class='desc'>" + value.Description + "</div>" + "</div><br>" + "<br><div class='usercontainer'>" +
                    "<div class='comment'>" + "<a onclick='sendButton(" + value.Question_ID + ")'>" + value.c_count + " comments</a></div>" + "<div class='actionbar'>" +
                    "<img onclick='reportButton(" + value.Question_ID + ")' src='images/advice/report.png'> </img>" +
                    "<img onclick='followButton(" + value.user_ID2 + ")' src='images/advice/followuser.png'></img>" +
                    "<img onclick='likeButton(" + value.Question_ID + ")' id='like-img" + value.Question_ID + "' src='images/advice/like.png'></img>" +
                    "<img onclick='sendButton(" + value.Question_ID + ")' src='images/advice/reply.png'></img>" + "</div></div>" + "</div><hr>");

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

    // setInterval(function () {
    //     load_unread_notification();
    // }, 5000);


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

                DOM.append("<div class='usercontainer'>" + "<div class='profileimage'>" + value.pImage + "</div><div class='username'>" + value.name + "</div>" + "</div>" + "<div class='question'>" +
                    "<p class='sub'>" + value.Subject + "</p><br>" + "<div class='content'>" + value.dImage + "<br>" + "<div class='desc'>" + value.Description + "</div>" + "</div><br>" + "<br><div class='usercontainer'>" +
                    "<div class='comment'>" + "<a onclick='sendButton(" + value.Question_ID + ")'>" + value.c_count + " comments</a></div>" + "<div class='actionbar'>" +
                    "<img onclick='reportButton(" + value.Question_ID + ")' src='images/advice/report.png'> </img>" +
                    "<img onclick='followButton(" + value.user_ID2 + ")' src='images/advice/followuser.png'></img>" +
                    "<img onclick='likeButton(" + value.Question_ID + ")' id='like-img" + value.Question_ID + "' src='images/advice/like.png'></img>" +
                    "<img onclick='sendButton(" + value.Question_ID + ")' src='images/advice/reply.png'></img>" + "</div></div>" + "</div><hr>");

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
            random();
        }

    });

}
///FOLLOW USER FUNCTIONALITY
function followButton(user_ID2) {
    var uID2 = user_ID2;
    var dataString = "uID2=" + uID2;

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
function popup(text) {
    //set popupText to the <p> tag in the div
    var popupText = $('#popuptext');
    //empty the <p> tag in case of prior pop ups
    popupText.empty();
    //append new text passed through the function to the <p> tag
    popupText.append(text);
    //show when pop up is called
    $('.hover_bkgr_fricc').show();
    //hide when the x is clicked or anywhere else on the page is clicked
    $('.hover_bkgr_fricc').click(function () {
        $('.hover_bkgr_fricc').hide();
    });
    $('.popupCloseButton').click(function () {
        $('.hover_bkgr_fricc').hide();
    });
}
