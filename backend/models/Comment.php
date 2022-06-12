<?php

class Comment {
    public int $id;
    public string $name;
    public int $status_id;
    public int $branch_id;
    public string $created_at;
    public string $updated_at;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Метод валидирует данные
     * @return bool
     */
    public function validation(): bool
    {
        if ($this->name === null) {
            return false;
        }

        if (trim($this->name) === '') {
            return false;
        }

        return true;
    }

    /**
     * Метод сохраняет ветку
     * @return bool
     */
    public function create(): bool
    {
        if ($this->validation() === false) {
            return false;
        }

        if ($this->id !== 0) {
            return false;
        }

        $date = new DateTime();
        $datetime = $date->format("Y-m-d H:i:s");

        $this->created_at = $datetime;
        $this->updated_at = $datetime;


        $result = $this->db->exec(
            'INSERT INTO  branchs (name, created_at, update_at) VALUES ("' . $this->name . '", "' . $this->created_at . '", "' . $this->updated_at .  '")'
        );

        if($result === false) {
            return false;
        }

        //TODO в id сохранить
    }
}