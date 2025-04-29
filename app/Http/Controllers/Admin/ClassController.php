<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        return view('admin.class.classes',[
            'classes' => ClassRoom::all()
        ]);
    }
    public function store(){

    }
}
