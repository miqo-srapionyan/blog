<?php

namespace controllers;

use core\Controller;
use core\Session;
use models\BlogPost;

class AdminController extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view->layout = 'layouts/admin_layout';
    }

    public function index()
    {

        $this->view->render('admin/index');
    }

    public function dashboard()
    {
        $blog = new BlogPost;
        $data = $blog->getAllPosts();

        $this->view->render('admin/dashboard', ['data' => $data]);
    }


    public function addPost()
    {
        $blog = new BlogPost;
        $this->post = array_merge($this->post, $_FILES);
        if (isset($this->post['image']['name']) && $this->post['image']['name']) {
            if (!$this->post['image']['error']) {
                if (!is_dir('uploads')) {
                    mkdir("uploads", 0777);
                }
                $imageFileType = strtolower(pathinfo($this->post['image']['name'], PATHINFO_EXTENSION));

                $new_file_name = time() . ".$imageFileType";
                move_uploaded_file($this->post['image']['tmp_name'], 'uploads/' . $new_file_name);
            }
        } else {
            $new_file_name = null;
        }
        $this->post['image'] = $new_file_name;
        $this->post['status'] = (isset($this->post['status'])) ? 1 : 0;
        unset($this->post['submit']);


        $this->post['user_id'] = Session::get('user')['id'];

        $blog->saveBlogPost($this->post);

        $this->redirect('/dashboard');
    }

    public function deletePost($param)
    {
        $blog = new BlogPost;
        $blog->deletePostById($param['id']);
        $this->redirect('/dashboard');
    }

    public function changeStatus()
    {
        $blog = new BlogPost;
        $blog->changeStatus($this->post['id'], $this->post['status']);
    }
}
