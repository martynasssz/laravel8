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
    return view('home.index', []); //if we don't pass any data we don't need secod argument array
})->name('home.index');

Route::get('/contact', function () {
    return view('home.contact'); 
})->name('home.contact');

Route::get('/posts/{id}', function ($id) { //adding parameter
    $post = [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel'
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP'
        ]
    ];   
    
    abort_if(!isset($post[$id]),404); //laravel error helper function
    
    return view('posts.show', ['post' => $post[$id]]);
}) 
// we don't use it here, because added to RouterServiceProvider.php file
// -> where ([  //add a contstrait, which will protects to load controller if parameter not a number 
//     'id' => '[0-9]+' 
// ]) 
-> name ('posts.show');

Route::get('/recent-post/{days_ago?}', function ($daysAgo= 20) {
    return 'Posts from '  . $daysAgo . ' days ago';
});
