function logout() {
    $.ajax({
        type: 'POST',
        url: "http://localhost/api/Account/logout.php",
        success: function (data) {
            popup("You are logging out");
            window.location.replace("login.html");
        }
    });

}