<?php

/**
 * Класс статусов задачи
 */
class Status {

    public const STATUS_NEW = 1;
    public const STATUS_ACTIVE = 2;
    public const STATUS_TEST = 3;
    public const STATUS_PAUSE = 4;
    public const STATUS_CLOSED = 5;

    /**
     * Мап статусов
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'new',
            self::STATUS_ACTIVE => 'active',
            self::STATUS_TEST => 'test',
            self::STATUS_PAUSE => 'pause',
            self::STATUS_CLOSED => 'closed',
        ];
    }

    /**
     * Возвращает Id-ки статусов
     * @return array
     */
    public static function getStatusIds(): array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_ACTIVE,
            self::STATUS_TEST,
            self::STATUS_PAUSE,
            self::STATUS_CLOSED,
        ];
    }

    /**
     * Возвращает статус
     * @param int $id
     * @return string
     */
    public static function getStatus(int $id): string
    {
        return self::getStatuses()[$id] ?? '';
    }
}