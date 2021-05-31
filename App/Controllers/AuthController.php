<?php

namespace App\Controllers;

use App\Models\User;

class AuthController {

    private $user;

    public function __construct()
    {
        // php-di ¯\_(ツ)_/¯
        $this->user = new User;
    }

    /**
     * @param string $login
     * @param string $password
     * @return array | bool
     */
    public function auth(string $login, string $password): array
    {
        $auth = $this->user->auth($login, $password);

        if (!$auth) abort("Incorrect login or password");

        return [
            'login' => $auth['username'],
            'password' => $auth['password']
        ];
    }

    public function login(): void
    {
        check_request_params_on_required([
            'username', 'password'
        ]);

        $user = $this->auth($_POST['username'], $_POST['password']);

        $_SESSION['login'] = $user['login'];
        $_SESSION['password'] = hash_make($user['password']);

        redirect('/admin/home');
    }

    public function logout(): void
    {
        session_destroy();

        redirect('/home/index');
    }

}