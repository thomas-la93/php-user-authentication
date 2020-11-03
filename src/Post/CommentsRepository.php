<?php

namespace App\Post;

use App\Core\abstractRepository;



class CommentsRepository extends abstractRepository
{
  public function getTableName()
  {
    return 'comments';
  }
  public function getModelName()
  {
    return 'App\\Post\\CommentModel';
  }

  public function insertToPost($postId, $content)
  {
    $table = $this->getTableName();
    $stmt = $this->pdo->prepare("INSERT INTO `$table`(`content`, `post_id`) VALUES (:content,:postId)");
    $stmt->execute([
      'content' => $content,
      'postId' => $postId
    ]);
  }
  
}
