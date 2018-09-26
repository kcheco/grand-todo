<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\TodoRequest;
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
    public function postNewTodo(TodoRequest $request)
    {
    	$params = $this->todoParams($request);
    	$todo = new Todo($params);

    	$todo->save();
        return response($todo->toJson(), Response::HTTP_CREATED);
    }

    
    /**
     * Whitelists attributes being passed through 
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Request
     */
    private function todoParams(TodoRequest $request) 
    {
    	return $request->only(['task', 'completed']);
    }
}
