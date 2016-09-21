<?php

use Controller\OrderController;

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

// We're still developing
error_reporting(E_ALL);
ini_set('display_errors', true);

// Autoload
require "../vendor/autoload.php";
require "autoload.php";
require "config.php";

// Webhook
$order = new OrderController();
$order->updatePayment($_POST['id']);