<?php

namespace Framework\Http;

use Exception;
use Framework\Http\Exceptions\HttpException;
use Framework\Routing\Router;

class Kernel
{

	public function handle(Request $request): Response
	{
		try {
			[$routeHandler, $vars] = (new Router())->dispatch($request);

			$response = call_user_func_array($routeHandler, $vars);
		} catch (HttpException $exception) {
			$response = new Response($exception->getMessage(), $exception->getStatusCode());
		}

		return $response;
	}
}
