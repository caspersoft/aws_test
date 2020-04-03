<?php

namespace App;

class Auth {

    public static function hashPassword($password)
    {
        $options = [ 'cost' => 12 ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public static function verifyPassword($password, $hash)
    {

        return (password_verify($password, $hash)) ? TRUE : FALSE;

    }

    public static function isAuth()
    {
        return (isset($_SESSION['user']) && $_SESSION['user']) ? TRUE : FALSE;
    }

    public static function logout()
    {
        
        unset($_SESSION['user']);

    }

    public static function login($user)
    {

        if (isset($user['password'])) unset($user['password']);

        $_SESSION['user'] = $user;
    }

    public static function getUser() 
    {
        return $_SESSION['user'] ?? FALSE;
    }

    public static function isAllow($operation) {

        $role = $_SESSION['user']['role'];

        $acl = [
            'Mother'    => [
                'view'       => TRUE,
                'done'       => TRUE,
                'distribute' => FALSE,
                'upload'     => TRUE
            ],
            'Father'    => [
                'view'       => TRUE,
                'done'       => TRUE,
                'distribute' => TRUE,
                'upload'     => FALSE
            ],
            'Child'    => [
                'view'       => TRUE,
                'done'       => TRUE,
                'distribute' => FALSE,
                'upload'     => FALSE
            ]
        ];

        return $acl[$role][$operation] ?? FALSE;
    }
}