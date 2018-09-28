<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\TodosController;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;

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

Route::get('/todos/{id}', 'TodosController@getTodo');

Route::delete('/todos/{id}', 'TodosController@deleteTodo');

// Route for current weather based on zipcode **NEEDS TO BE REFACTORED
Route::post('/current_weather', function (Request $request) {

	$api_key = config('services.openweather.key');
	$zipcode = $request->get('zipcode');

	$curl = curl_init();

	curl_setopt_array($curl, array(
	    CURLOPT_URL => "api.openweathermap.org/data/2.5/weather?zip=${zipcode}&APPID={$api_key}"
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if ($err) {
		return response()->json([
	    	'error' => $err
	    ], Response::HTTP_BAD_REQUEST);
	}

	return response()->json($response, Response::HTTP_OK);
});