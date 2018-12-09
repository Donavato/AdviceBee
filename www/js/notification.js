//on ready list notifications from DB
$(document).ready(function () {
    function load_unread_notification(view = "") {

        //JUST HAVE THIS KEEP TRACK OF NOTIFICATION ON ICON
        $.ajax({
            url: "http://10.0.2.2/api/notification/loadnotification.php",
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
});