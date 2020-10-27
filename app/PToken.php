<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Token as Token;

class PToken extends Token
{
    use \App\Models\Concerns\UsesUuid;
}
