<?php

namespace App\Post;

use App\Core\abstractModel;

class PostModel extends abstractModel
{
    public $id;
    public $title;
    public $content;
    public $author;
}