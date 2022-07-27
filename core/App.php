<?php

class App
{

    private static ?App $instance = null;

    private array $routes = [];
    public array $configDB = [];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Добавляет маршруты
     * @param array $routes
     * @return void
     */
    public function addRoutes(array $routes) {
        $this->routes = $routes;
    }

    /**
     * Добавляет конфиг подключения к бд
     * @param array $routes
     * @return void
     */
    public function addConfigDB(array $configDB) {
        $this->configDB = $configDB;
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

    /**
     * Метод возвращает json данные
     * @param array $data
     * @param int $status
     * @param bool $die
     * @return void
     */
    public function json(array $data, int $status = 0, bool $die = true)
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        if($die) {
            exit($status);
        }
    }
}