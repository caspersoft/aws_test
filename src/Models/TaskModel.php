<?php

namespace App;

use PDO;

class TaskModel extends Model {

    public function getAllTasks()
    {
        $stmt = $this->db->query('SELECT * FROM task ORDER BY is_done, created DESC');
        return $stmt->fetchAll();
    }

    public function doneTask($id)
    {
        $stmt = $this->db->prepare('UPDATE task SET is_done=1 WHERE id=?');
        return $stmt->execute([$id]);
    }

    public function distributeTask($id, $user_id)
    {
        $stmt = $this->db->prepare('UPDATE task SET user_id=? WHERE id=?');
        return $stmt->execute([$user_id, $id]);
    }

}