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

// Route::get('/', function () {
//     return view('emails/mail');
// });

Route::name('mails.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/mail', 'MailsController@getIndex')->name('index');
    Route::post('/emails/mail_confirmed', 'MailsController@sendMail')->name('send');
});


Route::name('news.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/news', 'NewsController@getIndex')->name('index');
    Route::get('/news/new', 'NewsController@getCreate')->name('create');
    Route::post('/news/save', 'NewsController@postSave')->name('save');
    Route::get('/news/edit/{news_id}', 'NewsController@getEdit')->name('edit');
    Route::get('/news/detail/{news_id}', 'NewsController@getDetail')->name('detail');
});

Route::name('profile.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/profile', 'ProfileController@getIndex')->name('index');
    Route::get('/profile/edit', 'ProfileController@getEdit')->name('edit');
});

Route::name('projects.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/projects', 'ProjectsController@getIndex')->name('index');
    Route::get('/myprojects', 'ProjectsController@getMyProjects')->name('myprojects');
    Route::get('/projects/new', 'ProjectsController@getCreate')->name('create');
    Route::get('/projects/edit/{projectId}', 'ProjectsController@getEdit')->name('edit');
    Route::get('/projects/detail/{projectId}', 'ProjectsController@getDetail')->name('detail');
    Route::post('/projects/save', 'ProjectsController@postSave')->name('save');
    Route::get('/projects/delete/{projectId}', 'ProjectsController@destroy')->name('delete');
});
Route::name('categories.')->group(/*['middleware' => ['auth']], */function () {
    Route::get('/projects/categories/{category}', 'CategoryController@getIndex')->name('index');
});

Route::name('backers.')->group(/*['middleware' => ['auth']], */function () {
    Route::post('/projects/savefund', 'BackersController@postBacker')->name('save');
});

// dynamic routes
Route::name('pages.')->group(function () {
    Route::get('/', 'PagesController@getIndex')->name('home');
    Route::get('/about', 'PagesController@getAbout')->name('about');
    Route::get('/contacts', 'PagesController@getContacts')->name('contacts');
    Route::get('/privacy', 'PagesController@getPrivacy')->name('privacy');
});


Route::name('shop.')->group(function () {
    Route::get('/shop', 'ShopItemsController@getIndex')->name('index');
    Route::post('/shop/confirmed', 'ShopItemsController@postConfirmed')->name('confirmed');
});


Route::name('stripe.')->group(function () {
    Route::get('/payment', 'PaymentController@getStripeForm')->name('index');
    Route::post('/confirm', 'PaymentController@postStripePayment')->name('confirm');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
