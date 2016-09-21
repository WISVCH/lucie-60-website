/**
 * Created by sven on 16/09/2016.
 */

$(document).ready(function () {
    // Localstorage
    var ticketdb = localStorage.getItem('ticketdatabase');
    var tickets = (null == ticketdb || "" == ticketdb) ? [] : JSON.parse(ticketdb);

    // Blueprint
    var blueprint = $('#blueprint').html();
    $("#blueprint").remove();
    var tableRow = "<tr><td>%ticketNumber%</td><td><h4>%ticketName%</h4><span>%name%" +
        " &lt;%email%&gt;</span></td><td>%amount%</td></tr>";

    //
    updateBasket();

    $.ajax("https://lustrum.ch/api/ticket/get/all").always(function (e, r) {
        $.each(e, function (k, v) {
            var ticket = blueprint;
            v.date = (new Date(v.date)).toLocaleDateString("nl-NL", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric"
            });
            v.amount = "&euro; " + v.amount.toFixed(2).replace(".", ",");
            $.each(v, function (key, value) {
                ticket = ticket.split("%" + key + "%").join(value);
            });

            $("#ticketContainer").append(ticket);
        })
    });

    $('#ticketModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var key = button.data('key');
        var name = button.data('ticket');
        var amount = button.data('amount');

        var model = $(this);
        model.find("#ticketKey").val(key);
        model.find("#ticketName").val(name);
        model.find("#ticketAmount").val(amount);
        model.find("#modalLabel").html(name);
    });

    $('#addTicketToBasket').click(function() {
        var name = $('#ticketUserName').val();
        var email = $('#ticketEmail').val();
        var key = $('#ticketKey').val();
        var ticketName = $('#ticketName').val();
        var amount = $('#ticketAmount').val();

        tickets.push({
            name: name,
            email: email,
            key: key,
            ticketName: ticketName,
            amount: amount
        });
        localStorage.setItem('ticketdatabase', JSON.stringify(tickets));

        // Hide modal and update basket badge
        $('#ticketModal').modal('hide');
        updateBasket();
    });

    $('#toCheckout').on('click', function() {
        $.ajax("https://lustrum.ch/api/order/create", {
            method: "POST",
            data: {
                data: JSON.parse(localStorage.getItem('ticketdatabase'))
            }
        }).done(function(e, r) {
            var json = JSON.parse(e);
            if (200 == json.status) {
                localStorage.setItem('ticketdatabase', []);
                var count = 5;
                setInterval(function(){
                    $('#checkTimeOut').show();
                    $('#checkTimeOut').html("You will be redirected to iDeal in " + count + " seconds. Or <a href='" + json.redirect_url +"'>click" +
                        " here</a> if nothing happens.");
                    count--;

                    if (count < 0) {
                        $('#checkTimeOut').hide();
                        window.location.replace(json.redirect_url);
                    }
                },1000);
            }
        });
    });

    function updateBasket() {
        //Badge
        $("#ticketBadge").html(tickets.length);

        // Basket
        var basket = $("#basketBody");
        var sum = 0;
        basket.html("");
        $.each(tickets, function(k, v) {
            var ticket = tableRow;
            sum += parseInt(v.amount.split("€")[1]);
            v.ticketNumber = k + 1;
            $.each(v, function (key, value) {
                ticket = ticket.split("%" + key + "%").join(value);
            });
            basket.append(ticket);
        });

        // Transactie cost
        if (0 != sum) {
            sum += 0.29;
            basket.append("<tr><td>#</td><td><h4>Transaction fee</h4></td><td>&euro; 0,29</td></tr>");
        } else {
            basket.append("<tr><td colspan='4'>Basket is empty</td>")
        }

        // Total
        $('#tableTotal').html(sum.toFixed(2).replace(".", ","));
    }
});