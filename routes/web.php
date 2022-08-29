<?php

use App\Models\State;
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
Route::get('/', function() {
    $states = State::all();
    return view('welcome', ['states' => $states]);
});

Route::post('scrape/states', 'ScrappingController@scrapeStates');
Route::post('scrape/cities', 'ScrappingController@scrapeCities');
Route::post('scrape/courses', 'ScrappingController@scrapeCourses');
Route::post('scrape/courses/holes', 'ScrappingController@scrapeCourseHoles');



Route::get('courses', 'CourseController@index');
Route::get('course/{id}/details', 'CourseController@show');
