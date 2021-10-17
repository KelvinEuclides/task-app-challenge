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

//Creating Tasks Api Resource Controller
Route::resource('tasks', 'TasksController', [
    'except' => ['edit', 'create','show']
]);
//Creating Projects api Tasks Resource Controller
Route::resource('projects', 'ProjectsController', [
    'except' => ['edit', 'create','show']
]);
