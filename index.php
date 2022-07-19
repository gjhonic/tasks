<?php

require_once 'core/libs/functions.php';

$routes =

$query = substr($_SERVER['REDIRECT_URL'], 1);

if(strripos($query, 'backend/actions/') !== false) {
    require_once $query;
} else {
    if(isset($routes[$query])) {
        require_once 'controllers/' . $routes[$query] . '.php';
    } else {
        require_once 'core/pages/404.php';
    }
}

