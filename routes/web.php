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

use App\Http\Controllers\MainController;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/fe51fewjem96cpq7', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/fe51fewjem96cpq7', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@login'])->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/',  'IndexController@index');
Route::get('/createmap',  'IndexController@sitemap');

//Route::get('/parser',  'ParserController@index');

Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);

Route::middleware(['checkIp','auth'])->prefix('ck5e974ldld5782pnbp5fh73hj5dk')->namespace('Backend')->name('dashboard')->group(function (){

    Route::get('/', 'DashboardController@index')->name('index');
    Route::resource('/resources', 'ResourceController');
    Route::resource('/chunks', 'ChunkController');
    Route::resource('/gallery', 'GalleryController');
    Route::resource('/review', 'ReviewController');
    Route::resource('/questions', 'QuestionController');
    Route::resource('/profile', 'ProfileController');

    // Adin AJAX Routes
    Route::get('/ajax/get-chunk-code/{id}',  'AjaxController@getChunkCode')->name('ajax.chunk');
    Route::get('/ajax/files',  'AjaxController@getHomeDir')->name('ajax.files');
    Route::get('/ajax/files/{dir}',  'AjaxController@getDir')->name('ajax.dir');
    Route::post('/files/upload',  'FilesController@upload')->name('ajax.upload');
});

Route::any('/ajax/review', 'AjaxController@reviewStore');
Route::any('/ajax/faq', 'AjaxController@questionStore');
Route::any('/ajax/feedback', 'AjaxController@sendEmail');
Route::any('/ajax/callback', 'AjaxController@sendCallback');
Route::get('/ajax/cookie-check', 'AjaxController@cookieCheck');

$localeRoutes = function(string $locale) {
    Route::get('/', 'DeIndexController@index')->name($locale . '.index');
    Route::get('/{uri}', [MainController::class, 'index'])->name($locale . '.main');
    Route::get('/spanndecken-in-ihrer-naehe-top/{uri}', [MainController::class, 'index'])->name($locale . '.naehe.top');
    Route::get('/spanndecken-in-ihrer-naehe/{uri}', [MainController::class, 'index'])->name($locale . '.naehe');
};

foreach (LocaleMiddleware::$languages as $locale) {
    Route::middleware(['locale'])->prefix($locale)->group(fn() => $localeRoutes($locale));
}
