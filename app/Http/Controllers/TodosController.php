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
     * @param \App\Http\Requests\TodoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postNewTodo(TodoRequest $request)
    {
    	$params = $request->all();
    	$todo = new Todo($params);

    	$todo->save();
        return response($todo->toJson(), Response::HTTP_CREATED);
    }

    /**
     * Updates an existing Todo
     *
     * @param \Illuminate\Http\Request $request
     * @param String $id
     * @return \Illuminate\Http\Response
     */
    public function patchExistingTodo(Request $request, $id)
    {
        $params = $request->all();
        $todo = Todo::find($id);

        $todo->update($params);
        return response($todo->toJson(), Response::HTTP_ACCEPTED);
    }

    /**
     * Show a specific Todo
     *
     * @param String $id
     * @return \Illuminate\Http\Response
     */
    public function getTodo($id)
    {
        $todo = Todo::find($id);

        // when record does not exist then return error
        if (!$todo) {
            return response()->json([
                'error' => "The record with the key {$id} does not exist."
            ], Response::HTTP_NOT_FOUND);
        }

        return response($todo->toJson());
    }
}
