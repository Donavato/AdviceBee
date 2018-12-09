
var Question_ID = sessionStorage.questionID;

$(document).ready(function () {
    var dataString = "Question_ID=" + Question_ID;
    /////LIST ADVICES GIVEN FOR EACH PARTICULAR QUESTION/////////////////////////
    $.ajax({
        url: "http://10.0.2.2/api/Advice/listadvices.php",
        type: "POST",
        dataType: "json",
        data: dataString,
        //on success it will call this function
        success: function (data) {
            // check if answers should be displayed for other users
            if (data == "Responses Private") {
                popup("Responses Private");
            } else {
                // append all the answers to specified ID
                var advices = $('#advices');
                data = JSON.parse(JSON.stringify(data));
                $.each(data, function (key, value) {

                    value.dImage = (value.pImage === "<img src = >") ? '' : value.pImage;
                    advices.append(`
                    <div class="post advice">
                        ${value.pImage}
                        <div class="main-body">
                            <div class="post-header">
                                <span>${value.name}</span>
                            </div>
                            <div class="post-body">
                                    <div class="description">${value.advice}</div>
                            </div>
                            <div class="post-footer" style="font-size: 1.3rem;">
                                <div>
                                <i class="far fa-heart" onclick="likeButton(${value.advice_id})"></i>${value.likes}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    `)

                });
            }
        }, error: function (e) {
            popup("failed to work");
        }
    });
    ////////////////////////////////////////////////////////////////////////////////

    var questionType;

    // Display question
    $.ajax({
        url: "http://10.0.2.2/api/Advice/Advice.php",
        type: "POST",
        dataType: "json",
        data: dataString,
        //on success it will call this function
        success: function (data) {
            var Obj = JSON.parse(JSON.stringify(data));
            var Question = $('#Question');
            var uImage = (Obj[0].pImage === "<img src = >") ? '' : Obj[0].pImage;
            var dImage = (Obj[0].dImage === "<img src = >") ? '' : Obj[0].dImage;
                // Display the question without an image 
            if(!dImage){    
                    console.log("Image source is empty");
                    Question.append(`
                    <div class="post Question">
                        ${uImage}
                        <div class="main-body">
                            <div class="post-header">
                                <span>${Obj[0].name}</span>
                                <div class="subject">${Obj[0].Subject}</div>
                            </div>
                            <div class="post-body">
                                    <div class="description">${Obj[0].Description}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    `)
                    }
                    else {
                        // Display the question with an image
                        console.log("Image source exists!");
                        Question.append(`
                    <div class="post Question">
                        ${uImage}
                        <div class="main-body">
                            <div class="post-header">
                                <span>${Obj[0].name}</span>
                                <div class="subject">${Obj[0].Subject}</div>
                            </div>
                            <div class="post-body">
                                    ${Obj[0].dImage}
                                    <div class="description">${Obj[0].Description}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    `)
                    }
            // CHECK QUESTION TYPE, OUTPUT FORM ADVICE DEPENDING ON THAT TYPE

            if (Obj[0].question_type == "Yes or No") {
                document.getElementById("advice").innerHTML = "Yes: " + "<input type='radio' name='advice' value='Yes' id='1' />" + "<br>" + "No: " + "<input type='radio' name='advice' value='No' id='2' />";
            } else if (Obj[0].question_type == "True or False") {
                document.getElementById("advice").innerHTML = "True: " + "<input type='radio' name='advice' value='True' />" + "<br>" + "False: " + "<input type='radio' name='advice' value='False' />";
            } else if (Obj[0].question_type == "Description") {
                document.getElementById("advice").innerHTML = "<div id='Description'" + "Advice: " + "<br>" + "<textarea id='Description1' class='DescriptionAdvice' maxlength='140' name='advice'>" + "</textarea>" + "<br>" + "</div>" +
                    "<p class='charactercount'>" + "<span id='wordCount'>" + '140' + "</span>/140</p>";
            } else if (Obj[0].question_type == "Multiple") {
                GetMultiple();
            } 
            else {
                document.getElementById("advice").innerHTML = "Error";
            }

            questionType = Obj[0].question_type;
            //if fail it will give this error
        }, error: function (e) {
            popup(JSON.stringify(e));
        }
    });
    // Call API to get multiple choice answer choices from DB
    function GetMultiple(){
        var dataString = "Question_ID=" + Question_ID;
        /////LIST ADVICES GIVEN FOR EACH PARTICULAR QUESTION/////////////////////////
        $.ajax({
            url: "http://10.0.2.2/api/Advice/multipleChoices.php",
            type: "POST",
            dataType: "json",
            data: dataString,
            //on success it will call this function
            success: function (data) {

                    //Append the choices dynamically 
                    var multichocies = $('#advice');
                    data = JSON.parse(JSON.stringify(data));
                    $.each(data, function (key, value) {
                        multichocies.append(`
                        <div>
                            ${value.option_value} <input type='radio' name='advice' value='${value.option_value}'/>
                        </div>
                        `)

                    });
    
            }, error: function (e) {
                popup("failed to work");
            }
        });
        
    }
    // On submit send the answer to DB
    $('#submit').on('click', function (e) {
        e.preventDefault()
        var advice;
        if (questionType == "Yes or No") {
            advice = $("input[type=radio][name=advice]:checked").val();

        } else if (questionType == "True or False") {
            advice = $("input[type=radio][name=advice]:checked").val();
        } else if (questionType == "Description") {
            advice = $("#Description1").val();

        }else if (questionType == "Multiple") {
            advice = $("input[type=radio][name=advice]:checked").val();
        }
         else {
            popup("No Question Type Selected");
        }

        //if no answer is inserted
        if(typeof advice == 'undefined' || advice == '')
        {
            popup('You must make a choice');
            setTimeout(() => window.location.replace("advice.html"), 500);
        }
        else
        {
            var dataString = "Question_ID=" + Question_ID + "&advice=" + advice;
            //Send answer to DB
            $.ajax({
                url: "http://10.0.2.2/api/Advice/giveAdvice.php",
                type: "POST",
                dataType: "json",
                data: dataString,
                success: function (data) {
                    popup("Thank you for the advice!");
                    window.location.replace("index.html");
                }, error: function (e) {
                    popup(JSON.stringify(e));
                }
            });
        }
    });
});

