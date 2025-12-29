<?php 
namespace App\Libraries;

class Auth{
    public function isLoggedIn(){
        return session()->has('user_id');
    }
    public function redirectIfNotLoggedIn(){
        if (!$this->isLoggedIn()) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }
        return null;
    }
}