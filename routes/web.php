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
    return 'Home page';
})->name('home.index');

Route::get('/contact', function () {
    return 'contact'; //new route
})->name('home.contact');

Route::get('/posts/{id}', function ($id) { //adding parameter
    return 'Blog post ' . $id;
});

Route::get('/recent-post/{days_ago?}', function ($daysAgo= 20) {
    return 'Posts from '  . $daysAgo . ' days ago';
});
