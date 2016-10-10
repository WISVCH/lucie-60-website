
$(document).ready(function() {
    $("#input").keyup(function() {
        var input = $(this).val();
        if (input.length == 6) {
            $.ajax('https://lustrum.ch/api/ticket/scan', {
                method: "POST",
                data: {
                    number: input,
                    ticket: $("#ticket").val()
                }
            }).done(function(e, t) {
                var body = $("body");
                var message = $("#message");
                if (e.status == 403 || e.status == 405) {
                    body.css("background-color", "#F05F40");
                    message.html(e.message);

                    setTimeout(function(){
                        body.css("background-color", "#fff");
                        $("#input").val("");
                        message.html("");
                    }, 2000);
                } else if (e.status == 406) {
                    body.css("background-color", "orange");
                    message.html(e.message);

                    setTimeout(function(){
                        body.css("background-color", "#fff");
                        $("#input").val("");
                        message.html("");
                    }, 2000);
                } else {
                    body.css("background-color", "green");
                    message.html(e.user_name);

                    setTimeout(function(){
                        body.css("background-color", "#fff");
                        $("#input").val("");
                        message.html("");
                    }, 5000);
                }
                console.log(e);
            });
        }
    });
});