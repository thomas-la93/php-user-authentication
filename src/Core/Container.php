<?php

namespace App\Core;

use App\Post\PostsController;
use App\Post\PostAdminController;
use App\Post\PostsRepository;
use App\Post\CommentsRepository;
use App\User\LoginController;
use App\User\LoginService;
use App\User\UsersRepository;
use PDO;
use PDOException;

class Container 
{
    private $receipts = [];
    private $instances = [];

    public function __construct()
    {
        $this->receipts = [

            'postsController' => function()
            {
                return new PostsController(
                    $this->make('PostsRepository'), 
                    $this->make('CommentsRepository')
                );
            },
            'loginController' => function()
            {
                return new LoginController(
                    $this->make('loginService')
                );
            },
            'loginService' => function()
            {
                return new LoginService (
                    $this->make('UsersRepository')
                );
            },
            'postAdminController' => function()
            {
                return new PostAdminController (
                    $this->make('PostsRepository'),
                    $this->make('loginService')
                );
            },
            'PostsRepository' => function()
            {
                return new PostsRepository($this->make('pdo'));
            },
            'CommentsRepository' => function()
            {
                return new CommentsRepository($this->make('pdo'));
            },
            'UsersRepository' => function ()
            {
                return new UsersRepository(($this->make('pdo')));
            },
            'pdo' => function(){
                try{
                    $pdo = new PDO(
                        'mysql:host=localhost;dbname=blog2;charset=utf8',
                        'root',
                        ''
                    );

                } catch(PDOException $e){
                    echo "Verbindung zur Datenbank fehlgeschlagen";
                    die();
                }
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                return $pdo;
            }
        ];
    }

    public function make($name)
    {
        if(!empty($this->instances[$name])){
            return $this->instances[$name];
        }
        if(isset($this->receipts[$name])){
            $this->instances[$name] = $this->receipts[$name]();
            return $this->instances[$name];
        }
    }
    // private $pdo; 
    // private $postsRepository; 

    // public function getPdo()
    // {
    //     if(!empty($this->pdo)){
    //         return $this->pdo;
    //     }
    //     $this->pdo = new PDO(
    //         'mysql:host=localhost;dbname=blog;charset=utf8',
    //         'root',
    //         ''
    //     );
    //     $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //     return $this->pdo;
    // }

    // public function getPostRepository()
    // {
    //     if(!empty($this->postsRepository)){
    //         return $this->postsRepository;
    //     }
    //     $this->postsRepository = new PostsRepository($this->getPdo());
    //     return $this->postsRepository;
    // }
}
