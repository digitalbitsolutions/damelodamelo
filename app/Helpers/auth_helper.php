<?php

if (!function_exists('is_logged_in')) {
    function is_logged_in(){
        // Verifica si existe un dato en la sesión (por ejemplo, 'user_id')
        return session()->has('user_id');
    }
}

if (!function_exists('redirect_if_not_logged_in')) {
    
    function redirect_if_not_logged_in(){
        if (!is_logged_in()) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }
        return null;
    }
}