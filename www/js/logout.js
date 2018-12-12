function logout() {
    $.ajax({
        type: 'POST',
        url: "http://13.59.122.228/api/Account/logout.php",
        success: function (data) {
            popup("You are logging out");
            window.location.replace("login.html");
        }
    });

}