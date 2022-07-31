<?php

/**
 * Скрипт заполняет таблицы тестовыми данными
 * @return bool
 */
function scriptSeed(array $dbConfig): bool
{
    $dbConn = setConnection($dbConfig, true);

    if($dbConn !== null) {
        echo "Successfully connected to the database\n";
    } else {
        echo "Failed to connect to the database\n";
        return false;
    }

    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {

        echo "Add data to tables\n";

        return true;
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "\n";
        return false;
    }
}