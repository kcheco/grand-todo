<?php

use App\Http\Controllers\TodosController;
use Illuminate\Http\Request;

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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::get('/todos', 'TodosController@getAllTodos');

Route::post('/todos', 'TodosController@postNewTodo');

Route::put('/todos/{id}', 'TodosController@patchExistingTodo');
Route::patch('/todos/{id}', 'TodosController@patchExistingTodo');