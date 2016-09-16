/**
 * Created by sven on 16/09/2016.
 */

$(document).ready(function() {
    // Blueprint
    var blueprint = $("#blueprint").html();
    $("#blueprint").remove();

    $.ajax("https://lustrum.ch/api/ticket/get/all", {

    }).always(function(e, r) {
        $.each(e, function(k, v) {
            var ticket = blueprint;
            v.date = (new Date(v.date)).toLocaleDateString("nl-NL", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric"
            });
            v.amount = "&euro;" + v.amount.toFixed(2).replace(".", ",");
            $.each(v, function(key, value) {
                ticket = ticket.split("%" + key + "%").join(value);
            });

            $("#ticketContainer").append(ticket);
        })
    });
});