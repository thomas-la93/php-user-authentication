<?php

namespace App\Post;

use App\Core\abstractController;
use App\User\LoginService;

class PostAdminController extends abstractController
{
    public function __construct(
        PostsRepository $postsRepository,
        LoginService $loginService
    ) {
        $this->postsRepository = $postsRepository;
        $this->loginService = $loginService;
    }

    public function index()
    {
        if($this->loginService->admin())
        {
            $posts = $this->postsRepository->all();
            $this->render('post/admin/index', ['posts' => $posts]);
        } else if ($this->loginService->check()) {
            $posts = $this->postsRepository->findAllByPropertyValue('author', $_SESSION['login']);
            $this->render('post/admin/index', ['posts' => $posts]);
        } else {
            header('Location: login');
        }
    }

    public function show()
    {
        if ($this->loginService->check()) {
            $id = $_GET['id'];
            $savedSuccess = false;
            $entry = $this->postsRepository->findByPropertyValue('id', $id);
            if ($this->loginService->validUser($entry) AND !empty($_POST['content'])) {
                $entry->title = $_POST['title'];
                $entry->content = $_POST['content'];
                $this->postsRepository->update($entry);
                $savedSuccess = true;
            }
            $post = $this->postsRepository->findByPropertyValue('id', $id);
            $this->render('post/admin/edit', [
                'post' => $post,
                'savedSuccess' => $savedSuccess
            ]);
        } else {
            header('Location: login');
        }
    }
    public function deletePost()
    {
        if ($this->loginService->check()) {
            $id = $_GET['id'];
            $savedSuccess = false;
            $entry = $this->postsRepository->findByPropertyValue('id', $id);
            if ($this->loginService->validUser($entry)) {
                var_dump($_GET);
                $this->postsRepository->delete($entry);
                $savedSuccess = true;
            }
            // header('Location: posts-admin');
            
        } else {
            header('Location: login');
        }
    }

    public function create()
    {
        
        $entry = new PostModel;
        if($this->loginService->check()) {
            $savedSuccessCreate = false;
            if (!empty($_POST['content'])) {
                $entry->title = $_POST['title'];
                $entry->content = $_POST['content'];
                $entry->author = $_SESSION['login'];
                $this->postsRepository->insert($entry);
                $savedSuccessCreate = true;
                $post = $this->postsRepository->findByPropertyValue('content', $entry->content);
                $this->render('post/admin/edit', [
                    'post' => $post,
                    'savedSuccessCreate' => $savedSuccessCreate
                ]);
            } else {
                $this->render('post/admin/new', [
                    'entry' => $entry,
                ]);
            }
        } else {
            header('Location: login');
        }
    }

    
}
