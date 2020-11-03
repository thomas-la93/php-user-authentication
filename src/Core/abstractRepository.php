<?php

namespace App\Core;

use App\Post\PostModel;
use PDO;

abstract class abstractRepository
{

  protected $pdo;
  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  abstract public function getTableName();
  abstract public function getModelName();

  function all()
  {
    $table = $this->getTableName();
    $model = $this->getModelName();
    $stmt = $this->pdo->query("SELECT * FROM `$table`");
    $posts = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
    return $posts ; 
  }

  function findByPropertyValue($property, $value)
  {
    $table = $this->getTableName();
    $model = $this->getModelName();
    $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE $property = :property");
    $stmt->execute(['property' => $value]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
    $obj = $stmt->fetch(PDO::FETCH_CLASS);
    return $obj;
  }

  public function findAllByPropertyValue($property, $value)
  {
    $table = $this->getTableName();
    $model = $this->getModelName();
    $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$property` = :property");
    $stmt->execute(['property' => $value]);
    $arr = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
    return $arr;
    
  }

  // public function insertToPost($postId, $content)
  // {
  //   $table = $this->getTableName();
  //   $stmt = $this->pdo->prepare("INSERT INTO `$table`(`content`, `post_id`) VALUES (:content,:postId)");
  //   $stmt->execute([
  //     'content' => $content,
  //     'postId' => $postId
  //   ]);
  // }


}