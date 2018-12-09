function logout() {
    $.ajax({
        type: 'POST',
        url: "http://10.0.2.2/api/Account/logout.php",
        success: function (data) {
            popup("You are logging out");
            window.location.replace("login.html");
        }
    });

}