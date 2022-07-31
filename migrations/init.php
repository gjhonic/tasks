<?php

/**
 * Скрипт создает таблицы
 * @return bool
 */
function scriptInit(array $dbConfig): bool
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
        //Создаем таблицу с ветками
        $sql = "CREATE TABLE `branches`
            ( `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id ветки',
             `name` varchar(255) NOT NULL COMMENT 'Название ветки',
             `comment` text COMMENT 'Коментарий',
             `created_at` INT NOT NULL DEFAULT 0 COMMENT 'Дата создания ветки',
             `updated_at` INT NOT NULL DEFAULT 0 COMMENT'Дата изменения ветки',
             PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $dbConn->exec($sql);

        echo "Table branches success created!\n";

        //Создаем таблицу с задачами
        $sql = "CREATE TABLE `tasks`
            (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
             `number` INT UNSIGNED NOT NULL COMMENT 'Номер задачи',
             `name` varchar(255) NOT NULL COMMENT 'Название задачи',
             `branch_id` INT UNSIGNED NULL COMMENT 'Ветка',
             `comment` text COMMENT 'Коментарий',
             `status` INT UNSIGNED NOT NULL COMMENT 'Статус задачи',
             `created_at` INT NOT NULL DEFAULT 0 COMMENT 'Дата создания задачи',
             `updated_at` INT NOT NULL DEFAULT 0 COMMENT'Дата изменения задачи',
             PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $dbConn->exec($sql);

        echo "Table tasks success created!\n";

        //Создаем таблицу с заметками
        $sql = "CREATE TABLE `notes`
            (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
             `task_id` INT UNSIGNED NULL COMMENT 'Задача',
             `comment` text NOT NULL COMMENT 'Заметка',
             `created_at` INT NOT NULL DEFAULT 0 COMMENT 'Дата создания заметки',
             PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $dbConn->exec($sql);

        echo "Table notes success created!\n";
        return true;
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "\n";
        return false;
    }
}