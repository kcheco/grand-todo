<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'http_status_code', 'request_method', 'route'
    ];
}
