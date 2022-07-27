<?php

/**
 * Устанавливает соеденение с БД
 * @param array $dbConfig
 * @param bool $showMessage
 * @return PDO|null
 */
function setConnection(array $dbConfig, bool $showMessage = false): ?PDO
{
    if(isset($dbConfig['dsn'])) {
        $dsn = $dbConfig['dsn'];
    } else {
        if($showMessage) {
            echo "Error: param dsn not set!\n";
        }
        return null;
    }

    if(isset($dbConfig['user'])) {
        $user = $dbConfig['user'];
    } else {
        if($showMessage) {
            echo "Error: param user not set!\n";
        }
        return null;
    }

    if(isset($dbConfig['pass'])) {
        $pass = $dbConfig['pass'];
    } else {
        if($showMessage) {
            echo "Error: pass dsn not set!\n";
        }
        return null;
    }

    try {
        return new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        if($showMessage) {
            echo "Error: " . $e->getMessage() . "\n";
        }
        return null;
    }
}