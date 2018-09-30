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

		$this->log_request($request, $response);
		
		return $response;
	}

	/**
	 * Creates a log entry after request is handled
	 * 
	 * @param \Illuminate\Http\Request  $request
	 * @param \Illuminate\Http\Response  $response
	 * @return void
	 */
	private function log_request($request, $response)
	{
		$entry = new RequestEntry();

		$entry->http_status_code = $response->getStatusCode();
		$entry->request_method = strtoupper($request->method());
		$entry->route = $request->path();

		$entry->save();
	}
}