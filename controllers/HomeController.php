<?php

namespace controllers;

use core\Controller;
use core\Session;
use models\BlogPost;


class HomeController extends Controller
{

    public function index()
    {
        $blog = new BlogPost;
        $data = $blog->getAllPosts(['status' => 1]);

        $this->view->render('home/index', ['data' => $data]);

    }

    public function blog($param)
    {
        $blog = new BlogPost;
        $data = $blog->getPostById($param['id']);
        $comments = $blog->getPostComments($param['id']);

        $this->view->render('home/blog', ['data' => $data, 'comments' => $comments]);
    }

    public function infiniteScroll()
    {
        $blog = new BlogPost;
        $limit = $this->post['limit'];
        $offset = $this->post['offset'];
        $data = $blog->getAllPosts(['status' => 1], $limit, $offset);

        foreach ($data as $key1 => $value) {
            foreach ($value as $key => $val) {
                if ($key == 'created_at') {
                    $data[$key1]['created_at'] = date("F d, Y", strtotime($data[$key1]['created_at']));
                }
                if ($key == 'image') {
                    $data[$key1]['image'] = ($data[$key1]['image']) ? "/uploads/" . $data[$key1]['image'] : '';
                }

                if ($key == 'description') {
                    $data[$key1]['description'] = substr(strip_tags($data[$key1]['description']), 0, 200);

                }
            }

        }

        echo json_encode($data);
        exit;
    }
}