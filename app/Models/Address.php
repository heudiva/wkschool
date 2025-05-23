<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['village', 'commune', 'district', 'province'];

    public function addressable()
    {
        return $this->morphTo();
    }
    
}

