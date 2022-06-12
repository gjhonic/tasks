<?php

echo json_encode([
    'error' => false,
    'tasks' => [
        [
            'id' => 1,
            'title' => 'Покушать',
        ],
        [
            'id' => 2,
            'title' => 'Попить',
        ],
    ],
]);