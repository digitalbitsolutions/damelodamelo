<?php
use Config\Services;

function validateRecaptchaV3($token){
    $secretKey = env('RECAPTCHA_SECRET_KEY'); // el secret key viene del archivo .env
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $token,
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    if ($response['success'] && $response['score'] >= 0.5) {
        // CAPTCHA válido
        return true;
    } else {
        // CAPTCHA inválido
        return false;
    }
}

function validateRecaptchaV2($token){
    $request = Services::request();
    $captchaResponse = $token;

    if (!$captchaResponse) {
        return false;
    }

    $secretKey = env('RECAPTCHA_SECRET_KEY'); // mejor en .env
    $userIP = $request->getIPAddress();

    $client = Services::curlrequest();
    $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
            'secret'   => $secretKey,
            'response' => $captchaResponse,
            'remoteip' => $userIP,
        ]
    ]);

    $result = json_decode($response->getBody());

    return $result && $result->success;
}