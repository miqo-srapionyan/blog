<?php

declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\BlogPost;

use function json_encode;
use function strtotime;
use function substr;
use function date;
use function strip_tags;

class HomeController extends Controller
{
    /**
     * @return void
     */
    public function index(): void
    {
        $blog = new BlogPost;
        $data = $blog->getAllPosts(['status' => 1]);

        $this->view->render('home/index', ['data' => $data]);
    }

    /**
     * @param array $param
     *
     * @return void
     */
    public function blog(array $param): void
    {
        $blog = new BlogPost;
        $data = $blog->getPostById($param['id']);
        $comments = $blog->getPostComments($param['id']);

        $this->view->render('home/blog', ['data' => $data, 'comments' => $comments]);
    }

    /**
     * @return void
     */
    public function infiniteScroll(): void
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
                    $data[$key1]['image'] = ($data[$key1]['image']) ? "/uploads/".$data[$key1]['image'] : '';
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