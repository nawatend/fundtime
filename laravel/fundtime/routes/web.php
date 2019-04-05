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
    Route::post('/mail', 'MailsController@getIndex')->name('index');
    Route::post('/emails/mail_confirmed', 'MailsController@sendMail')->name('send');
});
