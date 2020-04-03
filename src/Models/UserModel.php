<?php

namespace App;

use PDO;

class UserModel extends Model {

    // Вход
    public function getByLogin($login) {
        
        $stmt = $this->db->prepare('SELECT * FROM user WHERE login = ?');
        $stmt->execute([$login]);

        return ($row = $stmt->fetch()) ? $row : FALSE;
    }

    public function register($login, $password, $role) {
        
        $sql = 'INSERT INTO user (login, password, role) VALUES (?, ?, ?)';
        $stmt = $this->db->prepare($sql);

        return ($stmt->execute([$login, $password, $role])) ? TRUE : FALSE;
    }

    public function getAllUsers()
    {
        $stmt = $this->db->query('SELECT id, login FROM user ORDER BY login');
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }

}
