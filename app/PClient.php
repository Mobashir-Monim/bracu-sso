<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Client as PassportClient;

class PClient extends PassportClient
{
    use \App\Models\Concerns\UsesUuid;

    public function rgroup()
    {
        return $this->hasOne('App\ResourceGroup', 'uuid');
    }
}
