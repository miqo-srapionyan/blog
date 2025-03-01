<?php

declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\Comment;
use core\Session;

class CommentsController extends Controller
{
    public function addComment()
    {
        $comment = new Comment;
        $comment->addComment($this->post['content'], Session::get('user')['id'], $this->post['post_id']);

        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}
