<?php
setlocale(LC_MONETARY, 'nl_NL.UTF-8');

// Autoload
require "../../../vendor/autoload.php";
require "../../autoload.php";
require "../../config.php";

$tickets = new \Controller\TicketController();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=0, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <title>12th Lustrum | Dashboard Scanner</title>

    <style>
        html, body {
            overflow: hidden;
        }

        body {
            position: relative
            display: block;

            overflow: hidden;
            width: calc(100vw - 32px);
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        form {
            margin: 50px 0;
            width: 100%;
            padding: 0;
        }

        input {
            width: 100%;
            font-size: 54px;
            border: 0;
            border-bottom: 3px solid #000;
            border-radius: 0;
            background-color: rgba(0, 0, 0, 0);
        }

        p {
            text-align: center;
            font-size: 24px;
            font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
        }

        select {
            background: rgba(0, 0, 0,0);
            border: 0px;
            width: 100%;
            font-size: 32px;
        }

        select option {
            font-size: 32px;
        }
    </style>
</head>
<body>


<form action="">
    <div class="form-group">
        <select name="" id="ticket" class="form-control">
            <?php
            foreach ($tickets->getTickets() as $ticket) {
                echo "<option value='".$ticket->getKey()."'>".$ticket->getName()."</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <p class="alert" id="message"></p>
        <input type="number" class="form-control" step="1" id="input" />
    </div>
</form>

<!-- jQuery -->
<script src="/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Custom JavaScript -->
<script src="/api/admin/js/scan.js"></script>
</body>
</html>