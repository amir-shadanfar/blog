<?php

namespace App\Controllers;

use App\Repositories\Eloquent\UserRepositoryInterface;

class AuthController extends Controller
{
    /**
     * @param \App\Repositories\Eloquent\UserRepositoryInterface $userRepository
     */
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @return void
     */
    public function login_page()
    {
        if (isset($_SESSION['user_id'])) {
            header('location: /');
        }
        $this->render(ROOT_PATH . '/templates/login.php');
    }

    /**
     * @return void
     */
    public function register_page()
    {
        if (isset($_SESSION['user_id'])) {
            header('location: /');
        }
        $this->render(ROOT_PATH . '/templates/register.php');
    }

    /**
     * @return void
     */
    public function login()
    {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->userRepository->login($email, $password);
        } catch (\Throwable $e) {
            // set message on session
            $message = $e->getMessage();
        }
        header('location: /login');
    }

    /**
     * @return void
     */
    public function logout()
    {
        session_destroy();
    }

    /**
     * @return void
     */
    public function register()
    {
        try {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->userRepository->register($name, $email, $password);
        } catch (\Throwable $e) {
            // set message on session
            $message = $e->getMessage();
        }
        header('location: /register');
    }
}