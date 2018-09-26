<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodosController extends Controller
{
    
	/**
	 * Returns a list of all the Todos
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function getAllTodos()
    {
        $todos = Todo::all();

        return response($todos->toJson());
    }

    /**
     * Creates a new Todo
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function postNewTodo(Request $request)
    {
    	$params = $this->todoParams($request);
    	$todo = new Todo($params);

    	if ($todo->save()) {
            return response($todo->toJson(), Response::HTTP_CREATED);
        } else {
            return response()->json(array('errors'=>'There appears to be an error saving the new task. Make sure you are providing the task you wish to track.'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    
    /**
     * Whitelists attributes being passed through 
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Request
     */
    private function todoParams(Request $request) 
    {
    	return $request->only(['task', 'completed']);
    }
}
