<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;

class Student extends Model
{
    protected $fillable = [
        'fname', 'lname', 'gender', 'dob', 'phone', 'email', 'image'
    ];

    protected $casts = [
        'dob' => 'date',
    ];
    
    public function class()
    {
        return $this->hasOne(ClassRoom::class);
    }
    
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function parent()
    {
        return $this->hasOne(Parents::class);
    }
    
}
