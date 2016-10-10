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

        try {
            $result = $order->create($request->getParsedBody()['tickets']);
            $response->withJson([
                    "status" => 200,
                    "message" => "Order succesfull",
                    "redirect_url" => $result
                ]);
        } catch (Exception $e) {
            $response->withJson([
                    "status" => $e->getCode(),
                    "message" => $e->getMessage()
                ]);
        }

        return $response;
    });

    $this->post('/webhook/', function($request, $response, $argd) {
        $order = new OrderController();
        $order->updatePayment($request->getParsedBody()['id']);
    });
});

$app->group('/ticket', function () {
    $this->group('/get', function () {
        $this->get('/all', function ($request, $response, $args) {
            $tickets = new TicketController();

            return $response->withJson($tickets->getAllAvailableTickets());
        });
    });

    $this->post('/scan', function($request, $response, $args) {
        $tickets = new TicketController();

        try {
            return $response->withJson(
                $tickets->getTicketByUID(
                    $request->getParsedBody()['number'],
                    $request->getParsedBody()['ticket']
                )
            );
        } catch (Exception $e) {
            return $response->withJson([
                "status" => $e->getCode(),
                "message" => $e->getMessage()
            ]);
        }
    });
});

$app->run();
