<?php

declare(strict_types=1);

/*
 * example
 * '/controller/action/{id?}' => [
        'controller' => 'Controller',
        'action' => 'action',
        'middleware' => 'guest'
    ],
 */

return [
    '/' => [
        'controller' => 'HomeController',
        'action'     => 'index',
    ],

    '/blog/{id}' => [
        'controller' => 'HomeController',
        'action'     => 'blog',
    ],

    '/core' => [

    ],

    '/add_comment' => [
        'controller' => 'CommentsController',
        'action'     => 'addComment',
        'middleware' => 'auth'
    ],

    '/login' => [
        'controller' => 'UsersController',
        'action'     => 'login',
        'middleware' => 'guest'
    ],

    '/post_login' => [
        'controller' => 'UsersController',
        'action'     => 'postLogin',
        'middleware' => 'guest'
    ],

    '/logout' => [
        'controller' => 'UsersController',
        'action'     => 'logout',
        'middleware' => 'auth'
    ],

    '/register' => [
        'controller' => 'UsersController',
        'action'     => 'register',
        'middleware' => 'guest'
    ],

    '/post_register' => [
        'controller' => 'UsersController',
        'action'     => 'postRegister',
        'middleware' => 'guest'
    ],


    '/admin' => [
        'controller' => 'AdminController',
        'action'     => 'index',
        'middleware' => 'guest'
    ],

    '/dashboard' => [
        'controller' => 'AdminController',
        'action'     => 'dashboard',
        'middleware' => 'admin'
    ],


    '/add_post' => [
        'controller' => 'AdminController',
        'action'     => 'addPost',
        'middleware' => 'auth|admin'
    ],

    '/delete_post/{id}' => [
        'controller' => 'AdminController',
        'action'     => 'deletePost',
        'middleware' => 'auth|admin'
    ],

    '/change_status' => [
        'controller' => 'AdminController',
        'action'     => 'changeStatus',
        'middleware' => 'auth|admin'
    ],

    '/infinite_scroll' => [
        'controller' => 'HomeController',
        'action'     => 'infiniteScroll',
    ]
];