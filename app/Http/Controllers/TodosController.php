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

        return response($todos->toJson(), Response::HTTP_OK);
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
     * @param \App\Http\Requests\TodoRequest $request
     * @param String $id
     * @return \Illuminate\Http\Response
     */
    public function patchExistingTodo(TodoRequest $request, $id)
    {
        $params = $request->all();
        $todo = Todo::find($id);

        // when record does not exist then return error
        if (!$todo) {
            return response()->json([
                'error' => "Unable to update task. The record with the key {$id} does not exist."
            ], Response::HTTP_NOT_FOUND);
        }

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
                'error' => "Unable to display task. The record with the key {$id} does not exist."
            ], Response::HTTP_NOT_FOUND);
        }

        return response($todo->toJson(), Response::HTTP_OK);
    }

    /**
     * Delete a specific Todo
     *
     * @param String $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTodo($id)
    {
        $todo = Todo::find($id);

        // when record does not exist then return error
        if (!$todo) {
            return response()->json([
                'error' => "Unable to delete task. The record with the key {$id} does not exist."
            ], Response::HTTP_NOT_FOUND);
        }

        $todo->delete();
        return response()->json([
            'deleted' => true
        ], Response::HTTP_OK);
    }
}
