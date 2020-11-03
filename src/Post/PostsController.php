<?php

namespace App\Post;

use App\Core\abstractController;

class PostsController extends abstractController
{
    public function __construct(
        PostsRepository $postsRepository,
        CommentsRepository $commentsRepository
    ) {
        $this->postsRepository = $postsRepository;
        $this->commentsRepository = $commentsRepository;
    }

    public function index()
    {
        $posts = $this->postsRepository->all();
        $this->render('post/index', ['posts' => $posts]);
    }

    public function show()
    {
        $id = $_GET['id'];
        if (!empty($_POST['content'])) {
            $content = $_POST['content'];
            $this->commentsRepository->insertToPost($id, $content);
            // header("HTTP/1.1 303 See Other");
            header("Location: post?id=$id");
        }

        $post = $this->postsRepository->findByPropertyValue('id', $id);
        $comments = $this->commentsRepository->findAllByPropertyValue('post_id', $id);

        $this->render('post/show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}
