<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'fname', 'lname', 'gender', 'dob', 'phone', 'email', 'image'
    ];
    
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
    
}
