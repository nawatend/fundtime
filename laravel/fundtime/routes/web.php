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

Route::get('/', function () {
    return view('emails/mail');
});

Route::name('mails.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/mail', 'MailsController@getIndex')->name('index');
    Route::post('/emails/mail_confirmed', 'MailsController@sendMail')->name('send');
});


Route::name('news.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/news', 'NewsController@getIndex')->name('index');
});

Route::name('profile.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/profile', 'ProfileController@getIndex')->name('index');
    Route::get('/profile/edit', 'ProfileController@getEdit')->name('edit');
});

Route::name('projects.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/projects', 'ProjectsController@getIndex')->name('index');
    Route::get('/projects/new', 'ProjectsController@getCreate')->name('edit');
});


// dynamic routes
Route::name('pages.')->group(function () {
    Route::get('/', 'PagesController@getIndex')->name('home');
    Route::get('/about', 'PagesController@getAbout')->name('about');
    Route::get('/contacts', 'PagesController@getContacts')->name('contacts');
    Route::get('/privacy', 'PagesController@getPrivacy')->name('privacy');
});






Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
