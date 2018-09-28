<?php

use App\Http\Controllers\TodosController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

Route::get('/request_log', function (Request $request, Response $response)
{
    return [
    	'http_status_code' => $response->getStatusCode(),
    	'request_method' => $request->method(),
    	'route' => $request->path()
    ];
});

Route::get('/todos', 'TodosController@getAllTodos');

Route::post('/todos', 'TodosController@postNewTodo');

Route::put('/todos/{id}', 'TodosController@patchExistingTodo');
Route::patch('/todos/{id}', 'TodosController@patchExistingTodo');

Route::get('/todos/{id}', 'TodosController@getTodo');

Route::delete('/todos/{id}', 'TodosController@deleteTodo');