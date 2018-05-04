<?php

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
Route::middleware('CheckAuth')->group(function () {
    Route::get('/', 'PagesController@gate');
//Member Controller
    Route::get('register', 'MemberController@showRegistrationForm')->name('register.get');
    Route::get('register/token={token}', 'MemberController@activateMember');
    Route::post('register', 'MemberController@register')->name('register.post');
    Route::get('reset_password', 'MemberController@showResetForm')->name('reset_password_form');
    Route::post('reset_password', 'MemberController@resetPassword')->name('reset_password');
    Route::get('reset_password/token={token}', 'MemberController@showUpdatePasswordForm');
    Route::post('reset_password/token={token}', 'MemberController@updatePassword')->name('update_password');
//Login Controller
    Route::post('login', 'LoginController@logIn')->name('login');
});

//Pages only logged in user can access:
Route::middleware('CheckGuest')->group(function () {
    Route::get('/home', 'MainController@home')->name('home');
    Route::get('posts/create', 'PostsController@showCreateForm')->name('posts.getCreate');
    Route::post('posts/create', 'PostsController@createNewPost');
    Route::post('posts/like', 'PostsController@like');
    Route::get('posts', 'PostsController@index')->name('posts.index');
    Route::get('profile', 'MainController@profile')->name('profile');
});


Route::get('logout', 'MemberController@logOut')->name('logout');
Route::get('about', 'PagesController@about')->name('about');
Route::get('contact', 'PagesController@contact')->name('contact');

