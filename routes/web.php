<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/validation', function() {
    return view('validation');
});

Route::get('/notifications', function() {
    return view('notifications');
});

Route::get('/inputs', function() {
    return view('inputs');
});

Route::get('/uploads', function() {
    return view('uploads');
});

Route::get('/tables', function() {
    return view('tables');
});

Route::get('/multinotifications', function() {
    return view('multinotifications');
});

Route::get('/ordered', function() {
    return view('ordered');
});

Route::get('/draganddrop', function() {
    return view('draganddrop');
});