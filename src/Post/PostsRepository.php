<?php

namespace App\Post;

use App\Core\abstractRepository;

class PostsRepository extends abstractRepository
{
  public function getTableName()
  {
    return 'posts';
  }
  public function getModelName()
  {
    return 'App\\Post\\PostModel';
  }

  public function update(PostModel $model)
  {
    $table = $this->getTableName();
    $stmt = $this->pdo->prepare("UPDATE `$table` SET `title` = :title, `content` = :content WHERE `$table`.`id` = :id");
    $stmt->execute([
      'title' => $model->title,
      'content' => $model->content,
      'id' => $model->id
    ]);
  }

  public function delete($model)
  {
    $table = $this->getTableName();
    $stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE `$table`.`id` = :id");
    $stmt->execute([   
      'id' => $model->id
    ]);
  }

  public function insert(PostModel $model)
  {
    $table = $this->getTableName();
    $stmt = $this->pdo->prepare("INSERT INTO `$table`(`id`, `title`, `content`, `author`) VALUES (:id,:title,:content,:author)");
    $stmt->execute([
      'id' => null,
      'title' => $model->title,
      'content' => $model->content,
      'author' => $model->author
    ]);
  }
}

