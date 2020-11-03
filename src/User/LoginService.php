<?php

namespace App\User;

class LoginService 
{
    public function __construct(UsersRepository $usersRepository)
    { 
      $this->usersRepository = $usersRepository;  
    }

    public function attempt($username, $password)
    {
        $user = $this->usersRepository->findByPropertyValue('username', $username);
        if(empty($user)){
            return false;
        }
        if(password_verify($password, $user->password)){
            $_SESSION['login'] = $user->username;
            session_regenerate_id(); 
            return true;
        }else {
            return false; 
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
        session_regenerate_id(true);
    }

    public function check()
    {
        if(isset($_SESSION['login'])){
            return true;
        } else {
            return false;
            // header('Location: login');
            // echo "User ist nicht eingeloggt!";
        }
    }

    public function admin()
    {
        $username = $_SESSION['login'];
        $user = $this->usersRepository->findByPropertyValue('username', $username);
        if($user->admin == 1){
            return true;
        } else {
            return false;
        }
    }

    public function validUser($post)
    {
        if($post->author == $_SESSION['login'] OR $this->admin())
        {
            return true;
        } else {
            return false;
        }
    }
}