<?php

namespace Framework\Http;

use Exception;
use Framework\Routing\Router;

class Kernel
{

	public function handle(Request $request): Response
	{
		try {
			[$routeHandler, $vars] = (new Router())->dispatch($request);

			$response = call_user_func_array($routeHandler, $vars);
		} catch (Exception $exception) {
			$response = new Response($exception->getMessage(), 500);
		}

		return $response;
	}
}
