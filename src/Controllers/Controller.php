<?php

namespace App;

class Controller {

    protected $request;
    protected $models = [];

    public function __construct($request)
    {
        $this->request = $request;

        $this->models['UserModel'] = new UserModel;
    }

    protected function setFlash($type, $message)
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    protected function redirect($path)
    {
        header('Location: '.$path);
        exit;
    }
}
