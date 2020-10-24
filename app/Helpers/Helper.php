<?php

namespace App\Helpers;

class Helper
{
    function base64url_encode($data)
    {
        $b64 = base64_encode($data);

        if ($b64 == false)
            return false;

        $url = strtr($b64, '+/', '-_');

        return rtrim($url, '=');
    }

    function base64url_decode($data, $strict = false)
    {
        $b64 = strtr($data, '-_', '+/');
        return base64_decode($b64, $strict);
    }
}