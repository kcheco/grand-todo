<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'todos';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'task', 'completed'
    ];

    /**
     * The model attribute's original state.
     *
     * @var array
     */
    protected $original = [
        'completed' => false
    ];

    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean'
    ];
}
