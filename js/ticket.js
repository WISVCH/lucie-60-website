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
        " &lt;%email%&gt;</span></td><td>%amount%</td><td><a class='removeTicket' data-key='%ticketNumber%'><i" +
        " class='fa" +
        " fa-remove fa-fd'></i></a></td></tr>";

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
            v.diff_sold = v.max_sold - v.sold;
            v.hidden = (v.max_hidden == 1) ? "style='display: none;'" : "";
            $.each(v, function (key, value) {
                ticket = ticket.split("%" + key + "%").join(value);
            });

            $("#ticketContainer").append(ticket);
        })
    });

    $('#checkboxCH').change(function() {
        if(this.checked) {
            $("#addTicketToBasket").prop('disabled', false);
        } else {
            $("#addTicketToBasket").prop('disabled', true);
        }
    });

    $('#ticketModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var key = button.data('key');
        var name = button.data('ticket');
        var amount = button.data('amount');
        var required = button.data('required');

        var model = $(this);
        model.find("#ticketKey").val(key);
        model.find("#ticketName").val(name);
        model.find("#ticketAmount").val(amount);
        model.find("#modalLabel").html(name);

        if ("1" == required) {
            model.find("#requiredCH").show();
            $("#checkboxCH").prop('checked', false);
            model.find("#addTicketToBasket").prop('disabled', true);
        } else {
            model.find("#requiredCH").hide();
            model.find("#addTicketToBasket").prop('disabled', false);
        }
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

    $('#basketBody').on('click', '.removeTicket', function(event) {
        var button = $(event.currentTarget);
        removeTicket(button.data('key'));
    });

    $('#toCheckout').on('click', function() {
        var timeOut = $('#checkTimeOut');

        if (null == tickets || 0 == tickets.length) {
            timeOut.show();
            timeOut.addClass('alert-warning');
            timeOut.html("Not possible to checkout, basket is empty!");
            return false;
        }
        $.ajax("https://lustrum.ch/api/order/create", {
            method: "POST",
            data: {
                tickets: JSON.parse(localStorage.getItem('ticketdatabase'))
            }
        }).done(function(e, r) {
            var json = JSON.parse(e);
            if (200 == json.status) {
                localStorage.setItem('ticketdatabase', []);
                var count = Math.floor(2 + 5 * Math.random());
                setInterval(function(){
                    timeOut.show();
                    timeOut.html("You will be redirected to iDeal in " + count + " seconds. Or <a href='" + json.redirect_url +"'>click" +
                        " here</a> if nothing happens.");
                    count--;

                    if (count < 0) {
                        timeOut.hide();
                        window.location.replace(json.redirect_url);
                    }
                },1000);
            } else {
                timeOut.show();
                timeOut.addClass('alert-danger');
                timeOut.html(json.message);
            }
        });
    });

    function updateBasket() {
        //Badge
        $("#ticketBadge").html(tickets.length);

        // Basket
        var basket = $("#basketBody");
        var sum = 0.0;
        basket.html("");
        $.each(tickets, function(k, v) {
            var ticket = tableRow;
            sum += parseFloat(v.amount.replace(",", ".").split("€")[1]);
            v.ticketNumber = k + 1;
            $.each(v, function (key, value) {
                ticket = ticket.split("%" + key + "%").join(value);
            });
            basket.append(ticket);
        });

        // Transactie cost
        if (0 != sum) {
            sum += 0.35;
            basket.append("<tr><td>#</td><td><h4>Transaction fee</h4></td><td>&euro; 0,35</td><td></td></tr>");
        } else {
            basket.append("<tr><td colspan='4'>Basket is empty</td>")
        }

        // Total
        $('#tableTotal').html(sum.toFixed(2).replace(".", ","));
    }

    function removeTicket(ticketKey) {
        var new_tickets = [];
        $.each(tickets, function(k, v) {
            console.log(k);
            console.log(ticketKey);
            if (ticketKey - 1 != k) {
                new_tickets.push(v);
            }
        });

        tickets = new_tickets;
        localStorage.setItem('ticketdatabase', JSON.stringify(new_tickets));
        updateBasket();
    }
});