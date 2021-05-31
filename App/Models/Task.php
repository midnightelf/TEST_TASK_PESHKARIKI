<?php

namespace App\Models;
use PDO;

class Task extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create(array $task): bool
    {
        $sql = $this->conn->prepare('INSERT INTO `tasks` (`username`, `email`, `text`) VALUES(:username, :email, :text);');

        return $sql->execute([
           'username' => $task['username'],
           'email' => $task['email'],
           'text' => $task['text'],
        ]);
    }

    public function update(array $task): bool
    {
        $sql = $this->conn->prepare('UPDATE `tasks` SET `username`=:username, `email`=:email, `text`=:text WHERE `id`=:id;');

        return $sql->execute([
            'username' => $task['username'],
            'email' => $task['email'],
            'text' => $task['text'],
            'id' => $task['id']
        ]);
    }

    public function update_only(string $column, string $value, int $task_id): bool
    {
        // Table and Column names CANNOT be replaced by parameters in PDO by prepare
        $sql = "UPDATE `tasks` SET `$column`='$value' WHERE `id`=$task_id;";
        $query = $this->conn->query($sql);

        return true;
    }

    public function switch_status(int $task_id)
    {
        $sql = "SELECT `status` FROM `tasks` WHERE `id`=$task_id;";
        $query = $this->conn->query($sql);

        $status = $query->fetch(PDO::FETCH_LAZY)['status'];

        if ($status) $status = 0;
        else $status = 1;

        $sql = "UPDATE `tasks` SET `status`=$status WHERE `id`=$task_id;";

        return $this->conn->query($sql);
    }

    public function paginate(int $start, int $count, string $order_by): array
    {
        if (empty($order_by)) $order_by = 'id';

        $sql = "SELECT * FROM `tasks` ORDER BY `$order_by` LIMIT $start, $count";
        $query = $this->conn->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function total_count(): int
    {
        $sql = "SELECT COUNT(id) as `count` FROM tasks;";
        $query = $this->conn->query($sql);

        return $query->fetch(PDO::FETCH_LAZY)['count'];
    }

}