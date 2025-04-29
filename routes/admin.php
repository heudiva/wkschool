<?php

use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//admin
Route::group(['prefix' => 'admin/' , 'middleware' => ['auth','admin']], function(){

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


route::get('admin/dashboard',[HomeController::class,'index'])
->middleware('auth','admin')
->name('admin.dashboard');


Route::controller(ProfileController::class)
->name('admin.profile.')
->prefix('profile')
->group(function(){
    Route::get('edit', 'edit')->name('edit');
    Route::patch('update', 'update')->name('update');
    Route::delete('destroy', 'destroy')->name('destroy');
    Route::post('store', 'imageStore')->name('image.store');
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

        
Route::controller(UserController::class)
->prefix('dashboard/user')
->name('admin.user.')
->group(function () {
    Route::get('users', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    Route::post('edit', 'edit')->name('edit');
    Route::post('update', 'update')->name('update');
    Route::post('delete', 'delete')->name('delete');
    Route::post('destroy', 'destroy')->name('destroy');

    Route::post('delete-users', 'delete_users')->name('deletes');
  
});

Route::middleware('auth')->group(function () {
    route::get('/dashboard/setting',[SettingController::class,'index'])->name('admin.dashboard.setting');
    
});



Route::controller(MessageController::class)
->name('message.')
->group(function () {
    Route::get('message', 'index')->name('index');
  
});

Route::controller(SupplierController::class)
->name('admin.')
->group(function()
{
    Route::get('suppliers', 'index')->name('supplier.index');
});


Route::controller(StudentController::class)
->middleware('auth')
->name('admin.')
->group(function () {
    Route::get('student', 'index')->name('student.index');
    Route::post('student/store', 'store')->name('student.store'); // Added proper naming & structure
    Route::post('student/edit', 'edit')->name('student.edit'); // Added proper naming & structure
    Route::post('student/update', 'update')->name('student.update'); // Added proper naming & structure
    Route::post('student/delete', 'delete')->name('student.delete'); // Added proper naming & structure
    Route::post('student/deletes', 'deletes')->name('student.deletes'); // Added proper naming & structure
    Route::post('student/destroy', 'destroy')->name('student.destroy'); // Added proper naming & structure
});


Route::controller(ClassController::class)
->name('admin.')
->group(function()
{
    Route::get('class', 'index')->name('class.index');
    Route::get('store', 'store')->name('class.store');
});


});




