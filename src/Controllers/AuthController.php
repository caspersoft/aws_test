<?php

namespace App;

class AuthController extends Controller {

    public function login()
    {
        if (Auth::isAuth()) $this->redirect('/');

        if ('POST' === $this->request->getRequestMethod())
        {
            $login    = filter_input(INPUT_POST, 'login',    FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($login && $password)
            {
                $user = $this->models['UserModel']->getByLogin($login);
                
                if ($user)
                {
                    if (Auth::verifyPassword($password, $user['password']))
                    {
                        Auth::login($user);
                        $this->redirect('/');
                    }
                }
                
                $this->setFlash('danger', 'Попытка входа не удалась!');
            }
        }

        echo $this->loginPage();
    }

    public function logout()
    {
        if (!Auth::isAuth()) $this->redirect('/login');

        Auth::logout();
        $this->redirect('/login');
        exit();
    }

    public function register()
    {
        if ('POST' === $this->request->getRequestMethod())
        {
            $login      = filter_input(INPUT_POST, 'login',     FILTER_SANITIZE_SPECIAL_CHARS);
            $password   = filter_input(INPUT_POST, 'password',  FILTER_SANITIZE_SPECIAL_CHARS);
            $password2  = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
            $role       = filter_input(INPUT_POST, 'role',      FILTER_SANITIZE_SPECIAL_CHARS);

            if ($password !== $password2) {

                $this->setFlash('danger', 'Пароли не совпадают! Попробуйте еще раз!');
                
                echo $this->registerPage($login);

                return;
            }

            if ($login && $password && $role)
            {
                $password = Auth::hashPassword($password);

                $res = $this->models['UserModel']->register($login, $password, $role);
                
                if ($res) {
                    $this->setFlash('success', 'Поздравляем, Вы зарегистрированы!');
                    $this->redirect('/login');
                }
            }
        }

        echo $this->registerPage();
    }

    protected function loginPage() {
        $tpl = new Template('templates/header');
        $tpl->set('title', 'Login Page');
        $header = $tpl->render(TRUE);

        $tpl = new Template('templates/footer');
        $footer = $tpl->render(TRUE);

        $tpl = new Template('login');
        $tpl->set('header', $header);
        $tpl->set('footer', $footer);
        $tpl->render();
    }

    protected function registerPage($login = "") {
        $tpl = new Template('templates/header');
        $tpl->set('title', 'Create Account');
        $header = $tpl->render(TRUE);

        $tpl = new Template('templates/footer');
        $footer = $tpl->render(TRUE);

        $tpl = new Template('register');
        $tpl->set('header', $header);
        $tpl->set('footer', $footer);
        $tpl->set('login',  $login);
        $tpl->render();
    }
}
