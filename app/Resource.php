<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends BaseModel
{
    public function group()
    {
        return $this->belongsTo('App\ResourceGroup');
    }
}
