<?php

require_once '../core/libs/functions.php';
require_once '../core/libs/db.php';
require_once '../core/app.php';

$routes = require ROOT_PATH . '/config/routes.php';

$configDB = require_once ROOT_PATH . '/config/db.php';

$query = $_SERVER['QUERY_STRING'];

$app = App::getInstance();
$app->addRoutes($routes);
$app->addConfigDB($configDB);
$app->run($query);


