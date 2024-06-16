<?php

namespace PFW\Framework\Http;

use Exception;
use League\Container\Container;
use PFW\Framework\Http\Exceptions\HttpException;
use PFW\Framework\Routing\RouterInterface;


class Kernel
{
	private string $appEnv;

	public function __construct(
		private Container $container,
		private RouterInterface $router
	) {
		$this->appEnv = $container->get('APP_ENV');
	}

	public function handle(Request $request): Response
	{
		try {
			[$routeHandler, $vars] = $this->router->dispatch($request, $this->container);

			$response = call_user_func_array($routeHandler, $vars);
		} catch (Exception $exception) {
			$response = $this->createExceptionResponse($exception);
		}

		return $response;
	}

	private function createExceptionResponse(Exception $e): Response
	{
		if (in_array($this->appEnv, ['local', 'testing', 'dev'])) {
			throw $e;
		}

		if ($e instanceof HttpException) {
			return new Response($e->getMessage(), $e->getStatusCode());
		}

		return new Response('Server error', 500);
	}
}
