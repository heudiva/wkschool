<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    protected $table = 'parents';
    protected $fillable = ['name', 'gender', 'phone', 'email'];
    public function student(){
        return $this->belongsTo(Student::class);
    }


    
}
