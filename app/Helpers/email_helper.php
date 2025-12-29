<?php

use Config\Services;

if (!function_exists('sendEmail')) {
    function sendEmail($to, $subject, $message){
        $email = Services::email();

        $email->setTo($to);
        $email->setFrom('info@damelodamelo.com', 'Dámelo Dámelo');
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return true;
        } else {
            // $email->printDebugger(['headers']);
            return false;
        }
    }
}


// helper("email");
// sendEmail("overrimachi2001@gmail.com", "Pruebas", "Mensage body");