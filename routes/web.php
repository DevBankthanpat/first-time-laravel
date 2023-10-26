<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [MemberController::class, 'index']);

Route::get('/form',function () {
    return view('form');
});

Route::get('/', 'App\Http\Controllers\MemberController@index');
Route::get('/member', 'App\Http\Controllers\MemberController@index');
Route::get('/main', 'App\Http\Controllers\MemberController@index');

Route::get('/member/{id}/edit', 'App\Http\Controllers\MemberController@edit')->name('member.edit');
Route::get('/member/{id}/delete', 'App\Http\Controllers\MemberController@delete')->name('member.delete');
Route::post('/member/add', 'App\Http\Controllers\MemberController@add')->name('member.add'); 

Route::get('/member/create', 'App\Http\Controllers\MemberController@create')->name('member.create'); 