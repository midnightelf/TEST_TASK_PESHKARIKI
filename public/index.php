<?php

require_once '../App/Core/bootstrap.php';

session_start();

use App\Core\Router;

if ($_SERVER['REQUEST_URI'] === '/') header('location: /home/index');

$router = new Router();