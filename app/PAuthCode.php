<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\AuthCode as AuthCode;

class PAuthCode extends AuthCode
{
    use \App\Models\Concerns\UsesUuid;
}
