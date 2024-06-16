<?php

namespace PFW\Framework\Http;

use Exception;
use PFW\Framework\Http\Exceptions\HttpException;
use PFW\Framework\Routing\RouterInterface;

class Kernel
{
	public function __construct(
		private RouterInterface $router
	) {
	}

	public function handle(Request $request): Response
	{
		try {
			[$routeHandler, $vars] = $this->router->dispatch($request);

			$response = call_user_func_array($routeHandler, $vars);
		} catch (HttpException $exception) {
			$response = new Response($exception->getMessage(), $exception->getStatusCode());
		}

		return $response;
	}
}
