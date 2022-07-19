<?php

require_once '../core/libs/functions.php';
require_once '../core/app.php';

$routes = require ROOT_PATH . '/config/routes.php';

$query = $_SERVER['QUERY_STRING'];

$app = new App();
$app->addRoutes($routes);
$app->run($query);


