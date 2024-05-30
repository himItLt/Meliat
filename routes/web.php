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

// Route::get('/clear', function() {
//     Artisan::call('cache:clear');
//     Artisan::call('config:cache');
//     Artisan::call('view:clear');
// 	Artisan::call('route:clear');
// 	Artisan::call('backup:clean');
//     return "Кэш очищен.";
// });
//Auth::routes();   

Route::get('/fe51fewjem96cpq7', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/fe51fewjem96cpq7', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@login'])->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');  

Route::get('/',  'IndexController@index');
Route::get('/',  'IndexController@index');
Route::get('/createmap',  'IndexController@sitemap');

//Route::get('/parser',  'ParserController@index');


Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);



Route::middleware(['checkIp','auth'])->prefix('ck5e974ldld5782pnbp5fh73hj5dk')->namespace('Backend')->name('dashboard.')->group(function (){

    Route::get('/', 'DashboardController@index')->name('index');
    Route::resource('/resources', 'ResourceController');
    Route::resource('/chunks', 'ChunkController');
    Route::resource('/gallery', 'GalleryController');
    Route::resource('/review', 'ReviewController');
    Route::resource('/questions', 'QuestionController');
    Route::resource('/profile', 'ProfileController');

    // Adin AJAX Routes
    Route::get('/ajax/get-chunk-code/{id}',  'AjaxController@getChunkCode');
    Route::get('/ajax/files',  'AjaxController@getHomeDir');
    Route::get('/ajax/files/{dir}',  'AjaxController@getDir');
    Route::post('/files/upload',  'FilesController@upload');

});

    Route::any('/ajax/review', 'AjaxController@reviewStore');
    Route::any('/ajax/faq', 'AjaxController@questionStore');
    Route::any('/ajax/feedback', 'AjaxController@sendEmail');
    Route::any('/ajax/callback', 'AjaxController@sendCallback');
    Route::get('/ajax/cookie-check', 'AjaxController@cookieCheck');

Route::middleware(['locale'])->prefix(App\Http\Middleware\LocaleMiddleware::getLocale())->group(function(){
    Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
    
    Route::get('/', 'DeIndexController@index')->name('index');
    Route::paginate('/{uri}', 'MainController@index')->name('main');
    Route::get('/spanndecken-in-ihrer-naehe-top/{uri}', 'MainController@index')->name('main');
    Route::get('/spanndecken-in-ihrer-naehe/{uri}', 'MainController@index')->name('main');

    
});


