<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('courses', 'api\CourseController@index');
Route::get('course/{id}', 'api\CourseController@show');


Route::post('hole/edit', 'api\HoleController@update');
Route::post('hole/teebox/edit', 'api\HoleController@updateTeebox');
// Route::get('course/{id}/details', 'CourseController@show');
