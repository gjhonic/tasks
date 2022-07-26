<?php

// Paths
define('ROOT_PATH', dirname(dirname(__DIR__)));

$words = require ROOT_PATH . '/config/words.php';

/**
 * Возвращает значения по ключу из словаря $words
 * @param string $message
 * @return string
 */
function ts(string $message): string
{
    if (isset($words[$message])) {
        return $words[$message];
    } else {
        return $message;
    }
}