///////////////LIKE FUNCTION FOR ADVICES GIVEN///////////////////////
function likeButton(advice_id) {
    var advice_ID = advice_id;

    var dataString = "advice_ID=" + advice_ID;
    $.ajax({
        url: "http://10.0.2.2/api/Advice/likeadvice.php",
        type: "POST",
        dataType: "json",
        data: dataString,
        //on success it will call this function
        success: function (data) {
            data = JSON.parse(JSON.stringify(data));
            console.log(data);
            popup(data);
            updateLikes();
        }

    });

    $('#like-img' + advice_ID).attr('src', 'images/advice/liked.png');
}

function updateLikes() {
    var dataString = "Question_ID=" + Question_ID;

    $.ajax({
        url: "http://10.0.2.2/api/Advice/listadvices.php",
        type: "POST",
        dataType: "json",
        data: dataString,
        //on success it will call this function
        success: function (data) {
            var advices = $('#advices');
            document.getElementById("advices").innerHTML = "";
            $.each(data, function (key, value) {

                value.dImage = (value.pImage === "<img src = >") ? '' : value.pImage;
                    advices.append(`
                    <div class="post">
                        ${value.pImage}
                        <div class="main-body">
                            <div class="post-header">
                                <span>${value.name}</span>
                            </div>
                            <div class="post-body">
                                    <div class="description">${value.advice}</div>
                            </div>
                            <div class="post-footer" style="font-size: 1.3rem;">
                                <div>
                                <i class="far fa-heart" onclick="likeButton(${value.advice_id})"></i>${value.likes}
                                </div>
                            </div>
                        </div>
                    </div>
                    `)
                    
            });


        }, error: function (e) {
            popup("failed to work");
        }
    });

}

//add event for each time a key is released to run the function for form character count
document.addEventListener("keyup", function (e) {
    if (e.target && e.target.id == "Description1") {
        var numOfCharacters = e.target.value.split('');
        wordCounts = 140 - numOfCharacters.length;
        document.getElementById("wordCount").innerText = wordCounts;
    }
});