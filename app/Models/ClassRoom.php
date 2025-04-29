<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'section'];

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
