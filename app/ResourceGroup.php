<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceGroup extends BaseModel
{
    public function resources()
    {
        return $this->hasMany('App\Resource');
    }
}
