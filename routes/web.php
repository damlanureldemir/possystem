<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/panela',function (){
        return view('panel.pages.index');
    })->name('admin.dashboard')->middleware('role:admin'); // admin rolüne sahip olanlar erişebilir
    Route::get('/anasayfa',function (){
        return view('front.master');
    })->name('user.dashboard')->middleware('role:user'); // user rolüne sahip olanlar

    Route::prefix('/category')->name('category.')->group(function (){
        Route::get('/index',[CategoryController::class,'index'])->name('index');
        Route::get('/fetch',[CategoryController::class,'fetch'])->name('fetch');
        Route::post('/create',[CategoryController::class,'create'])->name('create');
        Route::post('/delete',[CategoryController::class,'deleteCategory'])->name('delete');
    });


});
