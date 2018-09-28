<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Request as RequestEntry;
use Illuminate\Http\Request;

/**
 * RequestLogMonitor log the request method and route being accessed, as well as the HTTP
 * status code after the request is handled.
 *
 */
class RequestLogMonitor
{
	
	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next)
	{
		$response = $next($request);
		$entry = new RequestEntry();

		$entry->http_status_code = $response->getStatusCode();
		$entry->request_method = strtoupper($request->method());
		$entry->route = $request->path();

		$entry->save();

		return $response;
	}
}