<?php

namespace App\Post;

use App\Core\abstractModel;

class CommentModel extends abstractModel
{

    public $id;
    public $content;
    public $post_id;


}
