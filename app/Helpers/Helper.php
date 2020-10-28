<?php

namespace App\Helpers;

class Helper
{
    public function base64url_encode($data)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($data)
        );
    }

    public function base64url_decode($data, $strict = false)
    {
        $b64 = strtr($data, '-_', '+/');
        return base64_decode($b64, $strict);
    }
}