<?php

namespace App\Commons;

use Illuminate\Support\Facades;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Rsa
{

    const PRIVATE_KEY = '';

    const PUBLIC_KEY = "";

    public static function sign($message)
    {

        $algo = OPENSSL_ALGO_SHA256;
        openssl_sign($message, $binary_signature, Rsa::PRIVATE_KEY, $algo);
        return base64_encode($binary_signature);
    }

    public static function verify($signature, $message){
        $signature = ($signature);
        $result = openssl_verify($message, $signature, self::PUBLIC_KEY, OPENSSL_ALGO_SHA256);
        if ($result !== 1) {
            return false;
        }

        return true;
    }
}
