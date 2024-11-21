<?php
use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name(name:'home');

Route::get('/login',[AuthManager::class , 'login'])->name(name:'login');
Route::post('/login',[AuthManager::class , 'loginPost'])->name(name:'login.post');   
Route::get('/register',[AuthManager::class , 'register'])->name(name:'register');
Route::post('/register',[AuthManager::class , 'registerPost'])->name(name:'register.post'); 
Route::get('/logout',[AuthManager::class , 'logout'])->name(name:'logout');

