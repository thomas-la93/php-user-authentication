<?php

namespace App\User;

use App\Core\abstractRepository;

class UsersRepository extends abstractRepository
{
  public function getTableName()
  {
    return 'users';
  }
  public function getModelName()
  {
    return 'App\\User\\UserModel';
  }
}
