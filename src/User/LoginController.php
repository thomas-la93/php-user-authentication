<?php

namespace App\User;

use App\Core\abstractController;

class LoginController extends abstractController
{
    public function __construct(
        LoginService $loginService
    ) {
        $this->loginService = $loginService;
    }

    public function dashboard()
    {
        if ($this->loginService->check()) {
            $this->render('user/dashboard', [
                'username' => $_SESSION['login']
            ]);
        } else{
            header('Location: login');
        }
    }

    public function logout()
    {
        $this->loginService->logout();
        header('Location: login');
    }
    public function login()
    {
        $error = false;
        if ($this->loginService->check()) {
            header('Location: dashboard');
        }
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->loginService->attempt($username, $password)) {
                header('Location: dashboard');
                return;
            } else {
                $error = true;
            }
        }
        $this->render('user/login', [
            'error' => $error
        ]);
    }
}
