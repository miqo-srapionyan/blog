<?php

namespace controllers;

use core\Controller;
use models\Users;
use core\Session;

class UsersController extends Controller
{

    public function postRegister()
    {

        if (isset($this->post['submit'])) {

            $user = new Users();

            if ($user->getUserByEmail($this->post['email'])) {
                $this->redirect('/register');
                return;
            }
            $user->registerUser($this->post);

            $data = $user->getUserByEmail($this->post['email']);

            unset($data['password']);
            Session::set('user', $data[0]);

            $this->redirect('/');
        }


    }

    public function register()
    {

        $this->view->render('users/register');
    }

    public function login()
    {

        $this->view->render('users/login');

    }

    public function postLogin()
    {
        $user = new Users();
        $email = $this->post['email'];
        $password = $this->post['password'];

        if (!empty($this->post['role'])) {
            $data = $user->getUserByEmail($email, 'admin');
        } else {
            $data = $user->getUserByEmail($email);
        }
        $data = $data[0];

        if (password_verify($password, $data['password'])) {
            unset($data['password']);
            Session::set('user', $data);

            if ($data['role'] == 'user') {

                $this->redirect('/');
            } else if ($data['role'] == 'admin') {

                $this->redirect('/dashboard');
            }

        }

        // Redirect back
        //$this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function logout()
    {
        Session::set('user', null);
        $this->redirect('/login');
    }
}