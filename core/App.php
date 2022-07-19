<?php

class App
{
    private $routes = [];

    /**
     * Добавляет маршруты
     * @param array $routes
     * @return void
     */
    public function addRoutes(array $routes) {
        $this->routes = $routes;
    }

    /**
     * Находит подходящий маршрут
     * @param string $query
     * @return void
     */
    public function run(string $query)
    {
        if (strripos($query, 'backend/actions/') !== false) {
            require_once ROOT_PATH . '/' . $query;
        } else {
            if (isset($this->routes[$query])) {
                require_once ROOT_PATH . '/controllers/' . $this->routes[$query] . '.php';
            } else {
                require_once ROOT_PATH . '/public/404.html';
            }
        }
    }
}