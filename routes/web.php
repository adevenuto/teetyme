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

// Only used for initial data scrape
// Route::post('scrape/states', 'ScrappingController@scrapeStates');
// Route::post('scrape/cities', 'ScrappingController@scrapeCities');
// Route::post('scrape/courses', 'ScrappingController@scrapeCourses');
// Route::post('scrape/courses/holes', 'ScrappingController@scrapeCourseHoles');

Route::post('/login', 'auth\LoginController@authenticate');
Route::post('/logout', 'auth\LogoutController@logout');

Route::view('/{any?}', 'landing')
    ->name('landing')
    ->where('any', '.*');



