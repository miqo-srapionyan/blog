<?php

namespace core;


use core\View;
use core\Session;


class Controller
{
    use \core\traits\Helper;

    protected $view;
    protected $post;

    function __construct()
    {
        $this->view = new View;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['description'])) {
                $p = $_POST['description'];
                unset($_POST['description']);
                $this->post = filter_var_array($_POST, FILTER_SANITIZE_STRING);
                $this->post['description'] = $p;
            } else {
                $this->post = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            }

        }
    }

    protected function bcrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /*
        Validation

        $types - [
            'email' => 'email|min:8|max:10'
        ]
    */
    protected function validate($items, $types)
    {
        $errors = [];
        foreach ($items as $input_name => $input) {
            $each_types = explode('|', $types[$input_name]);
            $errors[$input_name] = [];
            foreach ($each_types as $type) {
                if ($type == 'email') {
                    if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                        array_push($errors[$input_name], 'Email error');
                    }
                }
                if (preg_match('/^min:(\d+)$/', $type, $matches)) {
                    $func = is_array($input) ? 'count' : 'strlen';
                    if ($func($input) < $matches[1]) {
                        array_push($errors[$input_name], 'Email error');
                    }

                }
                if (preg_match('/^max:(\d+)$/', $type, $matches)) {
                    $func = is_array($input) ? 'count' : 'strlen';
                    if ($func($input) > $matches[1]) {
                        array_push($errors[$input_name], 'Email error');
                    }
                }
            }
        }
        Session::set('errors', $errors);
    }
}