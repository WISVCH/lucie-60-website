<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

use Controller\OrderController;
use Controller\TicketController;
use Slim\App;
use Slim\Container;

// Autoload
require "../vendor/autoload.php";
require "autoload.php";
require "config.php";

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new Container($configuration);
$app = new App($c);

$app->group('/order', function () {
    $this->post('/create', function($request, $response, $args) {
        $order = new OrderController();

        $result = $order->create($request->getParsedBody()['tickets']);
        $response->withJson([
                "status" => 200,
                "message" => "Order succesfull",
                "redirect_url" => $result]
        );

        return $response;
    });
});

$app->group('/ticket', function () {
    $this->group('/get', function () {
        $this->get('/all', function ($request, $response, $args) {
            $tickets = new TicketController();

            return $response->withJson($tickets->getAllAvailableTickets());
        });
    });
});

$app->run();
