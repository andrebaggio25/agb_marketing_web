<?php

declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

$appCfg = config('app');
date_default_timezone_set($appCfg['timezone'] ?? 'America/Sao_Paulo');

session_name($appCfg['session_name'] ?? 'agb_session');
session_start();

use App\Core\Request;
use App\Core\Router;

$request = Request::fromGlobals();

$router = new Router();
require APP_PATH . '/routes.php';
$router->dispatch($request);
