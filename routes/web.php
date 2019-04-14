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


Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::group(['prefix' => 'manager'], function () {
    Route::get('/site_config', 'ManagerController@siteConfig')
        ->name('site.config')
        ->middleware('auth');
    Route::post('/site_config', 'ManagerController@siteConfigUpdate')
        ->name('site.config.update')
        ->middleware('auth');
    Route::get('/keyword/of_page', 'KeywordController@keyword_of_page')
        ->name('keyword.of.page')
        ->middleware('auth');
    Route::get('/keyword/of_page/add', 'KeywordController@keyword_of_page_add')
        ->name('keyword.of.page.add')
        ->middleware('auth');
    Route::post('/keyword/of_page/add', 'KeywordController@keyword_of_page_add_request')
        ->name('keyword.of.page.add.request')
        ->middleware('auth');
    Route::get('/keyword/of_page/update/{id}', 'KeywordController@keyword_of_page_update')
        ->name('keyword.of.page.update')
        ->middleware('auth');
    Route::post('/keyword/of_page/update/{id}', 'KeywordController@keyword_of_page_add_request')
        ->name('keyword.of.page.update.request')
        ->middleware('auth');
});
Route::get('test', 'SchedulingController@keywordCraw');
Route::get('/k/{id}/{slug}', 'KeywordController@showById')->name('keyword.show.id');
Route::get('/k/{slug}', 'KeywordController@show')->name('keyword.show');
Route::get('/d/{domain}', 'DomainController@show')->name('domain.show');
Route::get('/v/{yid}/{slug}', 'VideoController@showById')->name('video.show.id');
Route::get('/v/{yid}', 'VideoController@show')->name('video.show');
Route::get('/site/{id}/{slug}', 'SiteController@showById')->name('site.show');
Route::get('/sitemap{type}', 'SitemapsController@sitemap')->name('sitemap');