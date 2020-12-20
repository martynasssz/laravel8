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
/*************************** use view instead closure**********************/
// Route::get('/', function () {
//     return view('home.index', []); //if we don't pass any data we don't need secod argument array
// })->name('home.index');

// Route::get('/contact', function () {
//     return view('home.contact'); 
// })->name('home.contact');

Route::view('/', 'home.index')
    ->name('home.index');
Route::view('/contact', 'home.contact')
    ->name('home.contact');

    $posts = [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel',
            'is_new' => true, //aditional parameter
            'has_comments' => true
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP',
            'is_new' => false //aditional parameter
        ],
        3 => [
            'title' => 'Intro to Golang',
            'content' => 'This is a short intro to Golang',
            'is_new' => false //aditional parameter
        ]
    ];

Route::get('/posts', function() use ($posts) {
    // compact($posts) === ['posts' =>$posts])
   return view('posts.index', ['posts' => $posts]);
});    

Route::get('/posts/{id}', function ($id) use ($posts) { //adding parameter
      
    
    abort_if(!isset($posts[$id]),404); //laravel error helper function retur 404 error if page not found
    
    return view('posts.show', ['post' => $posts[$id]]);
}) 
// we don't use it here, because added to RouterServiceProvider.php file
// -> where ([  //add a contstrait, which will protects to load controller if parameter not a number 
//     'id' => '[0-9]+' 
// ]) 
-> name ('posts.show');

Route::get('/recent-post/{days_ago?}', function ($daysAgo= 20) {
    return 'Posts from '  . $daysAgo . ' days ago';
});

Route::get('/fun/responses', function() use ($posts) {
    return response($posts, 201)
    ->header('content-Type', 'application/json')
    ->cookie('MY_COOKIE', 'Martin K', 3600); //helper function response will create a new reponse object which have methods header() or cookie()
    //the responce function acept 3 parameters: all optional. first content return, second status code, array of responce headers  
});

//reponse helper function use when needto something extra: to set a header, or a cookie, o change responce status code. 

Route::get('/fun/redirect', function(){
    return redirect('/contact'); //redirect to contact page
});

Route::get('/fun/back', function(){
    return back();   // back redirect to the last address usefull for one time actions for input storing
});

Route::get('/fun/named-route', function(){
    return redirect()->route('posts.show', ['id' => 1]); //redirect to certain page with parameter

});

Route::get('/fun/away', function(){
    return redirect()->away('https://google.com'); //redirect away of page

});

Route::get('/fun/json', function() use ($posts) {
    return response()->json($posts); //return json response

});

Route::get('/fun/download', function() use ($posts) {
    return response()->download(public_path('/mvc.png'), 'face.jpg'); //download mvc.phg as face.jpg

});