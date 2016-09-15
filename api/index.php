<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

use Controller\OrderController;
use Controller\TicketController;
use Slim\Http\Request;
use Slim\Http\Response;

// Autoload
require "../vendor/autoload.php";
require "autoload.php";
require "config.php";

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$app->group('/order', function () {
    $this->post('/create', function (Request $request, Response $response, $args) {
        $order = new OrderController();

        $result = $order->create($request->getParsedBody()['data']);
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
        $this->get('/all', function ($request, $response, $argd) {
            $tickets = new TicketController();

            return $response->withJson($tickets->getAllAvailableTickets());
        });
    });
});

$app->run();
