<?php
use \Includes\Classes\Controllers as Controller;


$app->get('/', Controller\HomeController::class . ':home');

$app->get('/contact/', Controller\HomeController::class . ':contact');