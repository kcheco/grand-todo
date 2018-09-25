<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    
	/**
	 * Returns a list of all the Todos
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function getAllTodos()
    {
    	return response(Todo::all()->toJson());
    }
}
